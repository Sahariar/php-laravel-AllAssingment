<?php
namespace Includes;

use PDO;
use PDOException;

class dbNotification implements notificationInterface
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
    public function addNotification($user_id , $type , $message){
        $sql = "INSERT INTO notifications (user_id, type, message, is_read) VALUES (:user_id, :type, :message, :is_read)";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':user_id' => $user_id,
        ':type' => $type,
        ':message' => $message,
        ':is_read' => 0
        ]);
    }
    public function getNotification($user_id, $type){
        $sql = "SELECT * FROM notifications WHERE user_id = :user_id AND type = :type";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':type' => $type
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllNotification(){
        $sql = "SELECT * FROM notifications";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function markNotificationAsRead($notification_id){
        $sql = "UPDATE notifications SET is_read = 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $notification_id]);
    }
}
