<?php
// File: cart.php
// Purpose: Displays the shopping cart content, calculates totals, and provides checkout link.
// NOTE: This PHP logic is universal (works for Men's and Women's products).

session_start();
$cart_items = $_SESSION['cart'] ?? [];
$grand_total = 0;
// Shipping fee is applied only if there is at least one item in the cart
$shipping_fee = count($cart_items) > 0 ? 70 : 0; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cart_style.css"> 
</head>
<body>
    <div class="cart-container">
        <h1>🛍️ Your Shopping Bag (<?php echo count($cart_items); ?> Items)</h1>
        
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item): ?>
                    <?php 
                        // Item total and grand total calculation (UNIVERSAL)
                        $item_total = $item['price'] * $item['quantity'];
                        $grand_total += $item_total;
                    ?>
                    <tr> 
                        <td>
                            <span><?php echo htmlspecialchars($item['name']); ?></span>
                            <br><small style="color:#999;"><?php echo htmlspecialchars($item['id']); ?></small>
                        </td>
                        <td><?php echo htmlspecialchars($item['size']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>₹<?php echo number_format($item['price']); ?></td>
                        <td class="item-total">₹<?php echo number_format($item_total); ?></td>
                    </tr>
                <?php endforeach; ?>
                
                <?php if (empty($cart_items)): ?>
                    <tr><td colspan="5" style="text-align:center; padding: 30px; font-weight: 700;">Your cart is empty! Start shopping now.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="cart-summary">
            <div class="total-box">
                <p>Subtotal: <span>₹<?php echo number_format($grand_total); ?></span></p>
                <p>Shipping: <span>₹<?php echo number_format($shipping_fee); ?></span></p>
                
                <?php $final_total = $grand_total + $shipping_fee; ?>

                <p class="grand-total-text" style="font-size: 1.4em; font-weight: 700;">
                    Grand Total: <span>₹<?php echo number_format($final_total); ?></span>
                </p>
                
                <?php if (!empty($cart_items)): ?>
                    <a href="checkout.php" class="checkout-btn">PROCEED TO CHECKOUT</a>
                <?php else: ?>
                    <a href="#" class="checkout-btn disabled-btn">CART IS EMPTY</a>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
</body>
</html>