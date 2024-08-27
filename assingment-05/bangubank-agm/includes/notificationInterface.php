<?php

namespace Includes;

interface notificationInterface
{
    public function addNotification($user_id , $type , $message);
    public function getNotification($user_id, $type);
    public function getAllNotification();
    public function markNotificationAsRead($notification_id);
}
