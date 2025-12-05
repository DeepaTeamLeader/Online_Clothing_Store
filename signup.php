<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account</title>
  <link rel="stylesheet" href="signup.css">
</head>
<body>
  <div class="signup-container">
    <h2>Create Your Account</h2>
    <form action="signup_action.php" method="POST">
      <input type="text" name="full_name" placeholder="Enter Full Name" required>
      <input type="email" name="email" placeholder="Enter Email" required>
      <input type="tel" name="phone" placeholder="Enter Phone Number" required>
      <input type="password" name="password" placeholder="Enter Password" required>
      <button type="submit" class="signup-btn">Sign Up</button>
    </form>

    <div class="divider"><span>or</span></div>

    <div class="google-btn">
      <a href="https://accounts.google.com/signin" target="_blank" class="google-link">
        <img src="https://www.gstatic.com/images/branding/product/1x/gsa_64dp.png" 
             alt="Google Logo" class="google-logo">
        <span>Continue with Google</span>
      </a>
    </div>
  </div>
</body>
</html>
