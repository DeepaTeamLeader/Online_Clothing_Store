<?php
// File: checkout.php

// Start the session to manage the user's shopping cart and order status
session_start();

$cart_items = $_SESSION['cart'] ?? [];
$grand_total = 0;
// Shipping fee is 70 if cart has items, otherwise 0
$shipping_fee = count($cart_items) > 0 ? 70 : 0;
$total_payable = 0;

// --- 1. Handle 'quickbuy' from product_detail.html ---
// यह लॉजिक quickbuy के लिए पूरे सेशन कार्ट को अस्थायी रूप से एक आइटम से बदल देता है।
if (isset($_GET['quickbuy']) && $_GET['quickbuy'] == 'true' && isset($_GET['product_id']) && isset($_GET['size'])) {
    $product_id = htmlspecialchars($_GET['product_id']);
    $selected_size = htmlspecialchars($_GET['size']);
    
    // Placeholder Product Details - Real-world application में, आपको $product_id का उपयोग करके डेटाबेस से विवरण लाना होगा।
    $quick_buy_product_name = "Black Cotton Crop Top"; 
    $quick_buy_product_price = 999; 
    
    // Quickbuy आइटम के साथ cart_items को ओवरराइट करें
    $cart_items = [[
        'id' => $product_id,
        'name' => $quick_buy_product_name,
        'price' => $quick_buy_product_price,
        'size' => $selected_size,
        'quantity' => 1
    ]];
    $_SESSION['cart'] = $cart_items; // सेशन कार्ट को अपडेट करें
    $shipping_fee = 70; // Quickbuy के लिए भी शिपिंग शुल्क लागू करें
}

// --- 2. Calculate Totals ---
foreach ($cart_items as $item) {
    // सुरक्षित गणना के लिए डेटा को संख्यात्मक रूप से सुनिश्चित करें
    $price = is_numeric($item['price'] ?? 0) ? (int)$item['price'] : 0;
    $quantity = is_numeric($item['quantity'] ?? 1) ? (int)$item['quantity'] : 1;
    $grand_total += $price * $quantity;
}
$total_payable = $grand_total + $shipping_fee;

// *** Placeholder for Coupon Logic ***
$coupon_discount = 0; // अभी कोई छूट नहीं मान रहे हैं
$final_total = $total_payable - $coupon_discount;

$error_message = null; // Error message को Initialize करें

// Function to simulate saving the order and setting confirmation data
function save_order($details, $items, $total) {
    // 1. In a real application: Database connection and order details saving here.
    
    // 2. Confirmation page के लिए आवश्यक सेशन वेरिएबल्स सेट करें।
    $_SESSION['order_success'] = true;
    $_SESSION['last_order_total'] = $total;
    $_SESSION['last_order_payment_method'] = $details['payment_method'];
    
    return true; // Simulated success
}

// Prepare variables to repopulate form fields (retains user input on error)
$posted_name = htmlspecialchars($_POST['name'] ?? '');
$posted_phone = htmlspecialchars($_POST['phone'] ?? '');
$posted_address = htmlspecialchars($_POST['address'] ?? '');
$posted_payment_method = htmlspecialchars($_POST['payment_method'] ?? 'cod');

// --- 3. Handle Order Submission ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    
    // Collect and sanitize user details
    $user_details = [
        'name' => trim($_POST['name'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'address' => trim($_POST['address'] ?? ''),
        'payment_method' => $_POST['payment_method'] ?? 'cod',
    ];

    // Simple Validation
    if (empty($cart_items)) {
        $error_message = "Cannot place order: Your cart is empty.";
    } elseif (empty($user_details['phone']) || empty($user_details['address']) || empty($user_details['name'])) {
        $error_message = "Please fill in all required shipping fields (Name, Mobile Number, and Address).";
    } elseif (save_order($user_details, $cart_items, $final_total)) {
        // Successful Order Submission
        unset($_SESSION['cart']); // Successful order के बाद कार्ट साफ़ करें
        header('Location: order_confirmation.php'); // Confirmation page पर Redirect करें
        exit;
    } else {
        $error_message = "Order failed due to a server error. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Place Order</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
    
            --primary-pink: #008080 ; /* Bright Pink */
            --accent-pink: #005050; /* Deeper Pink/Red for strong accents */
            --light-pink: #cbf2efff; /* Very light pink background */
            --text-dark: #333;
            --text-light: #666;
            --border-light: #ddd;
            --button-hover: #458c91ff;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background-color: var(--light-pink);
            margin: 0;
            padding: 20px;
            color: var(--text-dark);
        }

        .checkout-container {
            display: flex;
            gap: 30px;
            max-width: 1100px;
            margin: 30px auto;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .shipping-form, .order-summary {
            flex: 1;
        }

        h2 {
            color: var(--primary-pink);
            font-size: 1.8em;
            margin-bottom: 25px;
            border-bottom: 2px solid var(--primary-pink);
            padding-bottom: 10px;
            display: flex;
            align-items: center;
        }
        h2::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: var(--accent-pink);
            border-radius: 50%;
            margin-right: 10px;
        }

        /* --- Form Elements --- */
        input[type="text"],
        input[type="tel"],
        textarea {
            width: calc(100% - 24px); /* Account for padding */
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            font-family: 'Quicksand', sans-serif;
            font-size: 1em;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="tel"]:focus,
        textarea:focus {
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.2);
            outline: none;
        }
        textarea { resize: vertical; min-height: 80px; }

        /* --- Coupon Section --- */
        .coupon-section {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .coupon-section input {
            flex-grow: 1;
            margin-bottom: 0; 
        }
        .coupon-section button {
            padding: 12px 20px;
            background-color: #6c757d; 
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }
        .coupon-section button:hover {
            background-color: #5a6268;
        }

        /* --- Payment Options --- */
        .payment-options {
            margin-top: 20px;
        }
        .payment-method {
            display: block;
            background-color: #f8f8f8;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 1.1em;
        }
        .payment-method:hover {
            background-color: #f0f0f0;
            border-color: var(--primary-pink);
        }
        .payment-method input[type="radio"] {
            margin-right: 10px;
            accent-color: var(--primary-pink); 
            transform: scale(1.2); 
        }

        .place-order-btn {
            width: 100%;
            padding: 18px;
            background-color: var(--accent-pink);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1.2em;
            font-weight: 700;
            cursor: pointer;
            margin-top: 30px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .place-order-btn:hover {
            background-color: var(--button-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* --- Order Summary --- */
        .order-summary {
            background-color: var(--light-pink);
            padding: 30px;
            border-radius: 10px;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        .order-summary p {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 1.1em;
            color: var(--text-light);
        }
        .order-summary p span {
            font-weight: 700;
            color: var(--text-dark);
        }
        .order-summary p.subtotal, .order-summary p.shipping {
            border-top: 1px dashed var(--border-light);
            padding-top: 10px;
            margin-top: 15px;
        }
        .order-summary p.coupon-discount {
            color: green;
            font-weight: 700;
        }

        .final-payable {
            font-size: 1.8em;
            font-weight: 700;
            color: var(--accent-pink);
            border-top: 3px solid var(--accent-pink);
            padding-top: 15px;
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .final-payable span {
            font-size: 1em; /* Keep number size consistent */
        }

        .error-message {
            color: #d9534f; /* Red error message */
            background-color: #fbecec;
            padding: 12px;
            border: 1px solid #d9534f;
            border-radius: 8px;
            margin-bottom: 25px;
            font-weight: 700;
            text-align: center;
        }

        /* --- Responsive Design --- */
        @media (max-width: 768px) {
            .checkout-container {
                flex-direction: column;
                padding: 20px;
                margin: 20px auto;
            }
            .shipping-form, .order-summary {
                flex: none;
                width: 100%;
            }
            h2 { font-size: 1.5em; }
            .final-payable { font-size: 1.5em; }
        }

        /* Header Styles */
        .site-header {
            background: white; 
            padding: 15px 40px; 
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            margin-bottom: 30px;
        }
        .back-link {
            text-decoration: none; 
            color: var(--primary-pink); 
            font-size: 1.2rem; 
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        .back-link:hover { text-decoration: underline; }

        .cart-icon-link {
            position: relative; 
            text-decoration: none; 
            font-size: 1.4em; 
            padding: 8px 15px; 
            border-radius: 8px;
            background-color: var(--primary-pink); 
            color: #ffffff; 
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }
        .cart-icon-link:hover { background-color: var(--button-hover); }

        #cart-count-badge {
            position: absolute;
            top: -8px; 
            right: -8px; 
            background-color: red; 
            color: white;
            font-size: 0.7em; 
            padding: 3px 7px; 
            border-radius: 50%;
            line-height: 1;
            min-width: 18px; 
            text-align: center;
            border: 2px solid white; 
        }
    </style>
</head>
<body>
    <header class="site-header">
        <a href="nav.php" class="back-link">&larr; Back to Categories</a>
        <div>
            <a href="cart.php" class="cart-icon-link">
                &#x1F6D2; 
                <span id="cart-count-badge">
                    <?php 
                        // Display actual cart count from $cart_items array
                        echo count($cart_items); 
                    ?>
                </span>
            </a>
        </div>
    </header>

    <main class="checkout-container">
        
        <form class="shipping-form" action="checkout.php" method="POST">
            
            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
            
            <h2>🚚 Shipping Address & Contact</h2>
            <!-- On error, form fields are repopulated with previously entered data ($posted_name, etc.) -->
            <input type="text" name="name" placeholder="Full Name" required value="<?php echo $posted_name; ?>">
            <input type="tel" name="phone" placeholder="Mobile Number" required value="<?php echo $posted_phone; ?>">
            <textarea name="address" rows="3" placeholder="Full Shipping Address" required><?php echo $posted_address; ?></textarea>
            
            <h2 style="margin-top: 40px;">🎁 Apply Coupon Code</h2>
            <div class="coupon-section">
                <input type="text" name="coupon" placeholder="Enter Coupon Code (e.g., PINK10)">
                <button type="button">Apply</button>
            </div>
            
            <h2 style="margin-top: 40px;">💳 Select Payment Method</h2>
            <div class="payment-options">
                <label class="payment-method">
                    <input type="radio" name="payment_method" value="cod" required <?php echo ($posted_payment_method == 'cod') ? 'checked' : ''; ?>>
                    Cash on Delivery (COD)
                </label>
                <label class="payment-method">
                    <input type="radio" name="payment_method" value="card" <?php echo ($posted_payment_method == 'card') ? 'checked' : ''; ?>>
                    Credit/Debit Card (Online)
                </label>
                <label class="payment-method">
                    <input type="radio" name="payment_method" value="upi" <?php echo ($posted_payment_method == 'upi') ? 'checked' : ''; ?>>
                    UPI / Net Banking (Online)
                </label>
                
                <button type="submit" name="place_order" class="place-order-btn">
                    PLACE ORDER (Pay ₹<?php echo number_format($final_total); ?>)
                </button>
            </div>
        </form>

        <div class="order-summary">
            <h2>Summary (<?php echo count($cart_items); ?> Items)</h2>
            <?php if (!empty($cart_items)): ?>
                <!-- Display cart items -->
                <?php foreach ($cart_items as $item): ?>
                    <p>
                        <!-- Safely display item details -->
                        <span><?php echo htmlspecialchars($item['name']) . ' (' . htmlspecialchars($item['size'] ?? 'N/A') . ') x ' . ($item['quantity'] ?? 1); ?></span> 
                        <span>₹<?php echo number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1)); ?></span>
                    </p>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; color: var(--text-light); padding: 20px;">Your cart is empty. Please add items to proceed to checkout.</p>
            <?php endif; ?>
            
            <p class="subtotal">Subtotal: <span>₹<?php echo number_format($grand_total); ?></span></p>
            <p class="shipping">Shipping: <span>₹<?php echo number_format($shipping_fee); ?></span></p>
            <?php if ($coupon_discount > 0): ?>
                <p class="coupon-discount">Coupon Discount: <span>-₹<?php echo number_format($coupon_discount); ?></span></p>
            <?php endif; ?>

            <p class="final-payable">
                Final Payable: <span>₹<?php echo number_format($final_total); ?></span>
            </p>
        </div>

    </main>
</body>
</html>