<?php

namespace App\Interfaces;

interface TransactionFlightRepositoryInterface
{
    public function getTransactionDataFromSession();

    public function saveTransactionDataToSession($data);  // Fixed spelling from "Sesstion" to "Session"

    public function saveTransaction($data);

    public function getTransactionByCode($code);

    public function getTransactionByCodeEmailPhone($code, $email, $phone);
}
