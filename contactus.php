<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - Hailemariam Mamo Preparatory School</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    
    .gradient-text {
      background: linear-gradient(90deg, #0ea5e9 0%, #22c55e 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    
    .nav-link {
      position: relative;
    }
    
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #0ea5e9 0%, #22c55e 100%);
      transition: width 0.3s ease;
    }
    
    .nav-link:hover::after {
      width: 100%;
    }
    
    .nav-link.active::after {
      width: 100%;
    }
    
    .contact-card {
      transition: all 0.3s ease;
      transform: translateY(0);
    }
    
    .contact-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .input-focus:focus {
      box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.3);
    }
    
    .btn-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .btn-hover:active {
      transform: translateY(0);
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Navbar -->
<nav class="bg-white shadow-lg sticky top-0 z-50 backdrop-blur-sm bg-opacity-90">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <!-- Logo -->
      <div class="flex-shrink-0 flex items-center">
        <div class="flex items-center space-x-3">
          <img src="uploads/logo.png" alt="Logo" class="h-10 w-10 rounded-full border-2 border-blue-600 shadow-md">
          <span class="font-bold text-xl gradient-text tracking-tight">HAILEMARIAM MAMO</span>
        </div>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden md:flex items-center space-x-8">
        <a href="index.php" class="nav-link text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Home</a>
        <a href="about_us.php" class="nav-link text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">About Us</a>
        <a href="contactus.php" class="nav-link active text-blue-600 px-3 py-2 text-sm font-medium">Contact Us</a>
        <a href="feedback.php" class="nav-link text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Feedback</a>
        <div class="flex space-x-4 ml-6">
          <a href="login.php" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 transition duration-300">Login</a>
          <a href="reg.php" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300 shadow-md hover:shadow-lg">Register</a>
        </div>
      </div>

      <!-- Mobile Menu Button -->
      <div class="md:hidden">
        <button id="menu-toggle" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-all" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <!-- Icon when menu is closed -->
          <svg id="menu-open-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <!-- Icon when menu is open -->
          <svg id="menu-close-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg rounded-lg mx-4 mt-2 py-2">
    <div class="px-2 pt-2 pb-3 space-y-2">
      <a href="index.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition">Home</a>
      <a href="about_us.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition">About Us</a>
      <a href="contactus.php" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 bg-blue-50">Contact Us</a>
      <a href="feedback.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition">Feedback</a>
      <div class="pt-2 space-y-2">
        <a href="login.php" class="block px-3 py-2 text-center border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 transition">Login</a>
        <a href="reg.php" class="block px-3 py-2 text-center bg-blue-600 text-white rounded-md hover:bg-blue-700 transition shadow-md">Register</a>
      </div>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-50 to-green-50 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-4">Get In Touch</h1>
    <p class="text-xl text-gray-700 max-w-3xl mx-auto">
      We'd love to hear from you! Reach out to us with any questions or feedback.
    </p>
  </div>
</section>

<!-- Contact Content -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <div class="grid md:grid-cols-2 gap-12">
    <!-- Contact Information -->
    <div class="space-y-8">
      <div class="contact-card bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h2>
        
        <div class="space-y-6">
          <div class="flex items-start space-x-4">
            <div class="bg-blue-100 p-3 rounded-full text-blue-600">
              <i class="fas fa-map-marker-alt text-xl"></i>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">Address</h3>
              <p class="text-gray-600">123 Education Street, Addis Ababa, Ethiopia</p>
            </div>
          </div>
          
          <div class="flex items-start space-x-4">
            <div class="bg-green-100 p-3 rounded-full text-green-600">
              <i class="fas fa-envelope text-xl"></i>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">Email</h3>
              <p class="text-gray-600">
                <a href="mailto:info@hailemariammamo.edu" class="text-blue-600 hover:underline">info@hailemariammamo.edu</a>
              </p>
              <p class="text-gray-600 mt-1">
                <a href="mailto:admissions@hailemariammamo.edu" class="text-blue-600 hover:underline">admissions@hailemariammamo.edu</a>
              </p>
            </div>
          </div>
          
          <div class="flex items-start space-x-4">
            <div class="bg-purple-100 p-3 rounded-full text-purple-600">
              <i class="fas fa-phone-alt text-xl"></i>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">Phone</h3>
              <p class="text-gray-600">
                <a href="tel:+251123456789" class="text-blue-600 hover:underline">+251 123 456 789</a> (Main Office)
              </p>
              <p class="text-gray-600 mt-1">
                <a href="tel:+251987654321" class="text-blue-600 hover:underline">+251 987 654 321</a> (Admissions)
              </p>
            </div>
          </div>
          
          <div class="flex items-start space-x-4">
            <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
              <i class="fas fa-clock text-xl"></i>
            </div>
            <div>
              <h3 class="font-semibold text-gray-900">Office Hours</h3>
              <p class="text-gray-600">Monday - Friday: 8:00 AM - 5:00 PM</p>
              <p class="text-gray-600">Saturday: 9:00 AM - 1:00 PM</p>
              <p class="text-gray-600">Sunday: Closed</p>
            </div>
          </div>
        </div>
      </div>
      
      <div class="contact-card bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Connect With Us</h2>
        <div class="flex space-x-4">
          <a href="#" class="bg-blue-100 p-3 rounded-full text-blue-600 hover:bg-blue-200 transition">
            <i class="fab fa-facebook-f text-xl"></i>
          </a>
          <a href="#" class="bg-blue-100 p-3 rounded-full text-blue-600 hover:bg-blue-200 transition">
            <i class="fab fa-twitter text-xl"></i>
          </a>
          <a href="#" class="bg-red-100 p-3 rounded-full text-red-600 hover:bg-red-200 transition">
            <i class="fab fa-youtube text-xl"></i>
          </a>
          <a href="#" class="bg-purple-100 p-3 rounded-full text-purple-600 hover:bg-purple-200 transition">
            <i class="fab fa-instagram text-xl"></i>
          </a>
          <a href="#" class="bg-blue-600 p-3 rounded-full text-white hover:bg-blue-700 transition">
            <i class="fab fa-linkedin-in text-xl"></i>
          </a>
        </div>
      </div>
    </div>
    
    <!-- Contact Form -->
    <div class="contact-card bg-white p-8 rounded-xl shadow-md">
      <h2 class="text-2xl font-bold text-gray-900 mb-6">Send Us a Message</h2>
      <form id="contact-form" class="space-y-6">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
          <input type="text" id="name" name="name" required 
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition-all duration-200"
                 placeholder="Your name">
          <p id="name-error" class="mt-1 text-xs text-red-600 hidden"></p>
        </div>
        
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
          <input type="email" id="email" name="email" required 
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition-all duration-200"
                 placeholder="your.email@example.com">
          <p id="email-error" class="mt-1 text-xs text-red-600 hidden"></p>
        </div>
        
        <div>
          <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
          <input type="text" id="subject" name="subject" required 
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition-all duration-200"
                 placeholder="What's this about?">
          <p id="subject-error" class="mt-1 text-xs text-red-600 hidden"></p>
        </div>
        
        <div>
          <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
          <textarea id="message" name="message" rows="5" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition-all duration-200"
                    placeholder="Your message here..."></textarea>
          <p id="message-error" class="mt-1 text-xs text-red-600 hidden"></p>
        </div>
        
        <div>
          <button type="submit" 
                  class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-semibold btn-hover transition-all duration-300 shadow-md">
            Send Message
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Map Section -->
<section class="bg-gray-100 py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">Our Location</h2>
    <div class="bg-white p-4 rounded-xl shadow-md">
      <!-- Embedded Google Map (replace with your actual embed code) -->
      <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.715502761814!2d38.76388931478601!3d9.012022293550094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOcKwMDAnNDMuMyJOIDM4wrA0NSc1Mi4xIkU!5e0!3m2!1sen!2set!4v1620000000000!5m2!1sen!2set" 
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" class="rounded-lg"></iframe>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
  <div class="text-center mb-12">
    <h2 class="text-3xl font-bold text-gray-900">Frequently Asked Questions</h2>
    <p class="text-xl text-gray-600 mt-4">Find quick answers to common inquiries</p>
  </div>
  
  <div class="grid md:grid-cols-2 gap-8">
    <div class="bg-white p-6 rounded-xl shadow-md">
      <h3 class="text-xl font-semibold text-gray-900 mb-3">How do I apply for admission?</h3>
      <p class="text-gray-600">
        Admissions are open from January to March each year. You can apply online through our website or visit our admissions office to fill out an application form.
      </p>
    </div>
    
    <div class="bg-white p-6 rounded-xl shadow-md">
      <h3 class="text-xl font-semibold text-gray-900 mb-3">What are the school fees?</h3>
      <p class="text-gray-600">
        Our fee structure varies by grade level. Please contact our admissions office at <a href="mailto:admissions@hailemariammamo.edu" class="text-blue-600 hover:underline">admissions@hailemariammamo.edu</a> for detailed fee information.
      </p>
    </div>
    
    <div class="bg-white p-6 rounded-xl shadow-md">
      <h3 class="text-xl font-semibold text-gray-900 mb-3">What are your office hours?</h3>
      <p class="text-gray-600">
        Our main office is open Monday to Friday from 8:00 AM to 5:00 PM, and Saturdays from 9:00 AM to 1:00 PM. We're closed on Sundays and public holidays.
      </p>
    </div>
    
    <div class="bg-white p-6 rounded-xl shadow-md">
      <h3 class="text-xl font-semibold text-gray-900 mb-3">Do you offer scholarships?</h3>
      <p class="text-gray-600">
        Yes, we offer merit-based and need-based scholarships. Applications are accepted annually in June. Contact our financial aid office for more details.
      </p>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid md:grid-cols-4 gap-8">
      <div>
        <div class="flex items-center space-x-3 mb-4">
          <img src="uploads/logo.png" alt="Logo" class="h-10 w-10 rounded-full border-2 border-blue-600 shadow-md">
          <span class="font-bold text-xl text-white">HAILEMARIAM MAMO</span>
        </div>
        <p class="text-gray-400">
          Excellence in education since 1995. Preparing students for success in an ever-changing world.
        </p>
      </div>
      
      <div>
        <h3 class="text-white font-bold text-lg mb-4">Quick Links</h3>
        <ul class="space-y-2">
          <li><a href="index.php" class="text-gray-400 hover:text-white transition">Home</a></li>
          <li><a href="about_us.php" class="text-gray-400 hover:text-white transition">About Us</a></li>
          <li><a href="contactus.php" class="text-gray-400 hover:text-white transition">Contact Us</a></li>
          <li><a href="feedback.php" class="text-gray-400 hover:text-white transition">Feedback</a></li>
        </ul>
      </div>
      
      <div>
        <h3 class="text-white font-bold text-lg mb-4">Academics</h3>
        <ul class="space-y-2">
          <li><a href="#" class="text-gray-400 hover:text-white transition">Admissions</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Programs</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Calendar</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Resources</a></li>
        </ul>
      </div>
      
      <div>
        <h3 class="text-white font-bold text-lg mb-4">Contact</h3>
        <ul class="space-y-2">
          <li class="flex items-start">
            <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-400"></i>
            <span class="text-gray-400">123 Education St, Addis Ababa, Ethiopia</span>
          </li>
          <li class="flex items-center">
            <i class="fas fa-phone-alt mr-3 text-blue-400"></i>
            <span class="text-gray-400">+251 123 456 789</span>
          </li>
          <li class="flex items-center">
            <i class="fas fa-envelope mr-3 text-blue-400"></i>
            <span class="text-gray-400">info@hailemariammamo.edu</span>
          </li>
        </ul>
      </div>
    </div>
    
    <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500">
      <p>&copy; 2025 Hailemariam Mamo Preparatory School. All rights reserved.</p>
      <div class="flex justify-center space-x-6 mt-4">
        <a href="privacy.php" class="text-gray-500 hover:text-white transition">Privacy Policy</a>
        <a href="terms.php" class="text-gray-500 hover:text-white transition">Terms of Service</a>
        <a href="sitemap.php" class="text-gray-500 hover:text-white transition">Sitemap</a>
      </div>
    </div>
  </div>
</footer>

<!-- Back to Top Button -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition duration-300 opacity-0 invisible">
  <i class="fas fa-arrow-up"></i>
</button>

<!-- JavaScript -->
<script>
  // Mobile menu toggle
  const menuBtn = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuOpenIcon = document.getElementById('menu-open-icon');
  const menuCloseIcon = document.getElementById('menu-close-icon');
  
  menuBtn.addEventListener('click', () => {
    const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
    menuBtn.setAttribute('aria-expanded', !isExpanded);
    mobileMenu.classList.toggle('hidden');
    menuOpenIcon.classList.toggle('hidden');
    menuCloseIcon.classList.toggle('hidden');
  });

  // Back to top button
  const backToTopButton = document.getElementById('back-to-top');
  
  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
      backToTopButton.classList.remove('opacity-0', 'invisible');
      backToTopButton.classList.add('opacity-100', 'visible');
    } else {
      backToTopButton.classList.remove('opacity-100', 'visible');
      backToTopButton.classList.add('opacity-0', 'invisible');
    }
  });
  
  backToTopButton.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  // Form validation
  const contactForm = document.getElementById('contact-form');
  
  function showError(elementId, message) {
    const element = document.getElementById(elementId);
    element.textContent = message;
    element.classList.remove('hidden');
  }
  
  function hideError(elementId) {
    const element = document.getElementById(elementId);
    element.classList.add('hidden');
  }
  
  contactForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    // Reset errors
    hideError('name-error');
    hideError('email-error');
    hideError('subject-error');
    hideError('message-error');
    
    // Validate form
    let isValid = true;
    
    const name = document.getElementById('name').value.trim();
    if (name === '') {
      showError('name-error', 'Please enter your name');
      isValid = false;
    }
    
    const email = document.getElementById('email').value.trim();
    if (email === '') {
      showError('email-error', 'Please enter your email');
      isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showError('email-error', 'Please enter a valid email');
      isValid = false;
    }
    
    const subject = document.getElementById('subject').value.trim();
    if (subject === '') {
      showError('subject-error', 'Please enter a subject');
      isValid = false;
    }
    
    const message = document.getElementById('message').value.trim();
    if (message === '') {
      showError('message-error', 'Please enter your message');
      isValid = false;
    }
    
    if (isValid) {
      // In a real implementation, you would send the form data to the server here
      alert('Thank you for your message! We will get back to you soon.');
      contactForm.reset();
    }
  });

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 100,
          behavior: 'smooth'
        });
        
        // Close mobile menu if open
        if (!mobileMenu.classList.contains('hidden')) {
          mobileMenu.classList.add('hidden');
          menuOpenIcon.classList.remove('hidden');
          menuCloseIcon.classList.add('hidden');
          menuBtn.setAttribute('aria-expanded', 'false');
        }
      }
    });
  });
</script>

</body>
</html>