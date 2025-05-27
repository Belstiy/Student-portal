<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hailemariam Mamo Preparatory School</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e',
            }
          },
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          },
        }
      }
    }
  </script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .video-background {
      width: 100%;
      height: auto;
      max-height: 400px;
      border-radius: 1rem;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      transition: transform 0.3s ease;
    }
    .video-background:hover {
      transform: scale(1.02);
    }
    html {
      scroll-behavior: smooth;
    }
    .menu-icon div {
      transition: all 0.3s ease-in-out;
    }
    .menu-open .bar1 {
      transform: rotate(45deg) translate(5px, 5px);
    }
    .menu-open .bar2 {
      opacity: 0;
    }
    .menu-open .bar3 {
      transform: rotate(-45deg) translate(5px, -5px);
    }
    .hero-gradient {
      background: linear-gradient(135deg, rgba(6, 82, 147, 0.8) 0%, rgba(12, 74, 110, 0.9) 100%);
    }
    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .back-to-top {
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      z-index: 999;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }
    .back-to-top.active {
      opacity: 1;
      visibility: visible;
    }
      .gradient-text {
      background: linear-gradient(90deg, #0ea5e9 0%, #22c55e 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

<!-- Navbar -->
<nav id="navbar" class="bg-white shadow-sm sticky top-0 z-50 transition-all duration-300">
  <div class="container mx-auto px-4 py-3">
    <div class="flex items-center justify-between">
     <!-- Logo -->
      <div class="flex items-center space-x-3">
        <img src="uploads/logo.png" alt="Logo" class="h-12 w-12 rounded-full border-2 border-blue-600 shadow-lg">
        <span class="font-bold text-xl sm:text-2xl gradient-text tracking-wide">HAILEMARIAM MAMO</span>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden lg:flex items-center space-x-8">
        <div class="flex space-x-6 text-base font-medium">
          <a href="index.php" class="text-primary-700 border-b-2 border-primary-700 pb-1 transition">Home</a>
          <a href="about_us.php" class="text-gray-600 hover:text-primary-600 transition hover:border-b-2 hover:border-primary-600 pb-1">About Us</a>
          <a href="contactus.php" class="text-gray-600 hover:text-primary-600 transition hover:border-b-2 hover:border-primary-600 pb-1">Contact Us</a>
          <a href="feedback.php" class="text-gray-600 hover:text-primary-600 transition hover:border-b-2 hover:border-primary-600 pb-1">Feedback</a>
        </div>
        <div class="flex space-x-4 ml-6">
        <a href="login.php" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-green-500 text-white rounded-full font-semibold shadow-lg hover:shadow-xl transition duration-300">Login</a>
          <a href="reg.php" class="px-5 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition duration-300 font-medium shadow-md hover:shadow-lg">Register</a>
        </div>
      </div>

      <!-- Mobile Menu Button -->
      <div class="lg:hidden">
        <button id="mobile-menu-button" class="menu-icon flex flex-col justify-center items-center w-10 h-10 rounded-md hover:bg-gray-100 transition">
          <div class="w-6 h-0.5 bg-primary-700 rounded-full bar1 mb-1.5"></div>
          <div class="w-6 h-0.5 bg-primary-700 rounded-full bar2 mb-1.5"></div>
          <div class="w-6 h-0.5 bg-primary-700 rounded-full bar3"></div>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden lg:hidden bg-white shadow-lg rounded-b-lg">
    <div class="container mx-auto px-4 py-3 flex flex-col space-y-4">
      <a href="index.php" class="py-2 px-4 rounded-lg bg-primary-50 text-primary-700 font-medium">Home</a>
      <a href="about_us.php" class="py-2 px-4 rounded-lg hover:bg-gray-50 text-gray-600 font-medium">About Us</a>
      <a href="contactus.php" class="py-2 px-4 rounded-lg hover:bg-gray-50 text-gray-600 font-medium">Contact Us</a>
      <a href="feedback.php" class="py-2 px-4 rounded-lg hover:bg-gray-50 text-gray-600 font-medium">Feedback</a>
      <div class="pt-2 flex space-x-3">
        <a href="login.php" class="flex-1 text-center py-2 border border-primary-600 text-primary-600 rounded-lg hover:bg-primary-50 transition font-medium">Login</a>
        <a href="reg.php" class="flex-1 text-center py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium">Register</a>
      </div>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="relative overflow-hidden">
  <!-- Background Image with Overlay -->
  <div class="absolute inset-0">
    <img src="uploads/back.jpg" alt="School Background" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black opacity-50"></div>
  </div>
  
  <div class="relative container mx-auto px-6 py-24 md:py-32 lg:py-40">
    <div class="flex flex-col lg:flex-row items-center justify-between">
      <!-- Text Content -->
      <div class="lg:w-1/2 mb-12 lg:mb-0 lg:pr-12" data-aos="fade-right">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight text-white mb-6">
          Welcome to <span class="text-primary-300">Hailemariam Mamo</span> Preparatory School
        </h1>
        <p class="text-lg md:text-xl text-gray-200 mb-8 leading-relaxed">
          Empowering students with quality education and preparing them for a bright future. Join us on a journey of academic excellence, character development, and lifelong learning.
        </p>
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
          <a href="reg.php" class="px-8 py-3 bg-primary-600 hover:bg-primary-900 text-white font-semibold rounded-lg transition duration-300 text-center shadow-lg hover:shadow-xl">
            Register Now
          </a>
        <a href="login.php" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-green-500 text-white rounded-full font-semibold shadow-lg hover:shadow-xl transition duration-300">Login</a>
            
        </div>
      </div>
      
      <!-- Video -->
      <div class="lg:w-1/2" data-aos="fade-left">
        <div class="relative rounded-xl overflow-hidden shadow-2xl transform transition hover:scale-[1.02] duration-500">
          <video autoplay muted loop playsinline class="video-background w-full">
            <source src="uploads/schools.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          <div class="absolute inset-0 flex items-center justify-center">
            <button id="play-button" class="bg-white bg-opacity-80 rounded-full p-4 shadow-lg hover:bg-opacity-100 transition">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Features Section -->
<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16" data-aos="fade-up">
      <span class="inline-block px-3 py-1 text-xs font-semibold tracking-wider text-slate-700 uppercase bg-slate-100 rounded-full">Educational Excellence</span>
      <h2 class="mt-5 text-3xl font-bold text-slate-900 sm:text-4xl lg:text-5xl">
        <span class="relative">
          <span class="relative z-10">Why Families Choose</span>
          <span class="absolute bottom-2 left-0 w-full h-3 bg-blue-100/70 z-0"></span>
        </span>
        <span class="block mt-2 text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Hailemariam Mamo</span>
      </h2>
      <div class="mt-8 max-w-3xl mx-auto">
        <p class="text-lg text-slate-600 leading-relaxed">
          We blend academic rigor with innovative pedagogy in a nurturing environment that cultivates lifelong learners and global citizens.
        </p>
      </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
      <!-- Feature 1 -->
      <div class="group relative bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-100 hover:border-blue-100/50" 
           data-aos="fade-up" data-aos-delay="100">
        <div class="absolute -inset-px rounded-xl border border-transparent group-hover:border-blue-200/30 transition duration-300 pointer-events-none"></div>
        <div class="relative">
          <div class="w-14 h-14 bg-gradient-to-br from-blue-50 to-white rounded-lg flex items-center justify-center mb-6 ring-1 ring-blue-100/50 shadow-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-3">Global Curriculum</h3>
          <p class="text-slate-600 leading-relaxed">
            Our IB-inspired curriculum combines international best practices with local context, preparing students for global success.
          </p>
          <div class="mt-6">
            <a href="#" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 transition group">
              Explore our programs
              <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>
        </div>
      </div>
      
      <!-- Feature 2 -->
      <div class="group relative bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-100 hover:border-blue-100/50" 
           data-aos="fade-up" data-aos-delay="150">
        <div class="absolute -inset-px rounded-xl border border-transparent group-hover:border-blue-200/30 transition duration-300 pointer-events-none"></div>
        <div class="relative">
          <div class="w-14 h-14 bg-gradient-to-br from-blue-50 to-white rounded-lg flex items-center justify-center mb-6 ring-1 ring-blue-100/50 shadow-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-3">Distinguished Faculty</h3>
          <p class="text-slate-600 leading-relaxed">
            85% of our teachers hold advanced degrees, with an average 12 years of experience in progressive education.
          </p>
          <div class="mt-6">
            <a href="#" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 transition group">
              Meet our educators
              <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>
        </div>
      </div>
      
      <!-- Feature 3 -->
      <div class="group relative bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-100 hover:border-blue-100/50" 
           data-aos="fade-up" data-aos-delay="200">
        <div class="absolute -inset-px rounded-xl border border-transparent group-hover:border-blue-200/30 transition duration-300 pointer-events-none"></div>
        <div class="relative">
          <div class="w-14 h-14 bg-gradient-to-br from-blue-50 to-white rounded-lg flex items-center justify-center mb-6 ring-1 ring-blue-100/50 shadow-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-3">Innovative Spaces</h3>
          <p class="text-slate-600 leading-relaxed">
            Our 8-acre campus features maker labs, innovation hubs, and collaborative learning environments.
          </p>
          <div class="mt-6">
            <a href="#" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 transition group">
              Virtual tour
              <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Digital Transformation Section -->
<section class="py-20 bg-slate-900" id="future">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16" data-aos="fade-up">
      <span class="inline-block px-3 py-1 text-xs font-semibold tracking-wider text-blue-200 uppercase bg-blue-900/30 rounded-full">Digital Transformation</span>
      <h2 class="mt-5 text-3xl font-bold text-white sm:text-4xl lg:text-5xl">
        <span class="relative">
          <span class="relative z-10">The Future of</span>
          <span class="absolute bottom-2 left-0 w-full h-3 bg-blue-900/30 z-0"></span>
        </span>
        <span class="block mt-2 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">School Management</span>
      </h2>
      <div class="mt-8 max-w-3xl mx-auto">
        <p class="text-lg text-slate-300 leading-relaxed">
          Our digital ecosystem integrates cutting-edge technology with pedagogical excellence to create seamless learning experiences.
        </p>
      </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <!-- Features List -->
      <div class="space-y-6" data-aos="fade-right">
        <div class="flex items-start space-x-5 p-6 bg-slate-800/50 rounded-xl backdrop-blur-sm border border-slate-700/50 hover:border-blue-700/30 transition">
          <div class="flex-shrink-0 mt-1">
            <div class="w-12 h-12 bg-blue-900/30 rounded-lg flex items-center justify-center border border-blue-800/30">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
              </svg>
            </div>
          </div>
          <div>
            <h3 class="text-xl font-semibold text-white mb-2">Intelligent Analytics</h3>
            <p class="text-slate-300 leading-relaxed">
              Machine learning algorithms provide real-time insights into student progress and personalized learning pathways.
            </p>
          </div>
        </div>
        
        <div class="flex items-start space-x-5 p-6 bg-slate-800/50 rounded-xl backdrop-blur-sm border border-slate-700/50 hover:border-blue-700/30 transition">
          <div class="flex-shrink-0 mt-1">
            <div class="w-12 h-12 bg-blue-900/30 rounded-lg flex items-center justify-center border border-blue-800/30">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
              </svg>
            </div>
          </div>
          <div>
            <h3 class="text-xl font-semibold text-white mb-2">Unified Communication</h3>
            <p class="text-slate-300 leading-relaxed">
              Integrated messaging platform connects teachers, students and parents with end-to-end encryption.
            </p>
          </div>
        </div>
        
        <div class="flex items-start space-x-5 p-6 bg-slate-800/50 rounded-xl backdrop-blur-sm border border-slate-700/50 hover:border-blue-700/30 transition">
          <div class="flex-shrink-0 mt-1">
            <div class="w-12 h-12 bg-blue-900/30 rounded-lg flex items-center justify-center border border-blue-800/30">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
          </div>
          <div>
            <h3 class="text-xl font-semibold text-white mb-2">Enterprise Security</h3>
            <p class="text-slate-300 leading-relaxed">
              Military-grade encryption and ISO 27001 certified data centers ensure complete data protection.
            </p>
          </div>
        </div>
      </div>
      
      <!-- Image -->
      <div class="relative" data-aos="zoom-in">
        <div class="relative rounded-xl overflow-hidden shadow-2xl border border-slate-700/50">
          <img src="uploads/future.jpg" alt="Digital transformation" class="w-full h-auto object-cover aspect-video" loading="lazy" />
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-transparent to-transparent"></div>
          <div class="absolute bottom-0 left-0 right-0 p-6">
            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-900/30 text-blue-100 border border-blue-800/30 mb-3">
              Coming 2024
            </div>
            <h3 class="text-xl font-semibold text-white">Next-Gen Learning Platform</h3>
            <p class="text-slate-300 text-sm mt-1">AI-powered personalized education ecosystem</p>
          </div>
        </div>
        <div class="absolute -z-10 -bottom-6 -right-6 w-64 h-64 rounded-full bg-blue-900/10 blur-3xl"></div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-gray-50">
  <div class="container mx-auto px-6">
    <div class="text-center mb-16" data-aos="fade-up">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">What Parents Say</h2>
      <div class="w-20 h-1 bg-primary-600 mx-auto mb-6"></div>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">
        Hear from our community about their experiences with Hailemariam Mamo Preparatory School.
      </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Testimonial 1 -->
      <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100" data-aos="fade-up" data-aos-delay="100">
        <div class="flex items-center mb-4">
          <div class="text-yellow-400 flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
          </div>
        </div>
        <p class="text-gray-600 mb-6">
          "My child has flourished academically and socially since joining Hailemariam Mamo. The teachers are dedicated and the facilities are excellent."
        </p>
        <div class="flex items-center">
          <img src="uploads/parent1.jpg" alt="Parent" class="w-12 h-12 rounded-full object-cover border-2 border-primary-100">
          <div class="ml-4">
            <h4 class="font-semibold text-gray-900">Ato Kebede</h4>
            <p class="text-gray-600 text-sm">Parent of Grade 10 Student</p>
          </div>
        </div>
      </div>
      
      <!-- Testimonial 2 -->
      <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100" data-aos="fade-up" data-aos-delay="200">
        <div class="flex items-center mb-4">
          <div class="text-yellow-400 flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
          </div>
        </div>
        <p class="text-gray-600 mb-6">
          "The digital transformation at this school is impressive. I can track my child's progress in real-time through the parent portal."
        </p>
        <div class="flex items-center">
          <img src="uploads/parent2.jpg" alt="Parent" class="w-12 h-12 rounded-full object-cover border-2 border-primary-100">
          <div class="ml-4">
            <h4 class="font-semibold text-gray-900">W/ro Selam</h4>
            <p class="text-gray-600 text-sm">Parent of Grade 12 Student</p>
          </div>
        </div>
      </div>
      
      <!-- Testimonial 3 -->
      <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100" data-aos="fade-up" data-aos-delay="300">
        <div class="flex items-center mb-4">
          <div class="text-yellow-400 flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
          </div>
        </div>
        <p class="text-gray-600 mb-6">
          "The balance between academics and extracurricular activities is perfect. My child is developing holistically."
        </p>
        <div class="flex items-center">
          <img src="uploads/parent3.jpg" alt="Parent" class="w-12 h-12 rounded-full object-cover border-2 border-primary-100">
          <div class="ml-4">
            <h4 class="font-semibold text-gray-900">Ato Yohannes</h4>
            <p class="text-gray-600 text-sm">Parent of Grade 11 Student</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-primary-700">
  <div class="container mx-auto px-6 text-center">
    <div class="max-w-4xl mx-auto" data-aos="zoom-in">
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Join Our School Community?</h2>
      <p class="text-xl text-white text-opacity-90 mb-8">
        Give your child the gift of quality education. Register now or contact us for more information.
      </p>
      <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
        <a href="reg.php" class="px-8 py-3 bg-white text-primary-700 font-semibold rounded-lg hover:bg-gray-100 transition duration-300 shadow-lg">
          Register Now
        </a>
        <a href="contactus.php" class="px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary-700 transition duration-300">
          Contact Us
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Back to Top Button -->
<button id="back-to-top" class="back-to-top bg-primary-600 text-white p-3 rounded-full shadow-lg hover:bg-primary-700 transition">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
  </svg>
</button>

<?php include 'footer.php'; ?>

<!-- JavaScript -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  // Initialize AOS for animations with more options
  AOS.init({
    duration: 800,
    once: false, // Allow animations to trigger again
    easing: 'ease-in-out-quart',
    mirror: true,
    anchorPlacement: 'top-bottom',
    offset: 120
  });

  // Mobile menu toggle with improved accessibility
  const menuBtn = document.getElementById("mobile-menu-button");
  const mobileMenu = document.getElementById("mobile-menu");
  
  menuBtn.addEventListener("click", () => {
    const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
    menuBtn.setAttribute('aria-expanded', !isExpanded);
    mobileMenu.classList.toggle("hidden");
    menuBtn.classList.toggle("menu-open");
    
    // Toggle body scroll when menu is open
    document.body.style.overflow = isExpanded ? 'auto' : 'hidden';
  });

  // Navbar effects with debounce for performance
  const navbar = document.getElementById("navbar");
  let lastScroll = 0;
  
  const handleScroll = () => {
    const currentScroll = window.scrollY;
    
    // Add/remove shadow and solid background
    if (currentScroll > 20) {
      navbar.classList.add("shadow-lg", "bg-white");
      navbar.classList.remove("bg-opacity-90");
    } else {
      navbar.classList.remove("shadow-lg");
      navbar.classList.add("bg-opacity-90");
    }
    
    // Hide navbar on scroll down, show on scroll up
    if (currentScroll > lastScroll && currentScroll > 100) {
      navbar.style.transform = "translateY(-100%)";
    } else {
      navbar.style.transform = "translateY(0)";
    }
    lastScroll = currentScroll;
  };

  // Debounce scroll event for performance
  let scrollTimeout;
  window.addEventListener('scroll', () => {
    clearTimeout(scrollTimeout);
    scrollTimeout = setTimeout(handleScroll, 16);
  });

  // Back to top button with progress indicator
  const backToTopButton = document.getElementById("back-to-top");
  const updateBackToTop = () => {
    const scrollPosition = window.scrollY;
    const windowHeight = window.innerHeight;
    const documentHeight = document.documentElement.scrollHeight;
    const scrollPercentage = (scrollPosition / (documentHeight - windowHeight)) * 100;
    
    if (scrollPosition > 300) {
      backToTopButton.classList.add("active");
      backToTopButton.style.setProperty('--progress', `${Math.min(scrollPercentage, 100)}%`);
    } else {
      backToTopButton.classList.remove("active");
    }
  };
  
  window.addEventListener('scroll', updateBackToTop);
  
  backToTopButton.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });

  // Video play/pause functionality with keyboard controls
  const video = document.querySelector(".video-background");
  const playButton = document.getElementById("play-button");
  
  const toggleVideo = () => {
    if (video.paused) {
      video.play();
      playButton.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
      `;
    } else {
      video.pause();
      playButton.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
        </svg>
      `;
    }
  };
  
  playButton.addEventListener("click", toggleVideo);
  
  // Keyboard controls for video
  document.addEventListener('keydown', (e) => {
    if (e.target === document.body && e.key === ' ') {
      e.preventDefault();
      toggleVideo();
    }
  });

  // Close mobile menu when clicking on a link or outside
  const closeMobileMenu = () => {
    mobileMenu.classList.add("hidden");
    menuBtn.classList.remove("menu-open");
    menuBtn.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = 'auto';
  };
  
  const mobileLinks = document.querySelectorAll("#mobile-menu a");
  mobileLinks.forEach(link => {
    link.addEventListener("click", closeMobileMenu);
  });
  
  // Close when clicking outside
  document.addEventListener('click', (e) => {
    if (!mobileMenu.contains(e.target) && !menuBtn.contains(e.target)) {
      closeMobileMenu();
    }
  });

  // Smooth scrolling for anchor links with offset
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function(e) {
      e.preventDefault();
      const targetId = this.getAttribute("href");
      if (targetId === "#") return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        const navbarHeight = navbar.offsetHeight;
        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
        
        window.scrollTo({
          top: targetPosition,
          behavior: "smooth"
        });
        
        // Update URL without jumping
        if (history.pushState) {
          history.pushState(null, null, targetId);
        } else {
          location.hash = targetId;
        }
      }
    });
  });

  // Intersection Observer for lazy loading and scroll animations
  const animateOnScroll = (entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('aos-animate');
        observer.unobserve(entry.target);
      }
    });
  };
  
  const observer = new IntersectionObserver(animateOnScroll, {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
  });
  
  document.querySelectorAll('[data-aos]').forEach(el => {
    observer.observe(el);
  });

  // Lazy load images
  if ('loading' in HTMLImageElement.prototype) {
    const lazyImages = document.querySelectorAll('img[loading="lazy"]');
    lazyImages.forEach(img => {
      img.loading = 'lazy';
    });
  } else {
    // Fallback for browsers that don't support native lazy loading
    const lazyScript = document.createElement('script');
    lazyScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
    document.body.appendChild(lazyScript);
  }

  // Form input animations
  const formInputs = document.querySelectorAll('input, textarea, select');
  formInputs.forEach(input => {
    input.addEventListener('focus', () => {
      input.parentElement.classList.add('input-focused');
    });
    input.addEventListener('blur', () => {
      if (!input.value) {
        input.parentElement.classList.remove('input-focused');
      }
    });
  });

  // Dynamic year for copyright
  const yearElement = document.getElementById('current-year');
  if (yearElement) {
    yearElement.textContent = new Date().getFullYear();
  }

  // Service worker registration for PWA
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/sw.js').then(registration => {
        console.log('ServiceWorker registration successful');
      }).catch(err => {
        console.log('ServiceWorker registration failed: ', err);
      });
    });
  }

  // Dark mode toggle (optional)
  const darkModeToggle = document.getElementById('dark-mode-toggle');
  if (darkModeToggle) {
    darkModeToggle.addEventListener('click', () => {
      document.documentElement.classList.toggle('dark');
      localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
    });
    
    // Check for saved preference
    if (localStorage.getItem('darkMode') === 'true') {
      document.documentElement.classList.add('dark');
    }
  }

  // Add this to your existing CSS or style section
  const style = document.createElement('style');
  style.textContent = `
    .back-to-top::before {
      content: '';
      position: absolute;
      top: -4px;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(to right, #0ea5e9 var(--progress, 0%), transparent var(--progress, 0%));
      border-radius: 2px 2px 0 0;
    }
    .input-focused label {
      transform: translateY(-1.5rem) scale(0.85);
      color: #0ea5e9;
    }
    @media (prefers-reduced-motion: reduce) {
      * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
      }
    }
  `;
  document.head.appendChild(style);
</script>
</body>
</html>