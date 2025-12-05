<?php
// File: order_confirmation.php
// Purpose: Displays confirmation and order summary after successful checkout, with dynamic theming.

session_start();

// --- 0. Determine Theme and Set Colors ---
// Assume the theme ('women' or 'men') is stored in the session by the previous page (e.g., checkout.php)
$current_theme = $_SESSION['theme'] ?? 'women';

if ($current_theme === 'men') {
    // Teal Green Theme for Men's Section
    $primary_color = '#008080'; // Teal Green
    $accent_color = '#005050';  // Darker Teal
    $light_bg = '#E0FFFF';      // Light Cyan/Teal Background
    $redirect_page = 'men.php';
} else {
    // Pink Theme for Women's Section (Default)
    $primary_color = '#008080'; // Teal Green
    $accent_color = '#005050';  // Darker teal
    $light_bg = '#E0FFFF';      // Light Cyan
    $redirect_page = 'women.php';
}

// --- 1. Order Status Check ---
// SECURITY CHECK: Ensures the user was redirected here after a successful order and didn't access directly.
if (!isset($_SESSION['order_success']) || $_SESSION['order_success'] !== true) {
    // If no success flag is set, redirect the user back to the correct home page.
    header("Location: $redirect_page"); 
    exit;
}

// --- 2. Retrieve Order Details and Clear Flags ---
$final_total = $_SESSION['last_order_total'] ?? 0;

// Retrieve the payment method stored during checkout
$payment_method = $_SESSION['last_order_payment_method'] ?? 'cod'; 

// Clear the session flags
unset($_SESSION['order_success']);
unset($_SESSION['last_order_total']);
unset($_SESSION['last_order_payment_method']); 
unset($_SESSION['theme']); // Clear theme once used

// Generate a dummy Order ID (In a real application, this ID must be fetched from the database)
$order_id = 'ORD-' . time() . rand(100, 999);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed! - Thank You</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Dynamic Theme Variables */
            --theme-primary: <?php echo $primary_color; ?>; 
            --theme-accent: <?php echo $accent_color; ?>;
            --theme-background: <?php echo $light_bg; ?>; 

            /* Static Variables */
            --cod-yellow: #fbc02d;
            --cod-light-bg: #fffde7;
            --text-dark: #333;
            --text-light: #666;
            --border-light: #ddd;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background-color: var(--theme-background);
            margin: 0;
            padding: 20px;
            color: var(--text-dark);
            text-align: center;
        }

        .confirmation-box {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            /* Border uses the dynamic primary color */
            border: 5px solid var(--theme-primary); 
        }

        .success-icon {
            /* Icon color uses the dynamic primary color */
            color: var(--theme-primary); 
            font-size: 5rem;
            margin-bottom: 20px;
            /* Simple pulse animation for visual confirmation */
            animation: pulse 1s infinite alternate;
        }
        @keyframes pulse {
            from { transform: scale(1); }
            to { transform: scale(1.05); }
        }

        h1 {
            /* Heading color uses the dynamic accent color */
            color: var(--theme-accent); 
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.1em;
            color: var(--text-light);
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .order-details {
            text-align: left;
            padding: 20px;
            /* Details background is slightly lighter themed background */
            background-color: var(--theme-background);
            border-radius: 10px;
            margin-bottom: 30px;
            /* Details border uses the dynamic primary color */
            border: 1px solid var(--theme-primary);
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed var(--border-light);
        }
        .detail-row:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 1.2em;
            color: var(--text-dark);
        }
        .detail-row span:first-child {
            font-weight: 600;
            /* Keys in the details summary use the accent color */
            color: var(--theme-accent); 
        }
        
        .payment-message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 1.1em;
        }

        /* Styling for Cash on Delivery (COD is neutral/yellow) */
        .cod {
            background-color: var(--cod-light-bg); 
            color: var(--cod-yellow); 
            border: 2px solid var(--cod-yellow);
        }
        /* Styling for Successful Online Payment (Themed) */
        .online {
            background-color: var(--theme-background); 
            color: var(--theme-accent);
            border: 2px solid var(--theme-accent);
        }

        .action-button {
            padding: 15px 30px;
            /* Button uses the dynamic primary color */
            background-color: var(--theme-primary); 
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1.1em;
            font-weight: 700;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-block;
            /* Box shadow uses the dynamic primary color */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Adjusted for better visibility */
        }
        .action-button:hover {
            background-color: var(--theme-accent); /* Hover uses the darker accent color */
            transform: translateY(-2px);
        }
        
        /* Mobile optimization */
        @media (max-width: 600px) {
            .confirmation-box {
                margin: 20px auto;
                padding: 20px;
            }
            h1 { font-size: 2em; }
            .success-icon { font-size: 4rem; }
        }
    </style>
</head>
<body>

    <div class="confirmation-box">
        <div class="success-icon">&#x2713;</div>
        <h1>Order Confirmed!</h1>

        <?php 
        // Logic to check if the payment method implies online payment was successful
        if ($payment_method != 'cod'): 
        ?>
            <!-- Online Payment Confirmation Message -->
            <p>
                Your order has been placed successfully. Your <strong>online payment</strong> has also been received.
                You will receive a tracking link via email shortly.
            </p>
            <div class="payment-message online">
                PAYMENT STATUS: Online Payment of ₹<?php echo number_format($final_total); ?> Successful.
            </div>
        <?php else: ?>
            <!-- COD Confirmation Message -->
            <p>
                Your order has been placed successfully. Your shipment will be processed shortly.
                Please keep <strong>₹<?php echo number_format($final_total); ?></strong> ready for payment upon delivery.
            </p>
            <div class="payment-message cod">
                PAYMENT METHOD: Cash on Delivery (Payment Pending)
            </div>
        <?php endif; ?>

        <!-- Order Details Summary -->
        <div class="order-details">
            <div class="detail-row">
                <span>Order ID:</span> 
                <span><?php echo htmlspecialchars($order_id); ?></span>
            </div>
            <div class="detail-row">
                <span>Payment Method:</span> 
                <span><?php echo ($payment_method == 'cod') ? 'Cash on Delivery' : 'Online Payment (' . strtoupper($payment_method) . ')'; ?></span>
            </div>
            <div class="detail-row">
                <span>Total Amount:</span> 
                <span>₹<?php echo number_format($final_total); ?></span>
            </div>
        </div>

        <a href="nav.php" class="action-button">Continue Shopping</a>
    </div>

</body>
</html>