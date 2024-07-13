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

class Users
{
    private $_usersFile;
    /**
     * Construct.
     */
    public function __construct()
    {
        $this->_usersFile = __DIR__ . '/../../data/users.json';
    }

    /**
     * Save user to the users data.
     *
     * @param array $userData Array of user data to add
     *
     * @return bool True on success, false on failure.
     */
    public function saveUserData($newUserData)
    {
        // Read existing data from JSON file
        $usersData = $this->readUserData();
        $usersData[] = $newUserData;
        // encode data to json data
        $jsonData = json_encode($usersData, JSON_PRETTY_PRINT);
        // write json data to file
        if (file_put_contents($this->_usersFile, $jsonData)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Read users data from JSON file.
     *
     * @return array|null Array of user data (excluding 'password')
     */
    public function readUserData()
    {
        $jsonData = file_get_contents($this->_usersFile);
        if ($jsonData === false) {
            return null;
        }
        $usersData = json_decode($jsonData, true);
        if ($usersData === null && json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }
        return $usersData;
    }
    /**
     * Add a new user to the users data.
     *
     * @param array $userData Array of user data to add,including 'username',
     *
     * @return bool True on success, false on failure.
     */
    public function addUser($userData)
    {

        // got userData and validate usermail and password,
        if (!isset($userData['email']) && !isset($userData['password'])) {
            return false;
        }
        // hash pass
        $hashPassowrd = password_hash($userData['password'], PASSWORD_DEFAULT);
        if ($hashPassowrd === false) {
            return false;
        }
        unset($userData['password']);
        $userData['password'] = $hashPassowrd;
        $usersData = $this->readUserData();
        // Get the total number of elements in $usersData
        $numUsers = count($usersData);
        if ($numUsers > 0) {
            // Access the userId of the last element
            $lastUserId = $usersData[$numUsers - 1]['userId'] + 1;
        }

        // add user id to userData object
        $userData['userId'] = $lastUserId;
        // $userData[] = $userData;

        // saving after adding new userId;
        return $this->saveUserData($userData);
    }

    /**
     * getUserIdByEmail
     *
     * @param  mixed $email
     * @return void
     */
    public function getUserByEmail($email)
    {
        $usersData = $this->readUserData();

        if ($usersData === false) {
            return null;
        }
        // Iterate over each user data array
        foreach ($usersData as $userData) {
            if (isset($userData['email']) && $userData['email'] === $email) {
                return $userData;
            }
        }

        return null; // User not found
    }
    public function getUserById($userId)
    {
        $usersData = $this->readUserData();

        if ($usersData === false) {
            return null;
        }
        // Iterate over each user data array
        foreach ($usersData as $userData) {
            if (isset($userData['userId']) && $userData['userId'] === $userId) {
                return $userData;
            }
        }

        return "Not Found"; // User not found
    }
    public function validateUser($email, $password)
    {
        $usersData = $this->readUserData();
        if ($usersData === false) {
            return null;
        }
        foreach ($usersData as $userData) {
            if (isset($userData['email']) && $userData['email'] === $email) {
                // Verify the password
                if (password_verify($password, $userData['password'])) {
                    return $userData;
                } else {
                    return false; // Password mismatch
                }
            }
        }
        return false;
    }
};
