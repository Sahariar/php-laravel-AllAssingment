<?php
namespace Includes;

use PDO;
use PDOException;

class databaseUsers implements userInterface
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

    public function saveUser($userData)
    {
        $sql = "INSERT INTO users (email, name, password,color,role) VALUES (:email, :name, :password,:color, :role)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'email' => $userData['email'],
            'name' => $userData['name'],
            'password' => $userData['password'],
            'color' => $userData['color'],
            'role' => $userData['role']
        ]);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch();
    }

    public function validateUser($email, $password)
    {
        $user = $this->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
