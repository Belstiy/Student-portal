<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Feedback – Hailemariam Mamo Preparatory School</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    
    .rating-star {
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .rating-star:hover {
      transform: scale(1.2);
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fadeIn {
      animation: fadeIn 0.6s ease-out forwards;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

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
        <a href="contactus.php" class="nav-link text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Contact Us</a>
        <a href="feedback.php" class="nav-link active text-blue-600 px-3 py-2 text-sm font-medium">Feedback</a>
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
      <a href="contactus.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition">Contact Us</a>
      <a href="feedback.php" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 bg-blue-50">Feedback</a>
      <div class="pt-2 space-y-2">
        <a href="login.php" class="block px-3 py-2 text-center border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 transition">Login</a>
        <a href="reg.php" class="block px-3 py-2 text-center bg-blue-600 text-white rounded-md hover:bg-blue-700 transition shadow-md">Register</a>
      </div>
    </div>
  </div>
</nav>

<!-- Main Content -->
<main class="flex-grow">
  <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-fadeIn">
      <div class="p-8 sm:p-10">
        <div class="text-center mb-8">
          <h1 class="text-3xl sm:text-4xl font-bold gradient-text mb-4">Share Your Feedback</h1>
          <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Your opinion matters to us! Help us improve by sharing your experience with our school.
          </p>
        </div>
        
        <form id="feedbackForm" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
              <input type="text" id="name" name="name" required
                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition-all duration-200"
                     placeholder="Your name">
              <p id="name-error" class="mt-1 text-xs text-red-600 hidden"></p>
            </div>
            
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
              <input type="email" id="email" name="email" required
                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition-all duration-200"
                     placeholder="your.email@example.com">
              <p id="email-error" class="mt-1 text-xs text-red-600 hidden"></p>
            </div>
          </div>
          
          <div>
            <label for="feedback-type" class="block text-sm font-medium text-gray-700 mb-1">Feedback Type *</label>
            <select id="feedback-type" name="feedback-type" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition-all duration-200">
              <option value="" disabled selected>Select feedback type</option>
              <option value="general">General Feedback</option>
              <option value="academic">Academic Program</option>
              <option value="facilities">Facilities</option>
              <option value="staff">Staff</option>
              <option value="suggestion">Suggestion</option>
              <option value="complaint">Complaint</option>
            </select>
            <p id="type-error" class="mt-1 text-xs text-red-600 hidden"></p>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">Overall Satisfaction *</label>
            <div class="flex justify-center space-x-2" id="rating-container">
              <span class="rating-star text-3xl" data-rating="1">☆</span>
              <span class="rating-star text-3xl" data-rating="2">☆</span>
              <span class="rating-star text-3xl" data-rating="3">☆</span>
              <span class="rating-star text-3xl" data-rating="4">☆</span>
              <span class="rating-star text-3xl" data-rating="5">☆</span>
            </div>
            <input type="hidden" id="rating" name="rating" required>
            <p id="rating-error" class="mt-1 text-xs text-red-600 hidden text-center"></p>
          </div>
          
          <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Feedback *</label>
            <textarea id="message" name="message" rows="5" required
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition-all duration-200"
                      placeholder="Please share your detailed feedback here..."></textarea>
            <p id="message-error" class="mt-1 text-xs text-red-600 hidden"></p>
          </div>
          
          <div class="flex items-center">
            <input id="contact-permission" name="contact-permission" type="checkbox"
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="contact-permission" class="ml-2 block text-sm text-gray-700">
              I agree to be contacted for follow-up regarding this feedback
            </label>
          </div>
          
          <div>
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg btn-hover transition-all duration-300 shadow-md">
              Submit Feedback
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</main>

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

<!-- Success Modal -->
<div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-xl p-8 max-w-md mx-4 text-center animate-fadeIn">
    <div class="text-green-500 text-6xl mb-4">
      ✓
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-2">Thank You!</h3>
    <p class="text-gray-600 mb-6">Your feedback has been submitted successfully.</p>
    <button id="close-modal" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
      Close
    </button>
  </div>
</div>

<!-- JavaScript -->
<script>

  document.getElementById('feedbackForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Submitting...';
    submitBtn.disabled = true;

    // Hide errors
    document.querySelectorAll('[id$="-error"]').forEach(el => {
        el.classList.add('hidden');
    });

    try {
        const formData = new FormData(this);
        
        // Convert FormData to JSON for better debugging
        const formJson = {};
        formData.forEach((value, key) => formJson[key] = value);
        console.log('Submitting:', formJson);

        const response = await fetch('feedback_process.php', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) throw new Error('Network error');
        
        const data = await response.json();
        console.log('Response:', data);

        if (data.success) {
            document.getElementById('success-modal').classList.remove('hidden');
            this.reset();
            stars.forEach(star => star.textContent = '☆');
            ratingInput.value = '';
        } else {
            if (data.errors) {
                for (const [field, message] of Object.entries(data.errors)) {
                    const errorElement = document.getElementById(`${field}-error`);
                    if (errorElement) {
                        errorElement.textContent = message;
                        errorElement.classList.remove('hidden');
                    }
                }
            }
            alert(data.message || 'Submission failed');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred: ' + error.message);
    } finally {
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;
    }
    // Close modal button - make sure this is in your script
document.getElementById('close-modal').addEventListener('click', function() {
    document.getElementById('success-modal').classList.add('hidden');
    
    // Reset form and stars if needed
    document.getElementById('feedbackForm').reset();
    stars.forEach(star => {
        star.textContent = '☆';
        star.style.color = '';
    });
    document.getElementById('rating').value = '';
});

// Also add this to close when clicking outside the modal
document.getElementById('success-modal').addEventListener('click', function(e) {
    if (e.target === this) {  // If click is on the modal background
        this.classList.add('hidden');
    }
});
});
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

  // Rating system
  const stars = document.querySelectorAll('.rating-star');
  const ratingInput = document.getElementById('rating');
  
  stars.forEach(star => {
    star.addEventListener('click', () => {
      const rating = star.getAttribute('data-rating');
      ratingInput.value = rating;
      
      // Update star display
      stars.forEach((s, index) => {
        if (index < rating) {
          s.textContent = '★';
          s.style.color = '#f59e0b'; // yellow color for selected stars
        } else {
          s.textContent = '☆';
          s.style.color = ''; // reset color
        }
      });
      
      // Hide rating error if present
      document.getElementById('rating-error').classList.add('hidden');
    });
  });

  // Form validation
  const feedbackForm = document.getElementById('feedback-form');
  
  function showError(elementId, message) {
    const element = document.getElementById(elementId);
    element.textContent = message;
    element.classList.remove('hidden');
  }
  
  function hideError(elementId) {
    const element = document.getElementById(elementId);
    element.classList.add('hidden');
  }
  
  feedbackForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    // Reset errors
    hideError('name-error');
    hideError('email-error');
    hideError('type-error');
    hideError('rating-error');
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
      showError('email-error', 'Please enter a valid email address');
      isValid = false;
    }
    
    const feedbackType = document.getElementById('feedback-type').value;
    if (!feedbackType) {
      showError('type-error', 'Please select a feedback type');
      isValid = false;
    }
    
    const rating = document.getElementById('rating').value;
    if (!rating) {
      showError('rating-error', 'Please rate your experience');
      isValid = false;
    }
    
    const message = document.getElementById('message').value.trim();
    if (message === '') {
      showError('message-error', 'Please enter your feedback');
      isValid = false;
    }
    
    if (isValid) {
      // In a real implementation, you would send the form data to the server here
      // For demo purposes, we'll show a success message
      document.getElementById('success-modal').classList.remove('hidden');
    }
  });

  // Close modal
  document.getElementById('close-modal').addEventListener('click', () => {
    document.getElementById('success-modal').classList.add('hidden');
    feedbackForm.reset();
    
    // Reset stars
    stars.forEach(star => {
      star.textContent = '☆';
      star.style.color = '';
    });
    document.getElementById('rating').value = '';
  });

  // Close modal when clicking outside
  document.getElementById('success-modal').addEventListener('click', (e) => {
    if (e.target === document.getElementById('success-modal')) {
      document.getElementById('success-modal').classList.add('hidden');
      feedbackForm.reset();
      
      // Reset stars
      stars.forEach(star => {
        star.textContent = '☆';
        star.style.color = '';
      });
      document.getElementById('rating').value = '';
    }
  });
  
</script>

</body>
</html>