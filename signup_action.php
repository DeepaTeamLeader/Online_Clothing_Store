<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $full_name, $email, $phone, $password);

    if ($stmt->execute()) {
        echo "<div style='text-align:center; font-size:18px; color:green; margin-top:50px;'>✅ Signup successful!</div>";
    } else {
        echo "<div style='text-align:center; font-size:18px; color:red; margin-top:50px;'>❌ Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
