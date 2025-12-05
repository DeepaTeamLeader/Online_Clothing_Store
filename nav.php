<?php
// Start the session at the very beginning of the file.
// This allows you to access session data on all pages that include this file.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check login status based on session variables
$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? $_SESSION['username'] : ''; 

// Note: You must include the FontAwesome CSS link in your <head> for the icons (fas fa-user-circle) to work.
// <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clothing Store</title>
 <link rel="stylesheet" href="nav.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
  <nav class="navbar">
    
<h1>Online Clothing Store </h1>

    <div class="search-container">
    <div class="search-box">
      <input type="text" placeholder="Search for products, brands and more">
      <button>🔍</button>
    </div>
    <div class="suggestions-dropdown" id="suggestionsDropdown">
        </div>
  </div>

  <script>
    // Sample Data: Products, brands, and categories to search against
const searchableItems = [
    "Tokyo Talkies",
    "Stylish Denim Jacket",
    "Cotton Polo Shirt",
    "Winter Trench Coat",
    "Summer Shorts",
    "Leather Belt (Accessory)",
    "Sneakers (Footwear)",
    "Men's Casual Wear",
    "Women's Ethnic Collection",
    "Kids T-shirts",
    "Brand Maximo",
    "Brand StyleHub"
];

const searchInput = document.getElementById('searchInput');
const dropdown = document.getElementById('suggestionsDropdown');

// Function called every time the user types
function filterItems() {
    console.log("Filter function called!");
    const searchTerm = searchInput.value.toLowerCase();
    
    // Clear previous suggestions
    dropdown.innerHTML = '';

    // If search term is empty, hide the dropdown
    if (searchTerm.length === 0) {
        dropdown.style.display = 'none';
        return;
    }

    const filteredItems = searchableItems.filter(item => 
        item.toLowerCase().includes(searchTerm)
    );

    if (filteredItems.length > 0) {
        // Create HTML for each suggested item
        filteredItems.forEach(item => {
            const div = document.createElement('div');
            div.classList.add('suggestion-item');
            div.textContent = item;
            
            // Optional: When user clicks a suggestion, fill the search box and perform action
            div.onclick = function() {
                searchInput.value = item;
                dropdown.style.display = 'none';
                // You can add a function here to redirect to the search results page:
                // window.location.href = `/search?q=${encodeURIComponent(item)}`;
                console.log(`Searching for: ${item}`);
            };
            
            dropdown.appendChild(div);
        });
        
        // Show the dropdown
        dropdown.style.display = 'block';
    } else {
        // If no results found
        dropdown.innerHTML = '<div class="suggestion-item" style="color:#f00;">No results found</div>';
        dropdown.style.display = 'block';
    }
}

// Optional: Hide dropdown when user clicks outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.search-container')) {
        dropdown.style.display = 'none';
    }
});
  </script>

  

    <div class="menu-toggle" id="menu-toggle">☰</div>
    <ul class="nav-links" id="nav-links">
      <li><a class="active" href="#">Home</a></li>
      <li class="dropdown">
        <a href="#">Categories ▾</a>
        <ul class="dropdown-content">
          <li><a href="men/men.php">Men</a></li>
          <li><a href="women/women.php">Women</a></li>
          <li><a href="kids/kids.php">Kids</a></li>
        </ul>
      </li>
      <li><a href="cart.php">Cart</a></li>
      <li><a href="signup.php">Signup</a></li>


      

      
</ul>


</nav>





<main class="main-container">
    <div class="navbar-wrapper">
        <div class="online-clothing-store"></div>
        </div>
<div class="flipkart-slider" id="flipkartSlider">
        <div class="slider-container">
            <!-- Slide 1 -->
            <div class="slide active" data-link="/sale">
                <img src="https://images.unsplash.com/photo-1580978608550-0390af9b72b6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzYWxlJTIwYmFubmVyJTIwcHJvbW90aW9ufGVufDF8fHx8MTc1NjI3MTg5NXww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral" alt="Summer Sale">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h3 class="slide-title">Summer Sale</h3>
                        <p class="slide-subtitle">Up to 70% Off</p>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide" data-link="/new-arrivals">
                <img src="https://images.unsplash.com/photo-1532795986-dbef1643a596?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzaG9wcGluZyUyMGRpc2NvdW50JTIwb2ZmZXJ8ZW58MXx8fHwxNzU2MjcxODk2fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral" alt="Fashion Week">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h3 class="slide-title">Fashion Week</h3>
                        <p class="slide-subtitle">New Arrivals</p>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="slide" data-link="/premium">
                <img src="https://images.unsplash.com/photo-1464854860390-e95991b46441?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmYXNoaW9uJTIwY29sbGVjdGlvbiUyMGJhbm5lcnxlbnwxfHx8fDE3NTYyNzE4OTZ8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral" alt="Premium Collection">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h3 class="slide-title">Premium Collection</h3>
                        <p class="slide-subtitle">Exclusive Deals</p>
                    </div>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="slide" data-link="/offers">
                <img src="img1.png" alt="Best Offers">
                <div class="slide-overlay">
                    <div class="slide-content">
                        <h3 class="slide-title">Best Offers</h3>
                        <p class="slide-subtitle">Limited Time</p>
                    </div>
                </div>
            </div>

            

        <!-- Navigation buttons -->
        <button class="nav-btn prev-btn" id="prevBtn" aria-label="Previous slide">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15,18 9,12 15,6"></polyline>
            </svg>
        </button>

        <button class="nav-btn next-btn" id="nextBtn" aria-label="Next slide">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9,18 15,12 9,6"></polyline>
            </svg>
        </button>

        <!-- Dot indicators -->
        <div class="dots-container" id="dotsContainer">
            <button class="dot active" data-slide="0" aria-label="Go to slide 1"></button>
            <button class="dot" data-slide="1" aria-label="Go to slide 2"></button>
            <button class="dot" data-slide="2" aria-label="Go to slide 3"></button>
            <button class="dot" data-slide="3" aria-label="Go to slide 4"></button>
            <button class="dot" data-slide="4" aria-label="Go to slide 5"></button>
        </div>
    </div>
    <style>
      /* Flipkart Style Image Slider CSS */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.main-container {
    max-width: 100%;
    margin: 0 auto;
    padding: 0; /* Add some side padding for small screens */
    
}


/* Assuming your navbar is inside a wrapper */
.navbar-wrapper {
    /* ...other styles for the navbar wrapper... */
    margin-bottom: 10px; /* This creates a 1cm (~10px) space */
    width: 100%;
}

/* Or, if you don't have a wrapper, target a specific navbar element */
.online-clothing-store {
    /* ...other styles... */
    margin-bottom: 10px; 
}
body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    background-color: #f1f3f6;
    padding: 20px;
}

.flipkart-slider {
    position: relative;
    width: 100%;
    max-width: 100%;
    background: white;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border-radius: 0px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.slider-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

/* Responsive heights */
@media (min-width: 768px) {
    .slider-container {
        height: 280px;
    }
}

@media (min-width: 1024px) {
    .slider-container {
        height: 320px;
    }
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transform: translateX(100%);
    transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

.slide.active {
    opacity: 1;
    transform: translateX(0);
}

.slide.prev {
    transform: translateX(-100%);
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.slide:hover img {
    transform: scale(1.02);
}

.slide-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(0, 0, 0, 0.4), transparent);
    display: flex;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.slide:hover .slide-overlay {
    opacity: 1;
}

.slide-content {
    padding: 16px 24px;
    color: white;
}

@media (min-width: 768px) {
    .slide-content {
        padding: 24px 32px;
    }
}

.slide-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 4px;
    color: white;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

@media (min-width: 768px) {
    .slide-title {
        font-size: 24px;
        margin-bottom: 8px;
    }
}

.slide-subtitle {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.9);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

@media (min-width: 768px) {
    .slide-subtitle {
        font-size: 16px;
    }
}

/* Navigation buttons */
.nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 32px;
    height: 32px;
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid #e1e5e9;
    border-radius: 6px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #565a5c;
    transition: all 0.2s ease;
    z-index: 10;
    backdrop-filter: blur(4px);
}

@media (min-width: 768px) {
    .nav-btn {
        width: 40px;
        height: 40px;
    }
    
    .nav-btn svg {
        width: 20px;
        height: 20px;
    }
}

.nav-btn:hover {
    background: white;
    transform: translateY(-50%) scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.nav-btn:active {
    transform: translateY(-50%) scale(0.95);
}

.prev-btn {
    left: 8px;
}

.next-btn {
    right: 8px;
}

@media (min-width: 768px) {
    .prev-btn {
        left: 16px;
    }
    
    .next-btn {
        right: 16px;
    }
}

/* Dot indicators */
.dots-container {
    position: absolute;
    bottom: 12px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 4px;
    z-index: 10;
}

.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.6);
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
}

.dot.active {
    background: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transform: scale(1.2);
}

.dot:hover {
    background: rgba(255, 255, 255, 0.8);
    transform: scale(1.1);
}

/* Loading animation */
.slide img {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}

.slide img[src] {
    background: none;
    animation: none;
}

/* Focus styles for accessibility */
.nav-btn:focus,
.dot:focus {
    outline: 2px solid #2874f0;
    outline-offset: 2px;
}

/* Disable text selection */
.flipkart-slider {
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .nav-btn {
        border: 2px solid #000;
        background: #fff;
        color: #000;
    }
    
    .dot {
        border: 1px solid #fff;
    }
    
    .dot.active {
        background: #fff;
        border: 1px solid #000;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    .slide,
    .slide img,
    .nav-btn,
    .dot {
        transition: none;
    }
    
    .slide:hover img {
        transform: none;
    }
}





    </style>

    <script>
// Flipkart Style Image Slider JavaScript

class FlipkartSlider {
    constructor(sliderId) {
        this.slider = document.getElementById(sliderId);
        this.slides = this.slider.querySelectorAll('.slide');
        this.dots = this.slider.querySelectorAll('.dot');
        this.prevBtn = this.slider.querySelector('.prev-btn');
        this.nextBtn = this.slider.querySelector('.next-btn');
        
        this.currentSlide = 0;
        this.totalSlides = this.slides.length;
        this.autoplayInterval = null;
        this.autoplayDelay = 3000; // 3 seconds
        this.isAutoplayRunning = false;
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.startAutoplay();
        this.preloadImages();
    }
    
    bindEvents() {
        // Navigation button events
        this.prevBtn.addEventListener('click', () => {
            this.stopAutoplay();
            this.previousSlide();
            this.startAutoplay();
        });
        
        this.nextBtn.addEventListener('click', () => {
            this.stopAutoplay();
            this.nextSlide();
            this.startAutoplay();
        });
        
        // Dot indicator events
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                this.stopAutoplay();
                this.goToSlide(index);
                this.startAutoplay();
            });
        });
        
        // Slide click events
        this.slides.forEach((slide) => {
            slide.addEventListener('click', () => {
                const link = slide.getAttribute('data-link');
                if (link) {
                    // For demo purposes, we'll just log the link
                    // In a real implementation, you might navigate to the link
                    console.log('Navigating to:', link);
                    // window.location.href = link;
                }
            });
        });
        
        // Pause autoplay on hover
        this.slider.addEventListener('mouseenter', () => {
            this.stopAutoplay();
        });
        
        this.slider.addEventListener('mouseleave', () => {
            this.startAutoplay();
        });
        
        // Keyboard navigation
        this.slider.addEventListener('keydown', (e) => {
            switch(e.key) {
                case 'ArrowLeft':
                    e.preventDefault();
                    this.stopAutoplay();
                    this.previousSlide();
                    this.startAutoplay();
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    this.stopAutoplay();
                    this.nextSlide();
                    this.startAutoplay();
                    break;
                case ' ':
                case 'Enter':
                    if (e.target.classList.contains('dot')) {
                        e.preventDefault();
                        const slideIndex = parseInt(e.target.getAttribute('data-slide'));
                        this.stopAutoplay();
                        this.goToSlide(slideIndex);
                        this.startAutoplay();
                    }
                    break;
            }
        });
        
        // Touch/swipe support for mobile
        this.addTouchSupport();
        
        // Pause autoplay when page is not visible
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.stopAutoplay();
            } else {
                this.startAutoplay();
            }
        });
    }
    
    addTouchSupport() {
        let startX = 0;
        let endX = 0;
        let startY = 0;
        let endY = 0;
        
        this.slider.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        }, { passive: true });
        
        this.slider.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            endY = e.changedTouches[0].clientY;
            
            const diffX = startX - endX;
            const diffY = startY - endY;
            
            // Only handle horizontal swipes (ignore vertical scrolling)
            if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                e.preventDefault();
                this.stopAutoplay();
                
                if (diffX > 0) {
                    // Swipe left - next slide
                    this.nextSlide();
                } else {
                    // Swipe right - previous slide
                    this.previousSlide();
                }
                
                this.startAutoplay();
            }
        }, { passive: false });
    }
    
    updateSlide(newIndex) {
        // Remove active classes
        this.slides[this.currentSlide].classList.remove('active');
        this.dots[this.currentSlide].classList.remove('active');
        
        // Add prev class to current slide for animation
        this.slides[this.currentSlide].classList.add('prev');
        
        // Update current slide index
        this.currentSlide = newIndex;
        
        // Add active classes to new slide
        this.slides[this.currentSlide].classList.add('active');
        this.dots[this.currentSlide].classList.add('active');
        
        // Clean up prev classes after animation
        setTimeout(() => {
            this.slides.forEach((slide, index) => {
                if (index !== this.currentSlide) {
                    slide.classList.remove('prev');
                }
            });
        }, 700); // Match the CSS transition duration
        
        // Trigger custom event
        this.slider.dispatchEvent(new CustomEvent('slideChange', {
            detail: {
                currentSlide: this.currentSlide,
                totalSlides: this.totalSlides
            }
        }));
    }
    
    nextSlide() {
        const newIndex = (this.currentSlide + 1) % this.totalSlides;
        this.updateSlide(newIndex);
    }
    
    previousSlide() {
        const newIndex = this.currentSlide === 0 ? this.totalSlides - 1 : this.currentSlide - 1;
        this.updateSlide(newIndex);
    }
    
    goToSlide(index) {
        if (index !== this.currentSlide && index >= 0 && index < this.totalSlides) {
            this.updateSlide(index);
        }
    }
    
    startAutoplay() {
        if (!this.isAutoplayRunning) {
            this.autoplayInterval = setInterval(() => {
                this.nextSlide();
            }, this.autoplayDelay);
            this.isAutoplayRunning = true;
        }
    }
    
    stopAutoplay() {
        if (this.autoplayInterval) {
            clearInterval(this.autoplayInterval);
            this.autoplayInterval = null;
            this.isAutoplayRunning = false;
        }
    }
    
    preloadImages() {
        this.slides.forEach((slide) => {
            const img = slide.querySelector('img');
            if (img && img.src) {
                const preloadImg = new Image();
                preloadImg.src = img.src;
            }
        });
    }
    
    // Public methods for external control
    play() {
        this.startAutoplay();
    }
    
    pause() {
        this.stopAutoplay();
    }
    
    getCurrentSlide() {
        return this.currentSlide;
    }
    
    getTotalSlides() {
        return this.totalSlides;
    }
    
    destroy() {
        this.stopAutoplay();
        // Remove event listeners and clean up
        this.slider.removeEventListener('mouseenter', this.stopAutoplay);
        this.slider.removeEventListener('mouseleave', this.startAutoplay);
        document.removeEventListener('visibilitychange', this.handleVisibilityChange);
    }
}

// Initialize the slider when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Create slider instance
    const flipkartSlider = new FlipkartSlider('flipkartSlider');
    
    // Optional: Listen for slide changes
    document.getElementById('flipkartSlider').addEventListener('slideChange', function(e) {
        console.log('Slide changed to:', e.detail.currentSlide + 1, 'of', e.detail.totalSlides);
    });
    
    // Optional: External controls example
    // flipkartSlider.pause(); // Pause autoplay
    // flipkartSlider.play();  // Resume autoplay
    // flipkartSlider.goToSlide(2); // Go to specific slide
});

// Export for use in modules (optional)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = FlipkartSlider;
}



// --- NEW CODE: Login/Sign Up & Profile Activation ---

// Get elements for the new functionality
const modal = document.getElementById('authModal');
const loginBtn = document.getElementById('openLoginModal'); 
const closeBtn = modal.querySelector('.close-btn');
const tabButtons = modal.querySelectorAll('.tab-button');
const forms = modal.querySelectorAll('.auth-form');
const profileDropdown = document.getElementById('profileDropdown');

// --- 1. Open Modal on Navbar Button Click ---
if (loginBtn) {
    loginBtn.onclick = function() {
        modal.style.display = 'block';
    }
}

// --- 2. Close Modal Functionality ---
closeBtn.onclick = function() {
    modal.style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

// --- 3. Tab Switching Logic (Login <-> Sign Up) ---
tabButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Remove active class from all buttons and hide all forms
        tabButtons.forEach(btn => btn.classList.remove('active'));
        forms.forEach(form => form.style.display = 'none');
        
        // Activate the clicked button and show its form
        this.classList.add('active');
        const formId = this.getAttribute('data-tab');
        document.getElementById(formId).style.display = 'block';
    });
});

// --- 4. Profile Dropdown Toggle ---
// Function called by the 'onclick' attribute in the PHP/HTML section
function toggleDropdown() {
    if (profileDropdown) {
        profileDropdown.classList.toggle('show');
    }
}

// Close the dropdown if the user clicks anywhere else on the page
window.addEventListener('click', function(event) {
    // Check if the user clicked outside the dropdown button
    if (profileDropdown && !event.target.closest('.profile-btn')) {
        profileDropdown.classList.remove('show');
    }
});








    </script>

    <!-- Rising Stars Section -->
  <div class="rising-stars">
    <h2>RISING STARS</h2>
    <div class="brand-container">
      
      <div class="brand-card">
        <a href="brand1.html">
          <img src="images/ketchimg.png" alt="Highlander | Ketch">
          <div class="brand-info">
            <h3>Highlander | Ketch</h3>
            <p>Casual. Cool. Confident</p>
            <strong>Min. 70% Off</strong>
          </div>
        </a>
      </div>

      <div class="brand-card">
        <a href="brand2.html">
          <img src="tokyotalkies.png" alt="Tokyo Talkies | Sassafras">
          <div class="brand-info">
            <h3>Tokyo Talkies | Sassafras</h3>
            <p>Where Glam Meets the Wild West</p>
            <strong>Min. 70% Off</strong>
          </div>
        </a>
      </div>

      <div class="brand-card">
        <a href="brand3.html">
          <img src="berrylushimg.png" alt="Berrylush | Street9">
          <div class="brand-info">
            <h3>Berrylush | Street9</h3>
            <p>Shine with Confidence</p>
            <strong>Min. 65% Off</strong>
          </div>
        </a>
      </div>

      <div class="brand-card">
        <a href="brand4.html">
          <img src="fubarimg.png" alt="Dennison | Fubar Fashions">
          <div class="brand-info">
            <h3>Dennison | Fubar</h3>
            <p>Timeless Style</p>
            <strong>Min. 65% Off</strong>
          </div>
        </a>
      </div>

      <div class="brand-card">
        <a href="brand5.html">
          <img src="shaeimg.png" alt="Bhama | Shae by Sassafras">
          <div class="brand-info">
            <h3>Bhama | Shae</h3>
            <p>Ethereal Beauty</p>
            <strong>Min. 60% Off</strong>
          </div>
        </a>
      </div>

    </div>
  </div>



<!-- Customer Reviews Section -->
<section class="reviews-section">
    <h2>🌟 What Our Customers Say</h2>

    <div class="reviews-carousel-container">

        <!-- Review Navigation Buttons -->
        <button class="review-nav-btn prev-review-btn" onclick="navigateReviews(-1)">&#10094;</button>
        
        <!-- Reviews will be injected here by JavaScript -->

        <div class="reviews-carousel" id="reviewsCarousel">

        <!-- Review cards will appear here -->

        </div>
        
        <button class="review-nav-btn next-review-btn" onclick="navigateReviews(1)">&#10095;</button>
    </div>
</section>

<section class="value-proposition-section">
    <div class="value-container" id="valueContainer">
        </div>
</section>

<script>
    // Sample Review Data
const reviewsData = [
    {
        name: "Anjali Sharma",
        rating: 5,
        text: "The quality of the material is superb! My Teal Comfort Tee arrived quickly and the fit is perfect. Highly recommend this store for trendy wear.",
        date: "October 20, 2025"
    },
    {
        name: "Rohit Verma",
        rating: 4,
        text: "I bought the denim jacket and it looks exactly like the picture. The color is great. Only suggestion would be faster delivery.",
        date: "October 28, 2025"
    },
    {
        name: "Priya Singh",
        rating: 5,
        text: "Absolutely loved the dress! It's unique and I received so many compliments. The best seller badge is definitely accurate.",
        date: "November 5, 2025"
    },
    {
        name: "Karan Mehta",
        rating: 5,
        text: "Great experience shopping here. The sizes are true to fit, and the customer service was very helpful when I had a query.",
        date: "November 15, 2025"
    },
    {
        name: "Sonia Patel",
        rating: 4,
        text: "Good value for money. The fabric is comfortable for daily use. Will be purchasing more items soon!",
        date: "November 25, 2025"
    }
];

// Function to generate the HTML for star rating
function generateStars(rating) {
    let starsHtml = '';
    for (let i = 1; i <= 5; i++) {
        starsHtml += `<span class="star ${i <= rating ? 'active' : ''}">&#9733;</span>`;
    }
    return starsHtml;
}

// Function to load reviews dynamically
function loadReviews() {
    const reviewsCarousel = document.getElementById('reviewsCarousel');
    reviewsCarousel.innerHTML = ''; // Clear existing content

    reviewsData.forEach(review => {
        const card = document.createElement('div');
        card.classList.add('review-card');
        
        card.innerHTML = `
            <div class="review-rating">
                ${generateStars(review.rating)}
            </div>
            <p class="review-text">"${review.text}"</p>
            <p class="reviewer-name">${review.name}</p>
            <p class="review-date">${review.date}</p>
        `;
        
        reviewsCarousel.appendChild(card);
    });
}

// Function to handle review carousel scrolling
function navigateReviews(direction) {
    const carousel = document.getElementById('reviewsCarousel');
    // We assume card width + gap is 330px for scrolling
    const scrollDistance = 330; 

    carousel.scrollBy({
        left: direction * scrollDistance,
        behavior: 'smooth'
    });
}

// Load reviews when the page loads
document.addEventListener('DOMContentLoaded', () => {
    // --- Existing Product Carousel Initialization (from previous code) ---
    // (Ensure your previous scrollCarousel function is also available)
    
    // --- New Review Carousel Initialization ---
    loadReviews();
    
    // Add event listener to hide/show review nav buttons (optional advanced feature)
    const reviewsCarousel = document.getElementById('reviewsCarousel');
    const prevBtn = document.querySelector('.prev-review-btn');
    const nextBtn = document.querySelector('.next-review-btn');

    const updateReviewNavButtons = () => {
        prevBtn.style.visibility = (reviewsCarousel.scrollLeft === 0) ? 'hidden' : 'visible';
        
        // Check if we are at the end (with small tolerance)
        if (reviewsCarousel.scrollLeft + reviewsCarousel.clientWidth >= reviewsCarousel.scrollWidth - 1) {
            nextBtn.style.visibility = 'hidden';
        } else {
            nextBtn.style.visibility = 'visible';
        }
    };

    updateReviewNavButtons();
    reviewsCarousel.addEventListener('scroll', updateReviewNavButtons);
});







// Data for the Value Proposition Section
const valuePropsData = [
    {
        iconCode: '&#128666;', // 📦 Delivery Truck/Package Icon (You can use Font Awesome or SVG icons instead)
        title: 'FREE SHIPPING',
        detail: 'On all orders above ₹999',
        action: 'none' // No specific action needed
    },
    {
        iconCode: '&#8635;', // 🔄 Refresh Arrow Icon
        title: 'EASY RETURNS',
        detail: '30-Day Money Back Guarantee',
        action: 'none'
    },
    {
        iconCode: '&#128274;', // 🔒 Lock Icon
        title: 'SECURE PAYMENT',
        detail: '100% Protected Transactions',
        action: 'none'
    },
    {
        iconCode: '&#128222;', // 📞 Telephone Icon
        title: '24/7 SUPPORT',
        detail: 'Instant Chat Help',
        action: 'chat' // This identifies the clickable card
    }
];


// --- 2. FUNCTION DEFINITIONS ---

// 💡 AI Messaging App/Live Chat Handler Function
function handleSupportClick() {
    // ⚠️ IMPORTANT: 
    // AI Messaging के लिए, आपको एक थर्ड-पार्टी लाइब्रेरी (जैसे Tawk.to, Crisp, Intercom, etc.) का उपयोग करना होगा।
    // यह फ़ंक्शन उस लाइब्रेरी के API कॉल को ट्रिगर करता है जो चैट विंडो को खोलती है।

    // उदाहरण के लिए, यदि आप Tawk.to उपयोग कर रहे हैं:
    if (typeof Tawk_API !== 'undefined') {
        Tawk_API.toggle(); // Tawk.to चैट विंडो को खोलेगा
        console.log("Live Chat / AI Bot Window Toggled");
    } 
    // उदाहरण के लिए, यदि आप Crisp उपयोग कर रहे हैं:
    else if (typeof $crisp !== 'undefined') {
        $crisp.push(['do', 'chat:toggle']); 
        console.log("Crisp Chat Window Toggled");
    }
    // यदि कोई चैट सर्विस कोड लोड नहीं हुआ है
    else {
        alert("Chat service initializing. Please check for a chat icon at the bottom of the screen.");
    }

    // AI Messaging के लिए, आपको अपनी चैट सर्विस को 'Order Status' जैसे विषयों पर
    // स्वचालित रूप से जवाब देने के लिए कॉन्फ़िगर करना होगा।
}


// Function to load Value Proposition Cards dynamically
function loadValuePropositions() {
    const container = document.getElementById('valueContainer');
    if (!container) return; // Exit if the HTML container is not found

    valuePropsData.forEach(prop => {
        const card = document.createElement('div');
        card.classList.add('value-card');

        // Check if the card is the 24/7 support chat button
        if (prop.action === 'chat') {
            card.classList.add('clickable-support');
            // Attach the click handler for AI chat
            card.addEventListener('click', handleSupportClick);
        }

        // Using innerHTML to inject the icon code and structure
        card.innerHTML = `
            <span class="value-icon">${prop.iconCode}</span>
            <div class="value-details">
                <h4>${prop.title}</h4>
                <p>${prop.detail}</p>
            </div>
        `;
        
        container.appendChild(card);
    });
}


// --- 3. INITIALIZATION ---
// Ensure that this function runs only after the DOM is fully loaded
// If you are using other functions (loadReviews, scrollCarousel),
// then place loadValuePropositions() in the same DOMContentLoaded block

document.addEventListener('DOMContentLoaded', () => {
    
    // Call the function to load the Value Proposition cards
    loadValuePropositions();
    
    
    // loadReviews(); 
});





</script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f8f8;
      margin: 0;
      padding: 0;
    }

    .rising-stars {
      margin: 40px auto;
      padding: 0 20px;
      max-width: 100%;
    }

    .rising-stars h2 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #2a2a2a;
    }

    .brand-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }

    .brand-card {
      background: #fff;
      border-radius: 6px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      cursor: pointer;
    }

    .brand-card:hover {
      transform: translateY(-4px);
    }

    .brand-card img {
      width: 100%;
      height: 260px;
      object-fit: cover;
      display: block;
    }

    .brand-info {
      padding: 12px;
      text-align: center;
    }

    .brand-info h3 {
      font-size: 15px;
      margin-bottom: 6px;
      color: #333;
    }

    .brand-info p {
      font-size: 13px;
      color: #666;
      margin-bottom: 6px;
    }

    .brand-info strong {
      color: #000;
      font-size: 14px;
    }

    /* Links remove underline */
    .brand-card a {
      text-decoration: none;
      color: inherit;
      display: block;
    }

    </style>



<!-- Footer Start -->
<footer style="background-color:#fff; padding:40px 60px; font-family:Arial, sans-serif; border-top:1px solid #ddd;">

  <div style="display:flex; justify-content:space-between; flex-wrap:wrap;">

    <!-- Online Shopping -->
    <div>
      <h4 style="font-size:14px; font-weight:bold; margin-bottom:10px;">ONLINE SHOPPING</h4>
      <ul style="list-style:none; padding:0; line-height:1.8;">
        <li><a href="men/men.php">Men</a></li>
        <li><a href="women/women.php">Women</a></li>
        <li><a href="kids/kids.php">Kids</a></li>
        <li><a href="nav.php">Home</a></li>
        <li><a href="giftcard.html">Gift Cards</a></li>
        
      </ul>

      <h4 style="font-size:14px; font-weight:bold; margin-top:20px; margin-bottom:10px;">USEFUL LINKS</h4>
      <ul style="list-style:none; padding:0; line-height:1.8;">
        <li><a href="blog.html">Blog</a></li>
        <li><a href="career.html">Careers</a></li>
      </ul>
    </div>

    <!-- Customer Policies -->
    <div>
      <h4 style="font-size:14px; font-weight:bold; margin-bottom:10px;">CUSTOMER POLICIES</h4>
      <ul style="list-style:none; padding:0; line-height:1.8;">
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="faq.html">FAQ</a></li>
        <li><a href="t&c.html">T&C</a></li>
        <li><a href="terms-of-use.html">Terms Of Use</a></li>
        <li><a href="track_order.html">Track Orders</a></li>
        <li><a href="shipping.html">Shipping</a></li>
        <li><a href="cancellation.html">Cancellation</a></li>
        <li><a href="returns.html">Returns</a></li>
        <li><a href="privacypolicy.html">Privacy Policy</a></li>
        <li><a href="grievance.html">Grievance Redressal</a></li>
      </ul>
    </div>

    <!-- Info Section -->
    <div style="max-width:300px;">
      <p style="font-size:14px; font-weight:bold; margin-bottom:8px;">100% ORIGINAL</p>
      <p style="font-size:13px; color:#555;">guarantee for all products on our website</p>
      
      <p style="font-size:14px; font-weight:bold; margin-top:20px; margin-bottom:8px;">Return within 14 days</p>
      <p style="font-size:13px; color:#555;">of receiving your order</p>

     <h4 style="font-size:14px; font-weight:bold; margin-top:20px;">KEEP IN TOUCH</h4>
      <div style="margin-top:10px;">
        <a href="#"><img src="https://img.icons8.com/ios-filled/20/000000/facebook-new.png"/></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/20/000000/twitter.png"/></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/20/000000/youtube-play.png"/></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/20/000000/instagram-new.png"/></a>
      </div>
    </div>
  </div>

  <!-- Copyright -->
  <div style="text-align:center; margin-top:30px; font-size:13px; color:#777;">
    © 2025 Online Clothing Store. All rights reserved.
  </div>

</footer>
<!-- Footer End -->




</body>







</body>
</html>
