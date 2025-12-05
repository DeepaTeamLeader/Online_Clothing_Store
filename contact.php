<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - MyStore</title>
  <link rel="stylesheet" href="contact.css">
</head>
<body>

  
  


  <section class="contact-section">
    <h2>Get in Touch</h2>
    <p>If you have any questions about our products, orders, or services, feel free to contact us.</p>

    
    <!-- ✅ Web3Forms integration -->
    <form class="contact-form" action="https://api.web3forms.com/submit" method="POST">
      
      <!-- 🔑 Web3Forms Access Key -->
      <input type="hidden" name="access_key" value="843646a5-8251-4659-8cff-36d756b878f9">

      
      
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" placeholder="Enter your name" required>
      </div>

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>

      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
      </div>

      <div class="custom-select">
  <select>
    <option value="">-- Select a topic --</option>
    <option value="order">Order Related</option>
    <option value="product">Product Inquiry</option>
    <option value="return">Return/Exchange</option>
    <option value="other">Other</option>
  </select>
</div>


      <div class="form-group">
        <label for="message">Your Message</label>
        <textarea id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
      </div>

      <button type="submit" class="btn">Send Message</button>
    </form>
  </section>

</body>
</html>
