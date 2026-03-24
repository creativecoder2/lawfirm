<?php
// PayPro Route Discovery Script
$client_id = "FfiqGwzq12VjOAQ";
$client_secret = "WOlLpIijIYGSZRT";
$base_url = "https://api.paypro.com.pk";

$routes = [
    '/v2/login',
    '/api/v2/login',
    '/v2/authenticate',
    '/api/v2/authenticate',
    '/v2/token',
    '/api/v2/token'
];

foreach ($routes as $route) {
    echo "--- Testing: $route ---\n";
    $ch = curl_init($base_url . $route);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'client_id: ' . $client_id,
        'client_secret: ' . $client_secret,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
    $response = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    curl_close($ch);
    echo "HTTP Code: $code, Content-Type: $type\n";
    if (strpos($type, 'json') !== false) {
        echo "JSON RESPONSE FOUND!\n";
        echo $response . "\n";
    } else {
        echo "Snippet: " . substr(strip_tags($response), 0, 100) . "...\n";
    }
    echo "\n";
}
?>
