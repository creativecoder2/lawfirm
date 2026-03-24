<?php
// PayPro Debug Script
$client_id = "FfiqGwzq12VjOAQ";
$client_secret = "WOlLpIijIYGSZRT";
$base_url = "https://api.paypro.com.pk";

echo "Testing V2 Login with Headers:\n";
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
echo "Response:\n" . $response . "\n\n";

echo "Testing V2 Login with Body Params:\n";
$ch = curl_init($base_url . '/v2/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
$body = json_encode(['client_id' => $client_id, 'client_secret' => $client_secret]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_HEADER, true);
$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
echo "HTTP Code: " . $info['http_code'] . "\n";
echo "Response:\n" . $response . "\n\n";

echo "Testing V1 Login (Username/Password):\n";
$ch = curl_init($base_url . '/v1/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'username: LE_Law_Firm',
    'password: Live@LELaw26Firm',
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_HEADER, true);
$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
echo "HTTP Code: " . $info['http_code'] . "\n";
echo "Response:\n" . $response . "\n\n";
?>
