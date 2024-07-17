<?php

/**
 * Represents a collection of Transactions.
 *
 * This file contains the Transactions class which represents a
 * collection of user objects.
 * It includes methods to add, retrieve, and remove users from the collection.
 *
 * @category Class
 * @package  Bangubank-agm-4
 * @author   Sahariar <sahariark@gmail.com>
 * @license  https://opensource.org/licenses/MIT   MIT License
 * @link     https://example.com/docs/users-class   Documentation
 */

namespace app\classes;

use Ramsey\Uuid\Uuid;

class AccountManager
{
    private $_accountFile;

    public function __construct()
    {
        $this->_accountFile = __DIR__ . '/../../data/account_transactions.json';
    }

    public function readAccountFile()
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
        $transactionsData = $this->readAccountFile();
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

        $deposit = [
            'transactionsId' => $transactionId,
            'receiverId' => $reciverId,
            'customerId' => $userId,
            'transactionType' => "deposit",
            'balance' => $amount,
            'date' => time(),
        ];

        $this->saveAccountData($deposit);
    }
    public function addWithdraw($amount, $userId, $reciverId)
    {
        $transactionId = Uuid::uuid4()->toString();

        $withdraw = [
            'transactionsId' => $transactionId,
            'receiverId' => $reciverId,
            'customerId' => $userId,
            'transactionType' => "withdraw",
            'balance' => $amount,
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
        $transactionsData = $this->readAccountFile();
        if ($transactionsData === false) {
            return null;
        }
        $totalBalance  = 0.0;
        // Iterate over each user data array
        foreach ($transactionsData as $transactionData) {
            if (isset($transactionData['customerId']) && $transactionData['customerId'] === $userId) {
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
        $transactionsData = $this->readAccountFile();
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
