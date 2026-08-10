/**
 * Checkout Rate Limit Test Script
 * --------------------------------
 * This script sends multiple rapid POST requests to the checkout endpoint
 * to test Laravel's `throttle:5,1` middleware.
 *
 * How to run with Node.js:
 *   node test-checkout-throttle.js
 *
 * Or paste the Browser Console snippet at the bottom of this file directly
 * into your browser DevTools console while on the website!
 */

const http = require('http');

const TARGET_URL = 'http://127.0.0.1:8000/checkout';
const TOTAL_REQUESTS = 7;

console.log(`\n🚀 Starting Throttle Test on: ${TARGET_URL}`);
console.log(`Sending ${TOTAL_REQUESTS} rapid POST requests (Limit is 5 per minute)...\n`);

async function sendPostRequest(requestNum) {
    return new Promise((resolve) => {
        const url = new URL(TARGET_URL);
        
        const payload = JSON.stringify({
            first_name: 'Test',
            last_name: 'User',
            phone: '0555000000',
            address: 'Test Address',
            city: 'Algiers',
            notes: 'Rate limit testing'
        });

        const options = {
            hostname: url.hostname,
            port: url.port || 8000,
            path: url.pathname,
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Length': Buffer.byteLength(payload)
            }
        };

        const req = http.request(options, (res) => {
            let data = '';
            res.on('data', (chunk) => { data += chunk; });
            res.on('end', () => {
                const remaining = res.headers['x-ratelimit-remaining'] || 'N/A';
                const retryAfter = res.headers['retry-after'] || 'N/A';
                
                let icon = '✅';
                let statusText = `HTTP ${res.statusCode}`;
                
                if (res.statusCode === 429) {
                    icon = '🛑 [THROTTLED]';
                    statusText += ' - Too Many Requests';
                } else if (res.statusCode >= 500) {
                    icon = '⚠️';
                }

                console.log(
                    `Req #${requestNum}: ${icon} Status: ${statusText} | Remaining Attempts: ${remaining} | Retry-After: ${retryAfter}s`
                );
                
                resolve({ status: res.statusCode, body: data });
            });
        });

        req.on('error', (err) => {
            console.error(`Req #${requestNum}: ❌ Error: ${err.message}`);
            resolve({ error: err });
        });

        req.write(payload);
        req.end();
    });
}

async function runTest() {
    for (let i = 1; i <= TOTAL_REQUESTS; i++) {
        await sendPostRequest(i);
        // Small delay between requests
        await new Promise((r) => setTimeout(r, 100));
    }
    
    console.log('\n✨ Test Complete!\n');
}

runTest();

/* =========================================================================
   BROWSER CONSOLE SNIPPET (Copy & paste into browser console on localhost)
   =========================================================================

async function testCheckoutThrottle() {
    console.log("🚀 Testing Checkout Rate Limiter (throttle:5,1)...");
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    
    for (let i = 1; i <= 7; i++) {
        try {
            const response = await fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    first_name: 'Test',
                    last_name: 'User',
                    phone: '0555000000',
                    address: 'Test Address'
                })
            });
            
            const remaining = response.headers.get('X-RateLimit-Remaining');
            if (response.status === 429) {
                console.log(`Req #${i}: 🛑 THROTTLED! HTTP 429 (Too Many Requests). Remaining: ${remaining}`);
            } else {
                console.log(`Req #${i}: ✅ HTTP ${response.status}. Remaining: ${remaining}`);
            }
        } catch (err) {
            console.error(`Req #${i}: ❌ Error`, err);
        }
    }
}
testCheckoutThrottle();

========================================================================= */
