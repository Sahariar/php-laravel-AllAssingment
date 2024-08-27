<?php

namespace App\classes;

use Includes\notificationInterface;

class Notifications implements notificationInterface
{
    private $storage;

    public function __construct(notificationInterface $storage)
    {
        $this->storage = $storage;
    }
    public function addNotification($user_id, $type, $message)
    {
        $this->storage->addNotification($user_id, $type, $message);
    }
    public function getNotification($user_id , $type)
    {
        return $this->storage->getNotification($user_id, $type);
    }
    public function getAllNotification()
    {
        return $this->storage->getAllNotification();
    }
    public function markNotificationAsRead($notification_id)
    {
        $this->storage->markNotificationAsRead($notification_id);
    }
}
