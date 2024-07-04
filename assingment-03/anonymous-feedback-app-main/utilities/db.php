<?php
function readDataFile($userFile)
{
    if (file_exists($userFile) && filesize($userFile) > 0) {
        return file($userFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    return [];
}

function writeUserToFile($userId,$name,$email,$password){
    $userFile = __DIR__ . '/../db/users.txt';
    $userData = $userId . "," . $name . "," .$email ."," . password_hash($password, PASSWORD_DEFAULT) . "\n";
    file_put_contents($userFile, $userData, FILE_APPEND);
}

function getNextUserId() {
    $userFile = __DIR__ . '/../db/users.txt';
    $users = readDataFile($userFile);
    if (!empty($users)) {
        $lastLine = end($users);
        $lastLineArray = explode(",", $lastLine);
        return $lastLineArray[0] + 1;
    }
    return 1;
}

function validateUser($email,$password){
    $userFile = __DIR__ . '/../db/users.txt';
    $users = readDataFile($userFile);
    foreach($users as $user){
        list($userId,$storeName,$storeEmail,$storePassword) = explode(",", $user);
        if($email == $storeEmail && password_verify($password, $storePassword)){
            return [
                'user_id' => $userId,
                'name' => $storeName,
                'email' => $storeEmail
            ];
        }
    }
    return false;
}

function writeFeedbackToFile($userId,$feedback){
    $userFeedbackFile = __DIR__ . '/../db/feedback.txt';
    $userFeedback = $userId . "," . $feedback . "\n";
    file_put_contents($userFeedbackFile, $userFeedback, FILE_APPEND);
}
function getUserById($userId) {
    $userFile = __DIR__ . '/../db/users.txt';
    $users = readDataFile($userFile);
    foreach ($users as $user) {
        list($storedUserId, $storedUsername, $storedEmail, $storedPassword) = explode(",", $user);
        if ($storedUserId == $userId) {
            return [
                'user_id' => $storedUserId,
                'name' => $storedUsername,
                'email' => $storedEmail
            ];
        }
    }
    return false;
}

function getFeedbacksById($userId) {
    $userFeedbackFile = __DIR__ . '/../db/feedback.txt';
    $messages = readDataFile($userFeedbackFile);
    $result = [];
    foreach ($messages as $message) {
        list($storedUserId, $content) = explode(",", $message);
        if ($storedUserId == $userId) {
            $result[] = $content;
        }
    }
    return $result;
}