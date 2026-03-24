<?php
// PayPro Final Crendentials Debug
$client_id = "FfiqGwzq12VjOAQ";
$client_secret = "WOlLpIijIYGSZRT";
$username = "LE_Law_Firm";
$password = "Live@LELaw26Firm";
$base_url = "https://api.paypro.com.pk";

function test_login($url, $method, $headers, $body = null, $label = "") {
    echo "--- Testing: $label ---\n";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if ($body) curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    echo "HTTP Code: " . $info['http_code'] . "\n";
    echo "Response Snippet:\n" . substr($response, 0, 1000) . "\n\n";
}

// 1. V1 Login - MerchantId/MerchantPassword in Headers
test_login($base_url . '/v1/login', 'POST', [
    'MerchantId: ' . $username,
    'MerchantPassword: ' . $password,
    'Content-Type: application/json'
], null, "V1 Login - Headers (MerchantId, MerchantPassword)");

// 2. V2 Login - client_id/client_secret as Form Props
test_login($base_url . '/v2/login', 'POST', [
    'Content-Type: application/x-www-form-urlencoded'
], http_build_query(['client_id' => $client_id, 'client_secret' => $client_secret]), "V2 Login - Form Body (client_id, client_secret)");

// 3. V2 Login - MerchantId/MerchantPassword in Headers
test_login($base_url . '/v2/login', 'POST', [
    'MerchantId: ' . $username,
    'MerchantPassword: ' . $password,
    'Content-Type: application/json'
], null, "V2 Login - Headers (MerchantId, MerchantPassword)");

?>
