<?php 
session_start();
include __DIR__ .'/utilities/db.php';
include __DIR__ .'/utilities/helper.php';
// dd($_SESSION);
// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
$feebacks = getFeedbacksById($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TruthWhisper - Anonymous Feedback App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<header class="bg-white">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="./index.php" class="-m-1.5 p-1.5">
                <span class="sr-only">TruthWhisper</span>
                <span class="block font-bold text-lg bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">TruthWhisper</span>
            </a>
        </div>
        <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end ">
        <span class="text-sm font-semibold leading-6 text-gray-900 px-3 py-2">Welcome Back , <?php 
                echo $_SESSION['name'];
            ?></span>
        <a href="logout.php" class="block rounded-md px-3 py-2 text-base font-medium text-black hover:bg-green-900 hover:text-white hover:bg-opacity-75">Sign
        out</a>
        </div>
    </nav>
    
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-10"></div>
        <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
                <a href="./index.php" class="-m-1.5 p-1.5">
                    <span class="sr-only">TruthWhisper</span>
                    <span class="block font-bold text-xl bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">TruthWhisper</span>
                </a>
                <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="py-6">
                        <span class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"><?php 
                echo $_SESSION['name'];
            ?></span>
                    </div>
                    <div class="py-6">
                    <a href="logout.php" class="block rounded-md px-3 py-2 text-base font-medium text-black hover:bg-green-900 hover:text-white hover:bg-opacity-75">Sign
                    out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="">
    <div class="relative flex min-h-screen overflow-hidden bg-gray-50 py-6 sm:py-12">
        <img src="./images/beams.jpg" alt="" class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
        <div class="absolute inset-0 bg-[url(./images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>

        <div class="relative max-w-7xl mx-auto">
            <div class="flex justify-end">
                <span class="flex text-gray-600 font-mono border border-gray-400 rounded-xl px-2 py-1"> Your feedback form link: 
                <a class="block text-gray-600 hover:text-green-900" href="<?php echo getSiteURL()?>/feedback.php?<?php echo $_SESSION['user_id']?>">
                    <strong>
                        <?php echo getSiteURL()?>/feedback.php?<?php echo $_SESSION['user_id']?>
                    </strong>
                </a>
                </span>
            </div>
            <h1 class="text-xl text-indigo-800 text-bold my-10">Received feedback</h1>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <?php 
                    if (!empty($feebacks)) {
                        foreach ($feebacks as $feedback) {
                            echo'<div class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">';
                    echo '<div class="focus:outline-none">';
                    echo '<p class="text-gray-500">'. $feedback .'</p>'.'</div>';
                    echo '</div>';
                        }
                    } else {
                        echo "No Feedback found.";
                    }
                    ?>
            </div>
        </div>

    </div>
</main>

<footer class="bg-white">
    <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center justify-center lg:px-8">
        <p class="text-center text-xs leading-5 text-gray-500">&copy; 2024 TruthWhisper, Inc. All rights reserved.</p>
    </div>
</footer>

</body>
</html>