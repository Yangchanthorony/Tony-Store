<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CRITICAL: This Meta Tag is required for Laravel POST requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Checkout Page</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; display: grid; place-items: center; min-height: 100vh; background: #f4f7f6; }
        .card { background: #fff; border-radius: 12px; padding: 2rem; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center; }
        h1 { margin-top: 0; }
        #checkout-btn {
            background: #007bff; color: white; border: none; padding: 12px 24px;
            border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;
            transition: background 0.2s;
        }
        #checkout-btn:hover { background: #0056b3; }
        #checkout-btn:disabled { background: #ccc; cursor: not-allowed; }
        #status-message { margin-top: 1rem; font-weight: 500; text-align: left; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    

    <div class="card">
        <h1>Your Cart</h1>
        <p>You have 2 items in your cart.</p>
        <ul style="text-align: left;">
            <li>Product A (x1)</li>
            <li>Product B (x2)</li>
        </ul>
        <button id="checkout-btn" onclick="checkout()">
            Pay Now & Send to Telegram
        </button>
        <p id="status-message"></p>
    </div>

    <script>
        // This is your dummy cart. In your real app, you would build this dynamically.
        const cartData = [
            {
                itemName: "Skincare Serum",
                quantity: 1,
                price: 45.50
            },
            {
                itemName: "Vitamin C Cream",
                quantity: 2,
                price: 22.00
            }
        ];

        // Get the button and message elements
        const checkoutButton = document.getElementById('checkout-btn');
        const statusMessage = document.getElementById('status-message');

        async function checkout() {
            // Disable button to prevent multiple clicks
            checkoutButton.disabled = true;
            checkoutButton.innerText = 'Sending...';
            statusMessage.innerText = '';

            try {
                // 1. Get the CSRF token from the meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // 2. Make the fetch request to the route we created
                const response = await fetch("{{ route('telegram.sendOrder') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken // <-- Send the token
                    },
                    body: JSON.stringify({ cart: cartData }) // <-- Send the cart data
                });

                // If the HTTP status is NOT 200/OK, read the response as text to get the full error details
                if (!response.ok) {
                    const errorText = await response.text();
                    
                    // Throw a custom error showing the HTTP status and the error text
                    throw new Error(`Server responded with status ${response.status}. Full error details: ${errorText.substring(0, 300)}... (Check console for full log)`);
                }

                // 3. Get the JSON response from the controller (only if response.ok is true)
                const result = await response.json();

                if (result.status === 'success') {
                    // Success!
                    checkoutButton.innerText = 'Order Sent! ✅';
                    statusMessage.innerText = 'Checkout successful! Check your Telegram.';
                    statusMessage.className = 'success';
                } else {
                    // Handle errors returned by the controller as JSON (e.g., config error)
                    throw new Error(result.details || 'An unknown error occurred.');
                }

            } catch (error) {
                console.error(error);
                // Display the detailed error message
                statusMessage.innerText = `FATAL ERROR: ${error.message}`;
                statusMessage.className = 'error';
                checkoutButton.disabled = false;
                checkoutButton.innerText = 'Pay Now & Send to Telegram';
            }
        }
    </script>

</body>
</html>
