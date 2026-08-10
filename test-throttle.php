<?php
/**
 * Checkout Throttle Test Script in PHP
 * Tests Laravel's `throttle:5,1` route middleware on POST /checkout
 * Run: php test-throttle.php
 */

$baseUrl = 'http://127.0.0.1:8000';
$cookieFile = sys_get_temp_dir() . '/laravel_cookie.txt';
if (file_exists($cookieFile)) {
    unlink($cookieFile);
}

echo "\n============================================================\n";
echo " 🚀 Testing Checkout Rate Limiter (throttle:5,1)\n";
echo "============================================================\n\n";
echo "Step 1: Fetching CSRF Token & Session Cookie from $baseUrl/en ...\n";

// Step 1: Initial GET request to home page to obtain session & CSRF token
$ch = curl_init("$baseUrl/en");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_COOKIEJAR      => $cookieFile,
    CURLOPT_COOKIEFILE     => $cookieFile,
]);
$html = curl_exec($ch);
curl_close($ch);

// Extract CSRF token from data-csrf or meta tag or _token input
$csrfToken = '';
if (preg_match('/data-csrf="([^"]+)"/i', $html, $matches)) {
    $csrfToken = $matches[1];
} elseif (preg_match('/<meta name="csrf-token" content="([^"]+)"/i', $html, $matches)) {
    $csrfToken = $matches[1];
} elseif (preg_match('/name="_token"\s+value="([^"]+)"/i', $html, $matches)) {
    $csrfToken = $matches[1];
}

echo "CSRF Token obtained: " . ($csrfToken ? "YES (" . substr($csrfToken, 0, 15) . "...)" : "NO") . "\n\n";

$totalRequests = 7;
$postUrl = "$baseUrl/en/checkout";
echo "Step 2: Sending $totalRequests rapid POST requests to $postUrl\n";
echo "(Route Limit: 5 requests per 1 minute)\n";
echo "------------------------------------------------------------\n";

for ($i = 1; $i <= $totalRequests; $i++) {
    $ch = curl_init($postUrl);
    
    $payload = json_encode([
        'first_name' => 'Test',
        'last_name'  => 'User',
        'phone'      => '0555000000',
        'address'    => 'Test Address',
        '_token'     => $csrfToken
    ]);

    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_COOKIEJAR      => $cookieFile,
        CURLOPT_COOKIEFILE     => $cookieFile,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Accept: application/json',
            'X-CSRF-TOKEN: ' . $csrfToken,
            'X-Requested-With: XMLHttpRequest'
        ]
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Parse headers
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headersRaw = substr($response, 0, $headerSize);
    
    $remaining = 'N/A';
    if (preg_match('/X-RateLimit-Remaining:\s*(\d+)/i', $headersRaw, $matches)) {
        $remaining = $matches[1];
    }
    
    $retryAfter = 'N/A';
    if (preg_match('/Retry-After:\s*(\d+)/i', $headersRaw, $matches)) {
        $retryAfter = $matches[1] . 's';
    }

    if ($httpCode === 429) {
        echo "Req #$i: 🛑 [THROTTLED] HTTP 429 Too Many Requests | Remaining: $remaining | Retry-After: $retryAfter\n";
    } else {
        echo "Req #$i: ✅ HTTP $httpCode | Remaining Attempts: $remaining\n";
    }

    curl_close($ch);
    usleep(50000); // 50ms delay
}

if (file_exists($cookieFile)) {
    unlink($cookieFile);
}

echo "------------------------------------------------------------\n";
echo "✨ Throttle Test Completed Successfully!\n\n";
