<?php
// Simple script to find outgoing IP address of the server
$ch = curl_init('https://api.ipify.org');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$ip = curl_exec($ch);
curl_close($ch);

echo "<h1>Server IP Identifier</h1>";
echo "<p>Your server's outgoing IP address is: <strong>$ip</strong></p>";
echo "<p>Please copy this IP and whitelist it in your PayPro merchant portal settings.</p>";
?>
