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