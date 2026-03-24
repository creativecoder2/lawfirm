<?php
// PayPro Detailed Debug Script
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
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36");
    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    echo "HTTP Code: " . $info['http_code'] . "\n";
    echo "Content Type: " . $info['content_type'] . "\n";
    echo "Response Snippet (first 500 chars):\n" . substr($response, 0, 1000) . "\n\n";
}

// 1. V2 Login - Client ID/Secret in Headers (Original)
test_login($base_url . '/v2/login', 'POST', [
    'client_id: ' . $client_id,
    'client_secret: ' . $client_secret,
    'Content-Type: application/json'
], null, "V2 Login - Headers (client_id, client_secret)");

// 2. V2 Login - ClientId/ClientSecret in Headers (Cased)
test_login($base_url . '/v2/login', 'POST', [
    'ClientId: ' . $client_id,
    'ClientSecret: ' . $client_secret,
    'Content-Type: application/json'
], null, "V2 Login - Headers (ClientId, ClientSecret)");

// 3. V2 Login - JSON Body (client_id, client_secret)
test_login($base_url . '/v2/login', 'POST', [
    'Content-Type: application/json'
], json_encode(['client_id' => $client_id, 'client_secret' => $client_secret]), "V2 Login - Body (client_id, client_secret)");

// 4. V2 Login - JSON Body (ClientId, ClientSecret)
test_login($base_url . '/v2/login', 'POST', [
    'Content-Type: application/json'
], json_encode(['ClientId' => $client_id, 'ClientSecret' => $client_secret]), "V2 Login - Body (ClientId, ClientSecret)");

// 5. V2 Login - JSON Body (username, password)
test_login($base_url . '/v2/login', 'POST', [
    'Content-Type: application/json'
], json_encode(['username' => $username, 'password' => $password]), "V2 Login - Body (username, password)");

// 6. V2 Login - JSON Body (MerchantId, MerchantPassword)
test_login($base_url . '/v2/login', 'POST', [
    'Content-Type: application/json'
], json_encode(['MerchantId' => $username, 'MerchantPassword' => $password]), "V2 Login - Body (MerchantId, MerchantPassword)");

?>
