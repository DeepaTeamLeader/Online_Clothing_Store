<?php
// Start the session to retrieve user data
session_start();

// Check if the user is NOT logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect if not logged in
    header("Location: nav.php");
    exit();
}

// User is logged in, fetch their username
$username = htmlspecialchars($_SESSION['username']);

// ----------------------------------------------------
// NOTE: In a real application, you would connect to your database 
// and run a query like: 
// SELECT * FROM orders WHERE user_id = $_SESSION['user_id'] ORDER BY order_date DESC;
// ----------------------------------------------------

// Placeholder Data (Replace with actual database data in future)
$orders = [
    [
        'id' => 'ORD1001',
        'date' => '2025-11-20',
        'status' => 'Delivered',
        'total' => 1999.00,
        'items' => 2,
        'details' => 'Delivered on Nov 25, 2025'
    ],
    [
        'id' => 'ORD1002',
        'date' => '2025-11-05',
        'status' => 'Cancelled',
        'total' => 899.00,
        'items' => 1,
        'details' => 'Cancellation confirmed.'
    ],
    [
        'id' => 'ORD1003',
        'date' => '2025-10-15',
        'status' => 'Shipped',
        'total' => 3500.50,
        'items' => 3,
        'details' => 'Tracking ID: AB12345678'
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username; ?> - My Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f3f6;
            margin: 0;
            padding-top: 20px;
        }
        
        .orders-container {
            max-width: 1000px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 30px;
        }

        .orders-container h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .order-card {
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 20px;
            padding: 20px;
            background: #fff;
            transition: box-shadow 0.2s;
        }

        .order-card:hover {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .order-header h3 {
            font-size: 18px;
            color: #2874f0;
            margin: 0;
        }

        .order-summary span {
            display: inline-block;
            margin-right: 20px;
            font-size: 14px;
            color: #555;
        }
        .order-summary b {
            color: #333;
        }

        .order-status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Status Colors */
        .status-delivered { background-color: #e6f7e9; color: #388e3c; } /* Green */
        .status-shipped { background-color: #fffbe6; color: #ff9800; }  /* Orange */
        .status-cancelled { background-color: #ffebee; color: #d32f2f; } /* Red */
        .status-pending { background-color: #e3f2fd; color: #1976d2; }   /* Blue */
        
        .order-details p {
            font-size: 13px;
            color: #777;
            margin-top: 10px;
        }
        
        .action-link {
            text-decoration: none;
            color: #2874f0;
            margin-left: 15px;
            font-size: 14px;
        }
        .action-link:hover {
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background: #fff8e1;
            border: 1px dashed #ffc107;
            border-radius: 6px;
            color: #856404;
            margin-top: 20px;
        }
        .start-shopping-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2874f0;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="orders-container">
    <h2>Your Order History</h2>
    
    <a href="nav.php" style="float: right; text