<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

use App\classes\AccountManager;
use App\classes\Users;
use App\classes\Notifications;
use Includes\dbNotification;
use Includes\databaseUsers;
use Includes\dbTransaction;
use Includes\fileStorageUsers;
use Includes\fileStorageTransactions;

// Load the configuration file
$config = require __DIR__ . '/../config/config.php';
// storage is file then do or load other one.

if($config['storage'] === 'file'){
	$database = new fileStorageUsers($config);
	$transatciondatabase = new fileStorageTransactions($config);
}else{
	// Create a new Database instance
	$database = new databaseUsers($config);
	$transatciondatabase = new dbTransaction($config);
  $databaseNotification = new dbNotification($config);
}
$user = new Users($database);
$accountManager = new AccountManager($transatciondatabase);
$notification = new Notifications($databaseNotification);

if (!isset($_SESSION['email'])){
  // If not logged in and role isn't admin, redirect to login page
  if($_SESSION['role'] !=='admin'){
    header("Location: ../customer/dashboard.php");
    exit();
  }
  header("Location: /login.php");
  exit();
}

$usersData = $user->readUserData();
$allnNotifications = $notification->getAllNotification();
// dd($usersData);
// Filter out users with role "admin" for display
$filteredUsers = array_filter($usersData, function($user) {
  return $user['role'] !== 'admin';
});

?>


<!DOCTYPE html>
<html
  class="h-full bg-gray-100"
  lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />

    <!-- Tailwindcss CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS CDN -->
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Inter Font -->
    <link
      rel="preconnect"
      href="https://fonts.googleapis.com" />
    <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet" />
    <style>
      * {
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont,
          'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans',
          'Helvetica Neue', sans-serif;
      }
    </style>

    <title>All Customers</title>
  </head>
  <body class="h-full">
    <div class="min-h-full">
      <div class="pb-32 bg-sky-600">
        <!-- Navigation -->
        <nav
          class="border-b border-opacity-25 border-sky-300 bg-sky-600"
          x-data="{ mobileMenuOpen: false, userMenuOpen: false }">
          <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
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
                    <!-- Current: "bg-sky-700 text-white", Default: "text-white hover:bg-sky-500 hover:bg-opacity-75" -->
                    <a
                      href="./customers.php"
                      class="px-3 py-2 text-sm font-medium text-white rounded-md bg-sky-700"
                      >Customers</a
                    >
                    <a
                      href="./transactions.php"
                      class="px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-sky-500 hover:bg-opacity-75"
                      >Transactions</a
                    >
                  </div>
                </div>
              </div>
              <div class="hidden gap-2 sm:ml-6 sm:flex sm:items-center">
                <!-- Profile dropdown -->
                <div
                  class="relative ml-3 flex"
                  x-data="{ open: false }">
                  <div>
                    <button
                      @click="open = !open"
                      type="button"
                      class="flex text-sm bg-white rounded-full focus:outline-none"
                      id="user-menu-button"
                      aria-expanded="false"
                      aria-haspopup="true">
                      <span class="sr-only">Open user menu</span>
                      <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-sky-100">
                        <span class="font-medium leading-none text-sky-700"
                          ><?php echo get2Intial($_SESSION['name']) ;?></span
                        >
                      </span>
                      <!-- <img
                        class="w-10 h-10 rounded-full"
                        src="https://avatars.githubusercontent.com/u/831997"
                        alt="Ahmed Shamim Hasan Shaon" /> -->
                    </button>
                  </div>
                <div
                  class="relative ml-3 flex"
                  x-data="{ open: false }">
                  <div>
                  <button
                  type="button"
                  class="flex-shrink-0 p-1 ml-auto rounded-full bg-sky-100 text-sky-700 hover:text-black focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-sky-600">
                  <span class="sr-only">View notifications</span>
                  <svg
                    class="w-8 h-8"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                  </svg>
                </button>
                  </div>

                  <!-- Dropdown menu -->
                  <div
                    x-show="open"
                    @click.away="open = false"
                    class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="user-menu-button"
                    tabindex="-1">
                    <a
                      href="/logout.php"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                      role="menuitem"
                      tabindex="-1"
                      id="user-menu-item-2"
                      >Sign out</a
                    >
                  </div>
                </div>
              </div>
              <div class="flex items-center -mr-2 sm:hidden">
                <!-- Mobile menu button -->
                <button
                  @click="mobileMenuOpen = !mobileMenuOpen"
                  type="button"
                  class="inline-flex items-center justify-center p-2 rounded-md text-sky-100 hover:bg-sky-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-sky-500"
                  aria-controls="mobile-menu"
                  aria-expanded="false">
                  <span class="sr-only">Open main menu</span>
                  <!-- Icon when menu is closed -->
                  <svg
                    x-show="!mobileMenuOpen"
                    class="block w-6 h-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                  </svg>

                  <!-- Icon when menu is open -->
                  <svg
                    x-show="mobileMenuOpen"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Mobile menu, show/hide based on menu state. -->
          <div
            x-show="mobileMenuOpen"
            class="sm:hidden"
            id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
              <a
                href="./customers.php"
                class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-sky-500 hover:bg-opacity-75"
                >Customers</a
              >
              <a
                href="./transactions.php"
                class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-sky-500 hover:bg-opacity-75"
                >Transactions</a
              >
            </div>
            <div class="pt-4 pb-3 border-t border-sky-700">
              <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                  <!-- <img
                    class="w-10 h-10 rounded-full"
                    src="https://avatars.githubusercontent.com/u/831997"
                    alt="" /> -->
                  <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-sky-100">
                    <span class="font-medium leading-none text-sky-700"
                      ><?php echo get2Intial($_SESSION['name']) ;?></span
                    >
                  </span>
                </div>
                <div class="ml-3">
                  <div class="text-base font-medium text-white">
                  <?php echo $_SESSION['name'] ;?>
                  </div>
                  <div class="text-sm font-medium text-sky-300">
                  <?php echo $_SESSION['email'] ;?>
                  </div>
                </div>
                <button
                  type="button"
                  class="flex-shrink-0 p-1 ml-auto rounded-full bg-green-600 text-sky-200 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-sky-600">
                  <span class="sr-only">View notifications</span>
                  <svg
                    class="w-6 h-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                  </svg>
                </button>
              </div>
              <div class="px-2 mt-3 space-y-1">
                <a
                  href="#"
                  class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-sky-500 hover:bg-opacity-75"
                  >Sign out</a
                >
              </div>
            </div>
          </div>
        </nav>

        <header class="py-10">
          <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">
              Customers
            </h1>
          </div>
        </header>
      </div>

      <main class="-mt-32">
        <div class="px-4 pb-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="py-8 bg-white rounded-lg">
            <!-- List of All The Customers -->
            <div class="px-4 sm:px-6 lg:px-8">
              <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                  <p class="mt-2 text-sm text-gray-600">
                    A list of all the customers including their name, email and
                    profile picture.
                  </p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                  <a
                    href="./add_customer.php"
                    type="button"
                    class="block px-3 py-2 text-sm font-semibold text-center text-white rounded-md shadow-sm bg-sky-600 hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                    Add Customer
                  </a>
                </div>
              </div>

              <!-- Users List -->
              <div class="flow-root mt-8">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <ul
                    role="list"
                    class="divide-y divide-gray-100">
                    <?php 
                      foreach ($filteredUsers as $userData): ?>
                        <li
                      class="relative flex justify-between px-4 py-5 gap-x-6 hover:bg-gray-50 sm:px-6 lg:px-8">
                      <div class="flex gap-x-4">
                        <!-- You can either use image or name initials as avatar -->
                        <!-- <img
                          class="flex-none w-12 h-12 rounded-full bg-gray-50"
                          src="https://avatars.githubusercontent.com/u/61485238"
                          alt="Al Nahian" /> -->
                        <span
                          class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-<?php echo $userData['color'] ?>-500">
                          <span
                            class="text-xl font-medium leading-none text-white"
                            ><?php echo get2Intial($userData['name'])?></span
                          >
                        </span>

                        <div class="flex-auto min-w-0">
                          <p
                            class="text-sm font-semibold leading-6 text-gray-900">
                            <a href="./customer_transactions.php?<?php echo $userData['user_id'] ?>">
                              <span
                                class="absolute inset-x-0 bottom-0 -top-px"></span>
                                <?php echo $userData['name'] ;?>
                            </a>
                          </p>
                          <p class="flex mt-1 text-xs leading-5 text-gray-500">
                            <a
                              href="./customer_transactions.php?<?php echo $userData['user_id'] ?>"
                              class="relative truncate hover:underline"
                              ><?php echo $userData['email'] ;?></a
                            >
                          </p>
                        </div>
                      </div>
                    </li>
                        <?php endforeach; ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
