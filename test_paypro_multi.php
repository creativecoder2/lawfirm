<?php
$client_id = "FfiqGwzq12VjOAQ";
$client_secret = "WOlLpIijIYGSZRT";
$base = "https://api.paypro.com.pk";

$endpoints = [
    "/v2/login",
    "/api/v2/login",
    "/v2/GetToken",
    "/api/v2/GetToken",
    "/v1/login",
    "/api/v1/login"
];

foreach ($endpoints as $ep) {
    $url = $base . $ep;
    echo "Testing $url ...\n";
    $headers = [
        "client_id: $client_id",
        "client_secret: $client_secret",
        "Content-Type: application/json"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "HTTP Code: $http_code\n";
    if ($http_code == 200) {
        if (stripos($response, "token:") !== false || stripos($response, '"token"') !== false) {
            echo "SUCCESS: Found token in response!\n";
            echo substr($response, 0, 1000) . "\n";
            break;
        } else {
            echo "Body length: " . strlen($response) . "\n";
        }
    }
    echo "-------------------\n";
}
?>
