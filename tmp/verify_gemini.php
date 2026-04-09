<?php
// Verification script for Gemini API fallback
$api_key = "AIzaSyA0nNPUotNOBmGWmhYeOIObqAjfLBnINj8"; // Using the key from the code
$api_url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent";
$url = $api_url . "?key=" . $api_key;

$data = [
    "contents" => [
        ["role" => "user", "parts" => [["text" => "Hello, are you working? Respond with 'Yes, connection successful'"]]]
    ]
];

$response = false;
$http_code = 0;

echo "Checking cURL extension...\n";
if (extension_loaded('curl')) {
    echo "cURL is LOADED. Using cURL...\n";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
} elseif (ini_get('allow_url_fopen')) {
    echo "cURL is MISSING. Using file_get_contents fallback...\n";
    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
            'ignore_errors' => true,
            'timeout' => 20
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ];
    $context  = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);
    if ($response !== false) {
        if (isset($http_response_header) && preg_match('{HTTP\/\S*\s(\d{3})}', $http_response_header[0], $match)) {
            $http_code = (int)$match[1];
        }
    }
} else {
    echo "ERROR: Neither cURL nor allow_url_fopen are available.\n";
    exit(1);
}

echo "HTTP Code: $http_code\n";
if ($http_code == 200 && $response) {
    echo "SUCCESS! Response received:\n";
    $res_obj = json_decode($response, true);
    if (isset($res_obj['candidates'][0]['content']['parts'][0]['text'])) {
        echo $res_obj['candidates'][0]['content']['parts'][0]['text'] . "\n";
    } else {
        echo "Response format unknown or empty.\n";
        print_r($res_obj);
    }
} else {
    echo "FAILURE! API returned code $http_code\n";
    echo "Response: $response\n";
}
