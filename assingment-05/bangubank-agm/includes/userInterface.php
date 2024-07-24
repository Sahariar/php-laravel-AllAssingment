<?php

namespace Includes;

interface userInterface
{
    public function saveUser($userData);
    public function getUserByEmail($email);
    public function getUserById($userId);
    public function validateUser($email, $password);
    public function getAllUsers();
}
