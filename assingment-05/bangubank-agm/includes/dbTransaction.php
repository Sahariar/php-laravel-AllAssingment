<?php

namespace Includes;

use PDO;
use PDOException;

class dbTransaction implements transactionInterface
{
    private $pdo;

    public function __construct($config)
    {
        try {
            $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'] . ';charset=utf8mb4';
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->pdo = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $options);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }


    public function addDeposit($amount, $userId, $reciverId)
    {
        $total_balance = $this->showBalanceById($userId);
        if($total_balance === null){
            $total_balance = $amount;
        }else{
            $total_balance += $amount;
        }
        $sql = "INSERT INTO transactions (customer_id, receiver_id, amount, balance,type) VALUES (:customer_id, :receiver_id, :amount, :balance, :type)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'customer_id' => $userId,
            'receiver_id' => $reciverId,
            'amount' => $amount,
            'balance' => $total_balance,
            'type' => "deposit"
        ]);
    }
    public function addWithdraw($amount, $userId, $reciverId)
    {
        $total_balance = $this->showBalanceById($userId);
        if($total_balance === null){
            $total_balance = $amount;
        }else{
            $total_balance -= $amount;
        }
        $sql = "INSERT INTO transactions (customer_id, receiver_id, amount, balance,type) VALUES (:customer_id, :receiver_id, :amount, :balance, :type)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'customer_id' => $userId,
            'receiver_id' => $reciverId,
            'amount' => $amount,
            'balance' => $total_balance,
            'type' => "withdraw"
        ]);
    }
    public function transferBalance($amount, $userId, $reciverId)
    {
        if($userId !== $reciverId){
            $this->addWithdraw($amount, $userId, $reciverId);
            $this->addDeposit($amount, $reciverId, $userId);
        }
    }
    public function showBalanceById($userId)
    {
        $sql = "SELECT * FROM transactions WHERE customer_id = :customer_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['customer_id' => $userId]);
        $transactionsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($transactionsData)) {
            return null;
        }
        $totalBalance = 0.00;
        foreach ($transactionsData as $transactionData) {
            if ($transactionData['type'] === 'deposit') {

                $totalBalance += $transactionData['amount'];

            } elseif ($transactionData['type'] === 'withdraw') {
                $totalBalance -= $transactionData['amount'];
            }
        }
        return number_format( $totalBalance, 2, '.', '');;
    }

    public function showTransactionsById($userId)
    {
        $sql = "SELECT * FROM transactions WHERE customer_id = :customer_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['customer_id' => $userId]);
        $transactionAllData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $transactionAllData;
    }
    public function showAllTransactions()
    {
        $sql = "SELECT * FROM transactions";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $transactionAllData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $transactionAllData;
    }
    

}
