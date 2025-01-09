<?php

namespace App\Interfaces;

interface TransactionFlightRepositoryInterface
{
    public function getTransactionDataFromSession();

    public function saveTransactionDataToSesstion($data);

    public function saveTransaction($data);

    public function getTransactionByCode($code);

    public function getTransactionByCodeEmailPhone($code, $email, $phone);

}
