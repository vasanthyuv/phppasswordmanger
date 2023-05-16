<?php

// Define the list of allowed IP addresses
$allowed_ips = array(
    '2001:0db8:85a3:0000:0000:8a2e:0370:7334',
    '2001:0db8:85a3:0000:0000:8a2e:0370:7335',
    '2409:4072:2d8e:3c7e:7557:bccd:8c4f:6662',
    '2409:4072:2d8e:3c7e:fdc7:2133:8ea4:9a96',
    '106.51.50.95'
);

// Get the IP address of the user making the request
$user_ip = $_SERVER['REMOTE_ADDR'];

// Check whether the user's IP address is in the list of allowed addresses
$allowed = false;
foreach ($allowed_ips as $allowed_ip) {
    if ($user_ip == $allowed_ip) {
        $allowed = true;
        break;
    }
}

// If the user's IP address is not allowed, deny access
if (!$allowed) {
    echo "Access denied for IP address: $user_ip";
    exit;
}

// If the user's IP address is allowed, redirect to another page
header("Location: https://vasanth12345.000webhostapp.com/mainpage.html");
exit;
?>