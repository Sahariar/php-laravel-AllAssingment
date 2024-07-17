<?php
function sanitizeInput($data):string{
    return htmlspecialchars(stripslashes(trim($data)));
}

function dd($data): void
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
function getSiteURL() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    return $protocol . $domainName;
}
function get2Intial($fullname)
{
// Split the full name into parts
$nameParts = explode(" ", $fullname);

// Initialize an empty string for initials
$initials = "";

// Loop through each part of the name
foreach ($nameParts as $part) {
    // Append the first character of each part to initials
    $initials .= strtoupper(substr($part, 0, 1));
}
    return $initials;
}

function getRandomColor() {
    $tailwindColors = [
        "slate", "gray", "zinc", "neutral", "stone",
        "red", "orange", "amber", "yellow", "lime",
        "green", "emerald", "teal", "cyan", "sky",
        "blue", "indigo", "violet", "purple", "fuchsia",
        "pink", "rose"
    ];

    // Pick a random color
    $randomColor = $tailwindColors[array_rand($tailwindColors)];

    return $randomColor;
}