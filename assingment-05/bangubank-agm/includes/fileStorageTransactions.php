<?php

namespace Includes;
use Ramsey\Uuid\Uuid;

class fileStorageTransactions implements transactionInterface
{
    private $_accountFile;

    public function __construct()
    {
        $this->_accountFile = __DIR__ . '/../data/account_transactions.json';
    }

    public function showAllTransactions()
    {

        $jsonData = file_get_contents($this->_accountFile);
        if ($jsonData === false) {
            return false;
        }

        $userAccountData = json_decode($jsonData, true);
        if ($userAccountData === null && json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }
        return $userAccountData;
    }

    public function saveAccountData($newTransactionData)
    {
        // Read existing data from JSON file
        $transactionsData = $this->showAllTransactions();
        $transactionsData[] = $newTransactionData;
        // encode data to json data
        $jsonData = json_encode($transactionsData, JSON_PRETTY_PRINT);
        // write json data to file
        if (file_put_contents($this->_accountFile, $jsonData)) {
            return true;
        } else {
            return false;
        }
    }

    public function addDeposit($amount, $userId, $reciverId)
    {
        $transactionId = Uuid::uuid4()->toString();
        $total_balance = $this->showBalanceById($userId);
        if($total_balance === null){
            $total_balance = $amount;
        }else{
            $total_balance -= $amount;
        }
        $deposit = [
            'transactions_id' => $transactionId,
            'receiver_id' => $reciverId,
            'customer_id' => $userId,
            'type' => "deposit",
            'amount' => $amount,
            'balance' => $total_balance,
            'date' => time(),
        ];

        $this->saveAccountData($deposit);
    }
    public function addWithdraw($amount, $userId, $reciverId)
    {
        $transactionId = Uuid::uuid4()->toString();
        $total_balance = $this->showBalanceById($userId);
        if($total_balance === null){
            $total_balance = $amount;
        }else{
            $total_balance -= $amount;
        }
        $withdraw = [
            'transactions_id' => $transactionId,
            'receiver_id' => $reciverId,
            'customer_id' => $userId,
            'type' => "withdraw",
            'amount' => $amount,
            'balance' => $total_balance,
            'date' => time(),
        ];

        $this->saveAccountData($withdraw);
    }
    public function transferBalance($amount, $userId, $reciverId)
    {
        $this->addWithdraw($amount, $userId, $reciverId);
        $this->addDeposit($amount, $reciverId, $userId);
    }

    public function showBalanceById($userId)
    {
        $transactionsData = $this->showAllTransactions();
        if ($transactionsData === false) {
            return null;
        }
        $totalBalance  = 0.0;
        // Iterate over each user data array
        foreach ($transactionsData as $transactionData) {
            if (isset($transactionData['customer_id']) && $transactionData['customer_id'] === $userId) {
                if ($transactionData['transactionType'] === 'deposit') {
                    // Add the deposit amount to total deposits
                    $totalBalance += $transactionData['balance'];
                } else {
                    $totalBalance  -= $transactionData['balance'];
                }
            }
        }
        return $totalBalance;
    }
    public function showTransactionsById($userId)
    {
        $transactionsData = $this->showAllTransactions();
        if ($transactionsData === false) {
            return null;
        }
        $transactionAllData = [];
        // Iterate over each user data array
        foreach ($transactionsData as $transactionData) {
            if (isset($transactionData['customerId']) && $transactionData['customerId'] === $userId) {
                $transactionAllData[] = $transactionData;
            }
        }
        return $transactionAllData;
    }
};

