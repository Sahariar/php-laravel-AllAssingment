<?php

?>
<!DOCTYPE html>
<html class="h-full bg-slate-100" lang="en">

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

  <title>Bangubank</title>
</head>

<body class="flex flex-col items-baseline justify-center min-h-screen">
  <section class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-12">
    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight 
        text-gray-900 md:text-5xl lg:text-6xl">
        <span
                        class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100">
                        <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 512 512" xml:space="preserve" fill="#10b981"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css">  .st0{fill:#065f46;}  </style> <g> <path class="st0" d="M162.969,480.609c-0.688-0.703-1.406-1.313-2.094-1.828c-0.719-0.5-1.75-1.125-3.094-1.813 c5.641-3.141,8.469-7.969,8.469-14.5c0-2.875-0.5-5.469-1.5-7.781s-2.406-4.281-4.219-5.906c-1.828-1.625-4.063-2.891-6.688-3.781 c-2.625-0.906-5.531-1.344-8.719-1.344h-27.469V512h28.625c3.188,0,6.094-0.469,8.688-1.391s4.781-2.234,6.625-3.938 c1.813-1.703,3.203-3.734,4.156-6.141c0.969-2.406,1.453-5.109,1.453-8.125c0-2.422-0.328-4.594-1.016-6.516 C165.516,483.969,164.438,482.219,162.969,480.609z M131,455.563h13.063c2.75,0,4.906,0.688,6.484,2.094 c1.563,1.406,2.359,3.344,2.359,5.766c0,2.438-0.797,4.359-2.359,5.766c-1.578,1.406-3.734,2.109-6.484,2.109H131V455.563z M151.453,497.844c-1.609,1.5-3.766,2.25-6.516,2.25H131v-16.797h13.938c2.75,0,4.906,0.734,6.516,2.203s2.391,3.531,2.391,6.156 S153.063,496.344,151.453,497.844z"></path> <path class="st0" d="M207.813,443.656L182.938,512h13.922L201,499.906h24.281L229.313,512h13.906l-24.953-68.344H207.813z M204.734,488.672l8.641-24.859l8.344,24.859H204.734z"></path> <polygon class="st0" points="300.25,485.5 273.188,443.656 261.281,443.656 261.281,512 274.625,512 274.625,470.047 301.688,512 313.594,512 313.594,443.656 300.25,443.656 "></polygon> <polygon class="st0" points="392.703,443.656 376.469,443.656 352.375,473.406 352.375,443.656 339.031,443.656 339.031,512 352.375,512 352.375,491.453 361.219,480.906 378.781,512 394.344,512 370.047,470.813 "></polygon> <polygon class="st0" points="256,0 64,69.344 64,109.344 80,109.344 80,121.344 432,121.344 432,109.344 448,109.344 448,69.344 "></polygon> <polygon class="st0" points="432,357.344 80,357.344 80,389.344 64,389.344 64,421.344 448,421.344 448,389.344 432,389.344 "></polygon> <polygon class="st0" points="344,325.344 344,341.344 408,341.344 408,325.344 400,325.344 400,153.344 408,153.344 408,137.344 344,137.344 344,153.344 352,153.344 352,325.344 "></polygon> <polygon class="st0" points="224,325.344 224,341.344 288,341.344 288,325.344 280,325.344 280,153.344 288,153.344 288,137.344 224,137.344 224,153.344 232,153.344 232,325.344 "></polygon> <polygon class="st0" points="104,325.344 104,341.344 168,341.344 168,325.344 160,325.344 160,153.344 168,153.344 168,137.344 104,137.344 104,153.344 112,153.344 112,325.344 "></polygon> </g> </g></svg>
                      </span>
        Bang<span class="text-emerald-500">u</span>Bank
    
    </h1>

    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48">
      BanguBank is a simple banking application with features for both 'Admin'
      and 'Customer' users. It's a HTML template starter pack for students of
      <span class="font-semibold">Laravel Career Path by Interactive Cares</span>.
    </p>
    <div class="flex flex-col gap-2 mb-8 lg:mb-16 md:flex-row md:justify-center">
      <a href="./login.php" type="button" class="text-white bg-sky-700 
      hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium 
      rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
        Login as Customer
      </a>

      <a href="./register.php" type="button" class="text-white 
      bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 
      font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
        Register as Customer
      </a>
      <a href="./admin/customers.php" type="button" class="text-white 
      bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 
      font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
        Admin View
      </a>
      <a href="./customer/dashboard.php" type="button" class="text-white 
      bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 
      font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
        Customer View
      </a>
    </div>
  </section>
</body>

</html>