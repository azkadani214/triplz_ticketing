<?php

namespace App\Repositories;

use App\Interfaces\TransactionFlightRepositoryInterface;
use App\Jobs\SendMailTransactionSuccessJob;
use App\Models\TransactionFlight;
use App\Models\TransactionPassenger;
use App\Models\FlightClass;
use App\Models\PromoCode;

class TransactionFlightRepository implements TransactionFlightRepositoryInterface
{
    public function getTransactionDataFromSession()
    {
        return session()->get('transaction');
    }

    public function saveTransactionDataToSession($data) // Fixed typo in method name
    {
        $transaction = session()->get('transaction', []);
        foreach ($data as $key => $value) {
            $transaction[$key] = $value;
        }
        session()->put('transaction', $transaction); // Added missing session save
    }

    public function saveTransaction($data)
    {
        $data['code'] = $this->generateTransactionCode();
        $data['number_of_passengers'] = $this->countPassengers($data['passengers']); // Fixed typo in key name

        $data['subtotal'] = $this->calculateSubtotal($data['flight_class_id'], $data['number_of_passengers']);
        $data['grandtotal'] = $data['subtotal']; // Initialize grandtotal with subtotal

        if (!empty($data['promo_code'])) {
            $data = $this->applyPromoCode($data);
        }

        $data['grandtotal'] = $this->addPPN($data['grandtotal']);

        $transaction = $this->createTransaction($data);
        $this->savePassengers($data['passengers'], $transaction->id); // Fixed method name

        session()->forget('transaction');

        return $transaction;
    }

    public function generateTransactionCode()
    {
        return "TRPLZ" . rand(1000, 9999);
    }

    public function countPassengers($passengers) // Added missing parameter
    {
        return count($passengers);
    }

    public function calculateSubtotal($flightClassId, $numberOfPassengers)
    {
        $price = FlightClass::findOrFail($flightClassId)->price;
        return $price * $numberOfPassengers;
    }

    private function applyPromoCode($data)
    {
        $promo = PromoCode::where('code', $data['promo_code'])
            ->where('valid_until', '>=', now())
            ->where('is_used', false) // Fixed field name
            ->first();

        if ($promo) {
            if ($promo->discount_type === 'percentage') { // Fixed typo in comparison value
                $data['discount'] = $data['grandtotal'] * ($promo->discount / 100);
            } else {
                $data['discount'] = $promo->discount; // Fixed variable name
            }

            $data['grandtotal'] = $data['grandtotal'] - $data['discount']; // Fixed calculation
            $data['promo_code_id'] = $promo->id;

            $promo->update(['is_used' => true]);
        }

        return $data;
    }

    private function addPPN($grandTotal)
    {
        $ppn = $grandTotal * 0.12;
        return $grandTotal + $ppn; // Fixed syntax error
    }

    private function createTransaction($data)
    {
        return TransactionFlight::create($data);
    }

    private function savePassengers($passengers, $transactionId) // Fixed method name and syntax
    {
        foreach ($passengers as $passenger) {
            $passenger['transaction_id'] = $transactionId;
            TransactionPassenger::create($passenger);
        }
    }

    public function getTransactionByCode($code) // Fixed method name capitalization and removed semicolon
    {
        return TransactionFlight::where('code', $code)->first();
    }

    public function getTransactionByCodeEmailPhone($code, $email, $phone) // Fixed method name capitalization
    {
        return TransactionFlight::where('code', $code)
            ->where('email', $email)
            ->where('phone_number', $phone)
            ->first();
    }
}
