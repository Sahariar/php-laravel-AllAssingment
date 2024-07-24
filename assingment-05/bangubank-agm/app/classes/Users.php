<?php

/**
 * Represents a collection of users.
 *
 * This file contains the Users class which represents a collection of user objects.
 * It includes methods to add, retrieve, and remove users from the collection.
 * users class will have user_id, email , name, password
 *
 * @category Class
 * @package  Bangubank-agm-4
 * @author   Sahariar <sahariark@gmail.com>
 * @license  https://opensource.org/licenses/MIT   MIT License
 * @link     https://example.com/docs/users-class   Documentation
 */

namespace app\classes;
use Includes\userInterface;

class Users
{
    private $storage;
    public function __construct(userInterface $storage)
    {
        $this->storage = $storage;
    }

    public function addUser($userData)
    {
        if (!isset($userData['email']) || !isset($userData['password'])) {
            return false;
        }

        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        return $this->storage->saveUser($userData);
    }

    public function getUserByEmail($email)
    {
        return $this->storage->getUserByEmail($email);
    }

    public function getUserById($userId)
    {
        return $this->storage->getUserById($userId);
    }

    public function validateUser($email, $password)
    {
        return $this->storage->validateUser($email, $password);
    }
    public function readUserData()
    {
        return $this->storage->getAllUsers();
    }
}