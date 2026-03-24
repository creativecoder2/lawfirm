<?php
$client_id = "FfiqGwzq12VjOAQ";
$client_secret = "WOlLpIijIYGSZRT";
$url = "https://api.paypro.com.pk/v2/login";

$headers = [
    "client_id: $client_id",
    "client_secret: $client_secret",
    "Content-Type: application/json"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true); // Include headers in output
curl_setopt($ch, CURLOPT_VERBOSE, false);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);
curl_close($ch);

echo "HTTP Code: $http_code\n";
echo "Headers:\n$header\n";
echo "Body:\n$body\n";
?>
