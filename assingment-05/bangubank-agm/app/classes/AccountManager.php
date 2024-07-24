<?php
/**
 * Represents a collection of Transactions.
 *
 * This file contains the Transactions class which represents a
 * collection of user objects.
 * It includes methods to add, retrieve, and remove users from the collection.
 *
 * @category Class
 * @package  Bangubank
 * @author   Sahariar <sahariark@gmail.com>
 * @license  https://opensource.org/licenses/MIT   MIT License
 * @link     https://example.com/docs/users-class   Documentation
 */

namespace app\classes;

use Includes\transactionInterface;

class AccountManager
{
    private $storage;

    public function __construct(transactionInterface $storage)
    {
        $this->storage = $storage;
    }
    public function addDeposit($amount, $userId, $reciverId)
    {
        $this->storage->addDeposit($amount, $userId, $reciverId);
    }
    public function addWithdraw($amount, $userId, $reciverId)
    {
        $this->storage->addWithdraw($amount, $userId, $reciverId);
    }
    public function transferBalance($amount, $userId, $reciverId)
    {
        $this->storage->transferBalance($amount, $userId, $reciverId);
    }
    public function showBalanceById($userId)
    {
        return $this->storage->showBalanceById($userId);
    }
    public function showTransactionsById($userId)
    {
        return $this->storage->showTransactionsById($userId);
    }
    public function readAccountFile()
    {
        return $this->storage->showAllTransactions();
    }
};
