<?php
// File: add_to_cart.php

// Start the session to store user's cart data
session_start();

// 1. Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 2. Collect product details from the POST request
    $product_id = $_POST['product_id'] ?? 'P_UNK';
    $product_name = $_POST['product_name'] ?? 'Highlander Sweatshirt';
    $product_price = (int)($_POST['product_price'] ?? 799);
    $selected_size = $_POST['selected_size'] ?? '';
    
    // 3. Size Validation
    if (empty($selected_size)) {
        // If size is missing, redirect back with an error (or a friendly message)
        // In a real application, you might use a flash message system
        header('Location: /product_detail.html?error=no_size_selected');
        exit;
    }

    // 4. Initialize Cart in Session if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // 5. Create the new cart item array
    $new_item = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'size' => $selected_size,
        'quantity' => 1
    ];

    // 6. Add the item to the cart session array
    // (In a real app, check for existing item and increase quantity instead of adding new entry)
    $_SESSION['cart'][] = $new_item; 

    // 7. Redirect the user to the Cart Page
    header('Location: cart.php'); 
    exit;
} else {
    // If accessed directly without form submission, redirect home
    header('Location: brand1.html');
    exit;
}
?>