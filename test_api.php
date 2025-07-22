<?php

// Simple API test script
$baseUrl = 'http://127.0.0.1:8000/api';

function makeRequest($url, $method = 'GET', $data = null, $headers = []) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $headers[] = 'Content-Type: application/json';
    }

    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [
        'status' => $httpCode,
        'body' => json_decode($response, true)
    ];
}

echo "=== Sneaker Store API Tests ===\n\n";

// Test 1: Get all shoes (public endpoint)
echo "1. Testing GET /api/shoes\n";
$response = makeRequest($baseUrl . '/shoes');
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";

// Test 2: Get all brands (public endpoint)
echo "2. Testing GET /api/brands\n";
$response = makeRequest($baseUrl . '/brands');
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";

// Test 3: Register a new user
echo "3. Testing POST /api/auth/register\n";
$userData = [
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => 'password123',
    'password_confirmation' => 'password123'
];
$response = makeRequest($baseUrl . '/auth/register', 'POST', $userData);
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";

// Test 4: Login
echo "4. Testing POST /api/auth/login\n";
$loginData = [
    'email' => 'test@example.com',
    'password' => 'password123'
];
$response = makeRequest($baseUrl . '/auth/login', 'POST', $loginData);
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";

$token = null;
if ($response['status'] == 200 && isset($response['body']['data']['token'])) {
    $token = $response['body']['data']['token'];
    echo "Token obtained: " . substr($token, 0, 20) . "...\n\n";

    // Test 5: Get current user
    echo "5. Testing GET /api/auth/me\n";
    $response = makeRequest($baseUrl . '/auth/me', 'GET', null, ['Authorization: Bearer ' . $token]);
    echo "Status: " . $response['status'] . "\n";
    echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";

    // Test 6: Get cart
    echo "6. Testing GET /api/cart\n";
    $response = makeRequest($baseUrl . '/cart', 'GET', null, ['Authorization: Bearer ' . $token]);
    echo "Status: " . $response['status'] . "\n";
    echo "Response: " . json_encode($response['body'], JSON_PRETTY_PRINT) . "\n\n";
}

echo "=== API Tests Completed ===\n";
