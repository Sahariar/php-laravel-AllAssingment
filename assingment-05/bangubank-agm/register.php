<?php
session_start();
require 'vendor/autoload.php';

use App\classes\Notifications;
use App\Classes\Users;
use Includes\databaseUsers;
use Includes\dbNotification;
use Includes\fileStorageUsers;

// Load the configuration file
$config = require 'config/config.php';
// storage is file then do or load other one.
if($config['storage'] === 'file') {
    $database = new fileStorageUsers($config);
} else {
    // Create a new Database instance
    $database = new databaseUsers($config);
    $databaseNotification = new dbNotification($config);
}

$errorMessage = [];

$name;
$email;
$password;
$user = new Users($database);
$notification = new Notifications($databaseNotification);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (empty($_POST['name'])) {
        $errorMessage['name'] = "Please Provide Your Name";
    } else {
        $name = sanitizeInput($_POST['name']);
    }

    if (empty($_POST['email'])) {
        $errorMessage['email'] = "Please Provide Your email";
    } else {
        $email = sanitizeInput($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage['email'] = "Please enter a valid email";
        }
    }

    if (empty($_POST['password'])) {
        $errorMessage['password'] = "Please enter password";
    } elseif (strlen($_POST['password']) < 4) {
        $errorMessage['password'] = "Password should be more than 8 charecters";
    } else {
        $password = sanitizeInput($_POST['password']);
    }

    if(empty($errorMessage)) {
        $newUserData = [
        'password' => $password,
        'name' => $name,
        'email' => $email,
        'role' => "customer",
        'color' => getRandomColor()
];
		$user->addUser($newUserData);
        $userId = $user->getUserByEmail($email);
        
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['color'] = $newUserData['color'];
        $_SESSION['user_id'] = $userId['user_id'];
		$notfType = "User Created";
		$notfMessage = "New User Created with . $name and . $email ";
		$setNotification = $notification->addNotification($userId['user_id'], $notfType, $notfMessage);
        header("Location: customer/dashboard.php");
    }
}

?>
<!DOCTYPE html>
<html class="h-full bg-white" lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://cdn.tailwindcss.com"></script>

	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=
      Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />

	<style>
		* {
			font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont,
				'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans',
				'Helvetica Neue', sans-serif;
		}
	</style>

	<title>Create A New Account</title>
</head>

<body class="h-full bg-slate-100">
	<div class="flex flex-col justify-center min-h-full py-12 sm:px-6 lg:px-8">
		<div class="sm:mx-auto sm:w-full sm:max-w-md">
			<h2 class="mt-6 text-2xl font-bold leading-9 tracking-tight 
          text-center text-gray-900">
				Create A New Account
			</h2>
		</div>

		<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
			<div class="px-6 py-12 bg-white shadow sm:rounded-lg sm:px-12">
				<form class="space-y-6" action="register.php" method="POST" novalidate>
					<div>
						<label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
						<div class="mt-2">
							<input id="name" name="name" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                  shadow-sm ring-1 ring-inset ring-gray-300 
                  placeholder:text-gray-400 focus:ring-2 
                  focus:ring-inset focus:ring-emerald-600 sm:text-sm 
                  sm:leading-6 p-2" />
						</div>
					</div>

					<div>
						<label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
						<div class="mt-2">
							<input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                  shadow-sm ring-1 ring-inset ring-gray-300 
                  placeholder:text-gray-400 focus:ring-2 
                  focus:ring-inset focus:ring-emerald-600 sm:text-sm 
                  sm:leading-6 p-2" />
						</div>
					</div>

					<div>
						<label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
						<div class="mt-2">
							<input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                  shadow-sm ring-1 ring-inset ring-gray-300 
                  placeholder:text-gray-400 focus:ring-2 
                  focus:ring-inset focus:ring-emerald-600 sm:text-sm 
                  sm:leading-6 p-2" />
						</div>
					</div>

					<div>
						<button type="submit" class="flex w-full justify-center rounded-md bg-emerald-600 
                px-3 py-1.5 text-sm font-semibold leading-6 text-white 
                shadow-sm hover:bg-emerald-500 focus-visible:outline 
                focus-visible:outline-2 focus-visible:outline-offset-2 
                focus-visible:outline-emerald-600">
							Register
						</button>
					</div>
				</form>
			</div>

			<p class="mt-10 text-sm text-center text-gray-500">
				Already a customer?
				<a href="./login.php" class="font-semibold leading-6 text-emerald-600 hover:text-emerald-500">Sign-in</a>
			</p>
		</div>
	</div>
</body>

</html>