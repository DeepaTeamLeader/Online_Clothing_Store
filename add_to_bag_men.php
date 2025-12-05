<?php
// File: add_to_cart.php
// Purpose: Handles adding ANY product (Men's or Women's) to the session cart.

// Start the session to store user's cart data
session_start();

// 1. Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Determine the referring URL to redirect back on error. 
    // This makes the script universal.
    // Fallback to 'women.php' if referer is not available.
    $referer_url = $_SERVER['HTTP_REFERER'] ?? 'men.php';
    
    // 2. Collect product details from the POST request
    $product_id = $_POST['product_id'] ?? 'P_UNK';
    // Use a generic name fallback. Product name should ALWAYS be passed via hidden input.
    $product_name = $_POST['product_name'] ?? 'Generic Product'; 
    $product_price = (int)($_POST['product_price'] ?? 0); 
    $selected_size = $_POST['selected_size'] ?? '';
    
    // 3. Validation: Ensure size is selected and price is valid
    if (empty($selected_size) || $product_price <= 0) {
        
        // Redirect back to the originating page with an error flag.
        // We use the universal $referer_url here.
        header('Location: ' . $referer_url . '?error=no_size_selected');
        exit;
    }

    // 4. Initialize Cart in Session if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // 5. Check for existing item and update quantity (BEST PRACTICE)
    $found = false;
    foreach ($_SESSION['cart'] as $key => $item) {
        // Check if both ID and Size match
        if ($item['id'] === $product_id && $item['size'] === $selected_size) {
            $_SESSION['cart'][$key]['quantity'] += 1;
            $found = true;
            break;
        }
    }

    // 6. If item is NOT found, add it as a new entry
    if (!$found) {
        $new_item = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'size' => $selected_size,
            'quantity' => 1
        ];
        $_SESSION['cart'][] = $new_item; 
    }

    // 7. Redirect the user to the Cart Page
    header('Location: cart.php'); 
    exit;
} else {
    // If accessed directly without form submission, redirect to a main page
    header('Location: men.php'); 
    exit;
}
?>