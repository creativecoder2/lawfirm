<?php
$client_id = "FfiqGwzq12VjOAQ";
$client_secret = "WOlLpIijIYGSZRT";
$user = "LE_Law_Firm";
$pass = "Live@LELaw26Firm";

$url = "https://api.paypro.com.pk/v2/login";

$tests = [
    ['headers' => ["client_id: $client_id", "client_secret: $client_secret"], 'body' => ''],
    ['headers' => ["client_id: $user", "client_secret: $pass"], 'body' => ''],
    ['headers' => ["Content-Type: application/json"], 'body' => json_encode(['client_id' => $client_id, 'client_secret' => $client_secret])],
    ['headers' => ["Content-Type: application/json"], 'body' => json_encode(['username' => $user, 'password' => $pass, 'client_id' => $client_id, 'client_secret' => $client_secret])],
];

foreach ($tests as $i => $test) {
    echo "Test $i ...\n";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $test['headers']);
    if ($test['body']) curl_setopt($ch, CURLOPT_POSTFIELDS, $test['body']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "HTTP Code: $http_code\n";
    if (stripos($response, "token:") !== false || stripos($response, '"token"') !== false) {
        echo "SUCCESS!\n";
        echo $response . "\n";
    }
    echo "-------------------\n";
}
?>
