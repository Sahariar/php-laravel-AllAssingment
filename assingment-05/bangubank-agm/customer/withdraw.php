<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

use App\classes\AccountManager;
use App\classes\Users;
use Includes\databaseUsers;
use Includes\dbTransaction;
use Includes\fileStorageUsers;
use Includes\fileStorageTransactions;

// Load the configuration file
$config = require __DIR__ . '/../config/config.php';
// storage is file then do or load other one.
if($config['storage'] === 'file') {
    $database = new fileStorageUsers($config);
    $transatciondatabase = new fileStorageTransactions($config);
} else {
    // Create a new Database instance
    $database = new databaseUsers($config);
    $transatciondatabase = new dbTransaction($config);
}
$user = new Users($database);
$accountManager = new AccountManager($transatciondatabase);

$errorMessage = [];
$amount;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (empty($_POST['amount'])) {
        $errorMessage['amount'] = "Please Provide Your amount";
    } else {
        $amount = sanitizeInput($_POST['amount']);
    }

    if (empty($errorMessage)) {
        $accountManager->addWithdraw($amount, $_SESSION['user_id'], $_SESSION['user_id']);
    }
}
$currentBalance = $accountManager->showBalanceById($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- Tailwindcss CDN -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- AlpineJS CDN -->
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

	<!-- Inter Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
	<style>
		* {
			font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont,
				'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans',
				'Helvetica Neue', sans-serif;
		}
	</style>

	<title>Withdraw Balance</title>
</head>

<body class="h-full">
	<div class="min-h-full">
		<div class="bg-<?php echo $_SESSION['color']; ?>-600 pb-32">
			<nav class="border-b border-<?php echo $_SESSION['color']; ?>-300 border-opacity-25 bg-<?php echo $_SESSION['color']; ?>-600" x-data="{ mobileMenuOpen: false, userMenuOpen: false }">
				<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
					<div class="flex h-16 justify-between">
						<div class="sm:ml-6 sm:flex gap-2 sm:items-center -mr-2 flex items-center">
							<!-- Profile dropdown -->
							<!-- <img
                        class="h-10 w-10 rounded-full"
                        src="https://avatars.githubusercontent.com/u/831997"
                        alt="Ahmed Shamim Hasan Shaon" /> -->
							<span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100">
								<svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="32px" viewBox="0 0 512 512" xml:space="preserve" fill="#10b981">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<style type="text/css">
											.st0 {
												fill: #065f46;
											}
										</style>
										<g>
											<path class="st0" d="M162.969,480.609c-0.688-0.703-1.406-1.313-2.094-1.828c-0.719-0.5-1.75-1.125-3.094-1.813 c5.641-3.141,8.469-7.969,8.469-14.5c0-2.875-0.5-5.469-1.5-7.781s-2.406-4.281-4.219-5.906c-1.828-1.625-4.063-2.891-6.688-3.781 c-2.625-0.906-5.531-1.344-8.719-1.344h-27.469V512h28.625c3.188,0,6.094-0.469,8.688-1.391s4.781-2.234,6.625-3.938 c1.813-1.703,3.203-3.734,4.156-6.141c0.969-2.406,1.453-5.109,1.453-8.125c0-2.422-0.328-4.594-1.016-6.516 C165.516,483.969,164.438,482.219,162.969,480.609z M131,455.563h13.063c2.75,0,4.906,0.688,6.484,2.094 c1.563,1.406,2.359,3.344,2.359,5.766c0,2.438-0.797,4.359-2.359,5.766c-1.578,1.406-3.734,2.109-6.484,2.109H131V455.563z M151.453,497.844c-1.609,1.5-3.766,2.25-6.516,2.25H131v-16.797h13.938c2.75,0,4.906,0.734,6.516,2.203s2.391,3.531,2.391,6.156 S153.063,496.344,151.453,497.844z"></path>
											<path class="st0" d="M207.813,443.656L182.938,512h13.922L201,499.906h24.281L229.313,512h13.906l-24.953-68.344H207.813z M204.734,488.672l8.641-24.859l8.344,24.859H204.734z"></path>
											<polygon class="st0" points="300.25,485.5 273.188,443.656 261.281,443.656 261.281,512 274.625,512 274.625,470.047 301.688,512 313.594,512 313.594,443.656 300.25,443.656 "></polygon>
											<polygon class="st0" points="392.703,443.656 376.469,443.656 352.375,473.406 352.375,443.656 339.031,443.656 339.031,512 352.375,512 352.375,491.453 361.219,480.906 378.781,512 394.344,512 370.047,470.813 "></polygon>
											<polygon class="st0" points="256,0 64,69.344 64,109.344 80,109.344 80,121.344 432,121.344 432,109.344 448,109.344 448,69.344 "></polygon>
											<polygon class="st0" points="432,357.344 80,357.344 80,389.344 64,389.344 64,421.344 448,421.344 448,389.344 432,389.344 "></polygon>
											<polygon class="st0" points="344,325.344 344,341.344 408,341.344 408,325.344 400,325.344 400,153.344 408,153.344 408,137.344 344,137.344 344,153.344 352,153.344 352,325.344 "></polygon>
											<polygon class="st0" points="224,325.344 224,341.344 288,341.344 288,325.344 280,325.344 280,153.344 288,153.344 288,137.344 224,137.344 224,153.344 232,153.344 232,325.344 "></polygon>
											<polygon class="st0" points="104,325.344 104,341.344 168,341.344 168,325.344 160,325.344 160,153.344 168,153.344 168,137.344 104,137.344 104,153.344 112,153.344 112,325.344 "></polygon>
										</g>
									</g>
								</svg>
							</span>
						</div>
						<div class="flex items-center px-2 lg:px-0">
							<div class="hidden sm:block">
								<div class="flex space-x-4">
									<!-- Current: "bg-<?php echo $_SESSION['color']; ?>-700 text-white", Default: "text-white hover:bg-<?php echo $_SESSION['color']; ?>-500 hover:bg-opacity-75" -->
									<a href="./dashboard.php" class="text-white hover:bg-<?php echo $_SESSION['color']; ?>-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium" aria-current="page">Dashboard</a>
									<a href="./deposit.php" class="text-white hover:bg-<?php echo $_SESSION['color']; ?>-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium">Deposit</a>
									<a href="./withdraw.php" class="bg-<?php echo $_SESSION['color']; ?>-700 text-white rounded-md py-2 px-3 text-sm font-medium">Withdraw</a>
									<a href="./transfer.php" class="text-white hover:bg-<?php echo $_SESSION['color']; ?>-500 hover:bg-opacity-75 rounded-md py-2 px-3 text-sm font-medium">Transfer</a>
								</div>
							</div>
						</div>
						<div class="hidden sm:ml-6 sm:flex gap-2 sm:items-center">
							<!-- Profile dropdown -->
							<div class="relative ml-3" x-data="{ open: false }">
								<div>
									<button @click="open = !open" type="button" class="flex rounded-full bg-white text-sm focus:outline-none" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
										<span class="sr-only">Open user menu</span>
										<!-- <img
                        class="h-10 w-10 rounded-full"
                        src="https://avatars.githubusercontent.com/u/831997"
                        alt="Ahmed Shamim Hasan Shaon" /> -->
										<span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-<?php echo $_SESSION['color'] ?>-100">
											<span class="font-medium leading-none text-<?php echo $_SESSION['color'] ?>-700"><?php echo get2Intial($_SESSION['name']); ?></span>
										</span>
									</button>
								</div>

								<!-- Dropdown menu -->
								<div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
									<a href="/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
								</div>
							</div>
						</div>
						<div class="-mr-2 flex items-center sm:hidden">
							<!-- Mobile menu button -->
							<button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center rounded-md p-2 text-<?php echo $_SESSION['color']; ?>-100 hover:bg-<?php echo $_SESSION['color']; ?>-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-<?php echo $_SESSION['color']; ?>-500" aria-controls="mobile-menu" aria-expanded="false">
								<span class="sr-only">Open main menu</span>
								<!-- Icon when menu is closed -->
								<svg x-show="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
								</svg>

								<!-- Icon when menu is open -->
								<svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
								</svg>
							</button>
						</div>
					</div>
				</div>

				<!-- Mobile menu, show/hide based on menu state. -->
				<div x-show="mobileMenuOpen" class="sm:hidden" id="mobile-menu">
					<div class="space-y-1 pt-2 pb-3">
						<a href="./dashboard.php" class="text-white hover:bg-<?php echo $_SESSION['color']; ?>-500 hover:bg-opacity-75 block rounded-md py-2 px-3 text-base font-medium" aria-current="page">Dashboard</a>

						<a href="./deposit.php" class="text-white hover:bg-<?php echo $_SESSION['color']; ?>-500 hover:bg-opacity-75 block rounded-md py-2 px-3 text-base font-medium">Deposit</a>

						<a href="./withdraw.php" class="bg-<?php echo $_SESSION['color']; ?>-700 text-white block rounded-md py-2 px-3 text-base font-medium">Withdraw</a>

						<a href="./transfer.php" class="text-white hover:bg-<?php echo $_SESSION['color']; ?>-500 hover:bg-opacity-75 block rounded-md py-2 px-3 text-base font-medium">Transfer</a>
					</div>
					<div class="border-t border-<?php echo $_SESSION['color']; ?>-700 pb-3 pt-4">
						<div class="flex items-center px-5">
							<div class="flex-shrink-0">
								<!-- <img
                    class="h-10 w-10 rounded-full"
                    src="https://avatars.githubusercontent.com/u/831997"
                    alt="" /> -->
								<span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-<?php echo $_SESSION['color']; ?>-100">
									<span class="font-medium leading-none text-<?php echo $_SESSION['color']; ?>-700"><?php echo get2Intial($_SESSION['name']); ?></span>
								</span>
							</div>
							<div class="ml-3">
								<div class="text-base font-medium text-white">
									<?php echo $_SESSION['name']; ?>
								</div>
								<div class="text-sm font-medium text-<?php echo $_SESSION['color']; ?>-300">
									<?php echo $_SESSION['email']; ?>
								</div>
							</div>
							<button type="button" class="ml-auto flex-shrink-0 rounded-full bg-<?php echo $_SESSION['color']; ?>-600 p-1 text-<?php echo $_SESSION['color']; ?>-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-<?php echo $_SESSION['color']; ?>-600">
								<span class="sr-only">View notifications</span>
								<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
								</svg>
							</button>
						</div>
						<div class="mt-3 space-y-1 px-2">
							<a href="/logout.php" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-<?php echo $_SESSION['color']; ?>-500 hover:bg-opacity-75">Sign out</a>
						</div>
					</div>
				</div>
			</nav>
			<header class="py-10">
				<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
					<h1 class="text-3xl font-bold tracking-tight text-white">
						Withdaw Balance
					</h1>
				</div>
			</header>
		</div>

		<main class="-mt-32">
			<div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
				<div class="bg-white rounded-lg p-2">
					<!-- Current Balance Stat -->
					<dl class="mx-auto grid grid-cols-1 gap-px sm:grid-cols-2 lg:grid-cols-4">
						<div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
							<dt class="text-sm font-medium leading-6 text-gray-500">
								Current Balance
							</dt>
							<dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
								<?php if (isset($currentBalance)) : ?>
								$<?php echo $currentBalance ;?>
								<?php else : ?>
								$0.00
								<?php endif ?>
							</dd>
						</div>
					</dl>

					<hr />
					<!-- Withdaw Form -->
					<div class="sm:rounded-lg">
						<div class="px-4 py-5 sm:p-6">
							<h3 class="text-lg font-semibold leading-6 text-gray-800">
								Withdaw Money From Your Account
							</h3>
							<div class="mt-4 text-sm text-gray-500">
								<form action="withdraw.php" method="POST">
									<!-- Input Field -->
									<div class="relative mt-2 rounded-md">
										<div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-0">
											<span class="text-gray-400 sm:text-4xl">$</span>
										</div>
										<input type="number" name="amount" id="amount" class="block w-full ring-0 outline-none text-xl pl-4 py-2 sm:pl-8 text-gray-800 border-b border-b-<?php echo $_SESSION['color']; ?>-500 placeholder:text-gray-400 sm:text-4xl" step="0.01" placeholder="0.00" required />
									</div>

									<!-- Submit Button -->
									<div class="mt-5">
										<button type="submit" class="w-full px-6 py-3.5 text-base font-medium text-white bg-<?php echo $_SESSION['color']; ?>-600 hover:bg-<?php echo $_SESSION['color']; ?>-800 focus:ring-4 focus:outline-none focus:ring-<?php echo $_SESSION['color']; ?>-300 rounded-lg sm:text-xl text-center">
											Proceed
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</body>

</html>