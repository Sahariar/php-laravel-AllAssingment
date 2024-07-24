<?php

namespace Includes;

interface transactionInterface
{
    public function addDeposit($amount, $userId, $reciverId);
    public function addWithdraw($amount, $userId, $reciverId);
    public function transferBalance($amount, $userId, $reciverId);
    public function showBalanceById($userId);
    public function showTransactionsById($userId);
    public function showAllTransactions();
}
