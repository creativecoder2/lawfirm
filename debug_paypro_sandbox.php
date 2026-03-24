<?php
// PayPro Sandbox Debug
$client_id = "FfiqGwzq12VjOAQ";
$client_secret = "WOlLpIijIYGSZRT";
$base_url = "https://sandbox.paypro.com.pk";

echo "Testing V2 Sandbox Login:\n";
$ch = curl_init($base_url . '/v2/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'client_id: ' . $client_id,
    'client_secret: ' . $client_secret,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_HEADER, true);
$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
echo "HTTP Code: " . $info['http_code'] . "\n";
echo "Response:\n" . $response . "\n";
?>
