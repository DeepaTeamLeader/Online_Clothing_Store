<?php
$conn = new mysqli("localhost", "root", "", "onlineclothingwebsite");

if(isset($_POST['buy'])){
    $sname = $_POST['sname'];
    $semail = $_POST['semail'];
    $rname = $_POST['rname'];
    $remail = $_POST['remail'];
    $amount = $_POST['amount'];
    $msg = $_POST['msg'];
    $code = "GC".rand(100000,999999);

    $sql = "INSERT INTO giftcards(sender_name, sender_email, receiver_name, receiver_email, amount, message, card_code)
            VALUES('$sname','$semail','$rname','$remail','$amount','$msg','$code')";
    $conn->query($sql);

    // Email
    $subject = "You've received a Gift Card!";
    $body = "Hello $rname,\n\nYou have received a Gift Card worth ₹$amount from $sname.\n\nGift Card Code: $code\n\nMessage: $msg\n\nEnjoy shopping on our website!";
    mail($remail, $subject, $body);

    echo "<script>alert('Gift Card Purchased Successfully & Email Sent!');window.location='giftcard.html';</script>";
}


?>
