<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - Hailemariam Mamo Preparatory School</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    html {
      scroll-behavior: smooth;
    }
    
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
    
    .feature-card {
      transition: all 0.3s ease;
      transform: translateY(0);
    }
    
    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .stats-card {
      transition: all 0.3s ease;
    }
    
    .stats-card:hover {
      transform: scale(1.05);
    }
    
    .team-card {
      transition: all 0.3s ease;
    }
    
    .team-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .back-to-top {
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }
    
    .back-to-top.active {
      opacity: 1;
      visibility: visible;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Navbar -->
<nav class="bg-white shadow-sm sticky top-0 z-50 backdrop-blur-sm bg-opacity-90 transition-all duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-20 items-center">
      <!-- Logo -->
      <div class="flex-shrink-0 flex items-center">
        <div class="flex items-center space-x-3">
          <img src="uploads/logo.png" alt="Logo" class="h-10 w-10 rounded-full border-2 border-blue-600 shadow-md animate-float">
          <span class="font-bold text-xl gradient-text tracking-tight">HAILEMARIAM MAMO</span>
        </div>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden md:flex items-center space-x-8">
        <a href="index.php" class="nav-link text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Home</a>
        <a href="about_us.php" class="nav-link active text-blue-600 px-3 py-2 text-sm font-medium">About Us</a>
        <a href="contactus.php" class="nav-link text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Contact Us</a>
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
  <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg rounded-lg mx-4 mt-2 py-2 animate-fadeIn">
    <div class="px-2 pt-2 pb-3 space-y-2">
      <a href="index.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition">Home</a>
      <a href="about_us.php" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 bg-blue-50">About Us</a>
      <a href="contactus.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition">Contact Us</a>
      <a href="feedback.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition">Feedback</a>
      <div class="pt-2 space-y-2">
        <a href="login.php" class="block px-3 py-2 text-center border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 transition">Login</a>
        <a href="reg.php" class="block px-3 py-2 text-center bg-blue-600 text-white rounded-md hover:bg-blue-700 transition shadow-md">Register</a>
      </div>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-50 to-green-50 py-20 overflow-hidden">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxjaXJjbGUgZmlsbD0iIzBkYjNmOSIgY3g9IjIwIiBjeT0iMjAiIHI9IjMiLz48L2c+PC9zdmc+')]"></div>
  </div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
    <div class="text-center" data-aos="fade-up">
      <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-6">About Our School</h1>
      <p class="text-xl md:text-2xl text-gray-700 max-w-3xl mx-auto">
        Excellence in education since 1995. Shaping futures through innovative learning and holistic development.
      </p>
    </div>
  </div>
</section>

<!-- About Content Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
  <div class="grid md:grid-cols-2 gap-12 items-center">
    <div class="space-y-6" data-aos="fade-right">
      <h2 class="text-3xl font-bold text-gray-900">Our Story</h2>
      <p class="text-lg text-gray-600">
        Founded in 1995, Hailemariam Mamo Preparatory School began as a small institution with just 50 students and a vision to provide quality education in our community. Today, we serve over 1,200 students with state-of-the-art facilities and a dedicated faculty.
      </p>
      <p class="text-lg text-gray-600">
        Our journey has been marked by continuous growth and innovation, always staying true to our core values of integrity, excellence, and community.
      </p>
      <div class="flex space-x-4 pt-4">
        <a href="#mission" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 shadow-md hover:shadow-lg">
          Our Mission
        </a>
        <a href="#gallery" class="px-6 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition duration-300">
          View Gallery
        </a>
      </div>
    </div>
    <div class="relative" data-aos="fade-left">
      <img src="uploads/school-building.jpg" alt="School Building" class="rounded-xl shadow-xl w-full h-auto max-h-96 object-cover">
      <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-lg shadow-lg border border-gray-100">
        <div class="text-center">
          <span class="block text-3xl font-bold text-blue-600">25+</span>
          <span class="text-gray-600">Years of Excellence</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Mission Section -->
<section id="mission" class="bg-blue-50 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12" data-aos="fade-up">
      <h2 class="text-3xl font-bold text-gray-900">Our Mission & Values</h2>
      <p class="text-xl text-gray-600 mt-4 max-w-3xl mx-auto">
        Guiding principles that shape our educational approach
      </p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-8">
      <div class="feature-card bg-white p-8 rounded-xl shadow-md" data-aos="fade-up" data-aos-delay="100">
        <div class="text-blue-600 mb-4">
          <i class="fas fa-bullseye text-4xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Mission</h3>
        <p class="text-gray-600">
          To provide a transformative educational experience that empowers students to achieve their full potential and become responsible global citizens.
        </p>
      </div>
      
      <div class="feature-card bg-white p-8 rounded-xl shadow-md" data-aos="fade-up" data-aos-delay="200">
        <div class="text-green-600 mb-4">
          <i class="fas fa-eye text-4xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Vision</h3>
        <p class="text-gray-600">
          To be recognized as a leader in innovative education, fostering academic excellence, creativity, and character development.
        </p>
      </div>
      
      <div class="feature-card bg-white p-8 rounded-xl shadow-md" data-aos="fade-up" data-aos-delay="300">
        <div class="text-yellow-600 mb-4">
          <i class="fas fa-heart text-4xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Values</h3>
        <p class="text-gray-600">
          Integrity, Respect, Excellence, Innovation, and Community - these core values guide everything we do at Hailemariam Mamo.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-green-600 text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid md:grid-cols-4 gap-6 text-center">
      <div class="stats-card bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-sm" data-aos="zoom-in">
        <span class="block text-4xl font-bold mb-2">1,200+</span>
        <span class="text-lg">Students</span>
      </div>
      <div class="stats-card bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-sm" data-aos="zoom-in" data-aos-delay="100">
        <span class="block text-4xl font-bold mb-2">85+</span>
        <span class="text-lg">Qualified Teachers</span>
      </div>
      <div class="stats-card bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-sm" data-aos="zoom-in" data-aos-delay="200">
        <span class="block text-4xl font-bold mb-2">25+</span>
        <span class="text-lg">Years of Experience</span>
      </div>
      <div class="stats-card bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-sm" data-aos="zoom-in" data-aos-delay="300">
        <span class="block text-4xl font-bold mb-2">98%</span>
        <span class="text-lg">Graduation Rate</span>
      </div>
    </div>
  </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12" data-aos="fade-up">
      <h2 class="text-3xl font-bold text-gray-900">Our Campus</h2>
      <p class="text-xl text-gray-600 mt-4">Explore our state-of-the-art facilities and vibrant learning environment</p>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
      <div class="relative group overflow-hidden rounded-lg" data-aos="fade-up">
        <img src="uploads/library.jpg" alt="School Library" class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
          <span class="text-white font-medium">Library</span>
        </div>
      </div>
      <div class="relative group overflow-hidden rounded-lg" data-aos="fade-up" data-aos-delay="100">
        <img src="uploads/lab.jpg" alt="Science Lab" class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
          <span class="text-white font-medium">Science Lab</span>
        </div>
      </div>
      <div class="relative group overflow-hidden rounded-lg" data-aos="fade-up" data-aos-delay="200">
        <img src="uploads/sports.jpg" alt="Sports Field" class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
          <span class="text-white font-medium">Sports Field</span>
        </div>
      </div>
      <div class="relative group overflow-hidden rounded-lg" data-aos="fade-up">
        <img src="uploads/classroom.jpg" alt="Classroom" class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
          <span class="text-white font-medium">Modern Classroom</span>
        </div>
      </div>
      <div class="relative group overflow-hidden rounded-lg" data-aos="fade-up" data-aos-delay="100">
        <img src="uploads/auditorium.jpg" alt="Auditorium" class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
          <span class="text-white font-medium">Auditorium</span>
        </div>
      </div>
      <div class="relative group overflow-hidden rounded-lg" data-aos="fade-up" data-aos-delay="200">
        <img src="uploads/cafeteria.jpg" alt="Cafeteria" class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
          <span class="text-white font-medium">Cafeteria</span>
        </div>
      </div>
    </div>
    
    <div class="text-center mt-10">
      <a href="#" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 shadow-md hover:shadow-lg" data-aos="fade-up">
        View Full Gallery
      </a>
    </div>
  </div>
</section>

<!-- Leadership Section -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12" data-aos="fade-up">
      <h2 class="text-3xl font-bold text-gray-900">Our Leadership</h2>
      <p class="text-xl text-gray-600 mt-4">Meet the dedicated team guiding our institution</p>
    </div>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
      <div class="team-card bg-white p-6 rounded-xl shadow-md text-center" data-aos="fade-up">
        <div class="w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full border-4 border-white shadow-lg">
          <img src="uploads/principal.jpg" alt="Principal" class="w-full h-full object-cover">
        </div>
        <h3 class="text-xl font-bold text-gray-900">Dr. Selamawit Kebede</h3>
        <p class="text-blue-600 mb-3">Principal</p>
        <p class="text-gray-600 text-sm">
          With 20 years of educational leadership experience, Dr. Kebede is committed to academic excellence.
        </p>
        <div class="flex justify-center space-x-3 mt-4">
          <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-linkedin"></i></a>
          <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fas fa-envelope"></i></a>
        </div>
      </div>
      
      <div class="team-card bg-white p-6 rounded-xl shadow-md text-center" data-aos="fade-up" data-aos-delay="100">
        <div class="w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full border-4 border-white shadow-lg">
          <img src="uploads/vice-principal.jpg" alt="Vice Principal" class="w-full h-full object-cover">
        </div>
        <h3 class="text-xl font-bold text-gray-900">Mr. Yohannes Assefa</h3>
        <p class="text-blue-600 mb-3">Vice Principal</p>
        <p class="text-gray-600 text-sm">
          Specializing in curriculum development and student affairs with 15 years of experience.
        </p>
        <div class="flex justify-center space-x-3 mt-4">
          <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-linkedin"></i></a>
          <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fas fa-envelope"></i></a>
        </div>
      </div>
      
      <div class="team-card bg-white p-6 rounded-xl shadow-md text-center" data-aos="fade-up" data-aos-delay="200">
        <div class="w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full border-4 border-white shadow-lg">
          <img src="uploads/academic-director.jpg" alt="Academic Director" class="w-full h-full object-cover">
        </div>
        <h3 class="text-xl font-bold text-gray-900">Mrs. Tigist Worku</h3>
        <p class="text-blue-600 mb-3">Academic Director</p>
        <p class="text-gray-600 text-sm">
          Leads our academic programs with a focus on innovative teaching methodologies.
        </p>
        <div class="flex justify-center space-x-3 mt-4">
          <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-linkedin"></i></a>
          <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fas fa-envelope"></i></a>
        </div>
      </div>
      
      <div class="team-card bg-white p-6 rounded-xl shadow-md text-center" data-aos="fade-up" data-aos-delay="300">
        <div class="w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full border-4 border-white shadow-lg">
          <img src="uploads/administrator.jpg" alt="Administrator" class="w-full h-full object-cover">
        </div>
        <h3 class="text-xl font-bold text-gray-900">Mr. Daniel Mekonnen</h3>
        <p class="text-blue-600 mb-3">Administrator</p>
        <p class="text-gray-600 text-sm">
          Oversees school operations and facilities management to ensure smooth daily functioning.
        </p>
        <div class="flex justify-center space-x-3 mt-4">
          <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fab fa-linkedin"></i></a>
          <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fas fa-envelope"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12" data-aos="fade-up">
      <h2 class="text-3xl font-bold text-gray-900">What People Say</h2>
      <p class="text-xl text-gray-600 mt-4">Testimonials from our community</p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-gray-50 p-8 rounded-xl" data-aos="fade-up">
        <div class="flex items-center mb-4">
          <div class="text-yellow-400 mr-2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
        </div>
        <p class="text-gray-700 mb-6">
          "Hailemariam Mamo provided my children with not just education, but values and skills that have helped them succeed in university and beyond."
        </p>
        <div class="flex items-center">
          <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
            <img src="uploads/parent1.jpg" alt="Parent" class="w-full h-full object-cover">
          </div>
          <div>
            <h4 class="font-bold text-gray-900">Mrs. Alemitu Bekele</h4>
            <p class="text-gray-600 text-sm">Parent</p>
          </div>
        </div>
      </div>
      
      <div class="bg-gray-50 p-8 rounded-xl" data-aos="fade-up" data-aos-delay="100">
        <div class="flex items-center mb-4">
          <div class="text-yellow-400 mr-2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
        </div>
        <p class="text-gray-700 mb-6">
          "The teachers here go above and beyond to ensure every student understands the material. I've grown so much academically and personally."
        </p>
        <div class="flex items-center">
          <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
            <img src="uploads/student1.jpg" alt="Student" class="w-full h-full object-cover">
          </div>
          <div>
            <h4 class="font-bold text-gray-900">Nathaniel Yohannes</h4>
            <p class="text-gray-600 text-sm">Grade 12 Student</p>
          </div>
        </div>
      </div>
      
      <div class="bg-gray-50 p-8 rounded-xl" data-aos="fade-up" data-aos-delay="200">
        <div class="flex items-center mb-4">
          <div class="text-yellow-400 mr-2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
        </div>
        <p class="text-gray-700 mb-6">
          "Working at Hailemariam Mamo has been incredibly rewarding. The administration supports innovative teaching methods that truly engage students."
        </p>
        <div class="flex items-center">
          <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
            <img src="uploads/teacher1.jpg" alt="Teacher" class="w-full h-full object-cover">
          </div>
          <div>
            <h4 class="font-bold text-gray-900">Mr. Samuel Getachew</h4>
            <p class="text-gray-600 text-sm">Mathematics Teacher</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-green-600 text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl font-bold mb-6" data-aos="fade-up">Ready to Join Our Community?</h2>
    <p class="text-xl mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
      Discover how Hailemariam Mamo Preparatory School can help your child achieve their full potential.
    </p>
    <div class="flex flex-col sm:flex-row justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
      <a href="contactus.php" class="px-8 py-3 bg-white text-blue-600 rounded-lg font-bold hover:bg-gray-100 transition duration-300 shadow-lg">
        Contact Us
      </a>
      <a href="reg.php" class="px-8 py-3 border-2 border-white text-white rounded-lg font-bold hover:bg-white hover:text-blue-600 transition duration-300">
        Apply Now
      </a>
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
        <div class="flex space-x-4 mt-4">
          <a href="#" class="text-gray-400 hover:text-white transition">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white transition">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white transition">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white transition">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>
      
      <div>
        <h3 class="text-white font-bold text-lg mb-4">Quick Links</h3>
        <ul class="space-y-2">
          <li><a href="index.php" class="text-gray-400 hover:text-white transition">Home</a></li>
          <li><a href="about_us.php" class="text-gray-400 hover:text-white transition">About Us</a></li>
          <li><a href="contactus.php" class="text-gray-400 hover:text-white transition">Contact Us</a></li>
          <li><a href="feedback.php" class="text-gray-400 hover:text-white transition">Feedback</a></li>
          <li><a href="login.php" class="text-gray-400 hover:text-white transition">Login</a></li>
        </ul>
      </div>
      
      <div>
        <h3 class="text-white font-bold text-lg mb-4">Academics</h3>
        <ul class="space-y-2">
          <li><a href="#" class="text-gray-400 hover:text-white transition">Programs</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Admissions</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Calendar</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition">Library</a></li>
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
<button id="back-to-top" class="back-to-top fixed bottom-8 right-8 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition duration-300">
  <i class="fas fa-arrow-up"></i>
</button>

<!-- AOS Animation Library -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  // Initialize AOS animations
  AOS.init({
    duration: 800,
    once: true,
    easing: 'ease-in-out'
  });

  // Mobile menu toggle
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuOpenIcon = document.getElementById('menu-open-icon');
  const menuCloseIcon = document.getElementById('menu-close-icon');
  
  menuToggle.addEventListener('click', () => {
    const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
    menuToggle.setAttribute('aria-expanded', !isExpanded);
    mobileMenu.classList.toggle('hidden');
    menuOpenIcon.classList.toggle('hidden');
    menuCloseIcon.classList.toggle('hidden');
  });

  // Back to top button
  const backToTopButton = document.getElementById('back-to-top');
  
  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
      backToTopButton.classList.add('active');
    } else {
      backToTopButton.classList.remove('active');
    }
  });
  
  backToTopButton.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
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
          menuToggle.setAttribute('aria-expanded', 'false');
        }
      }
    });
  });

  // Navbar shadow on scroll
  const navbar = document.querySelector('nav');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 10) {
      navbar.classList.add('shadow-lg');
    } else {
      navbar.classList.remove('shadow-lg');
    }
  });

  // Image gallery modal functionality
  const galleryImages = document.querySelectorAll('#gallery img');
  galleryImages.forEach(img => {
    img.addEventListener('click', () => {
      // In a real implementation, you would open a modal here
      // This is just a placeholder for the functionality
      console.log('Opening image in modal:', img.src);
    });
  });

  // Testimonial carousel functionality (would be implemented with a library like Swiper in production)
  console.log('Testimonial carousel would be implemented here');
</script>

</body>
</html>