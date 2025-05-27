<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Site Map - Hailemariam Mamo School</title>
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
    .sitemap-item {
      transition: all 0.3s ease;
      border-left: 3px solid transparent;
    }
    .sitemap-item:hover {
      border-left-color: #0ea5e9;
      background-color: #f8fafc;
      transform: translateX(5px);
    }
    .sitemap-link {
      position: relative;
    }
    .sitemap-link::before {
      content: '';
      position: absolute;
      left: 0;
      bottom: -2px;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #0ea5e9 0%, #22c55e 100%);
      transition: width 0.3s ease;
    }
    .sitemap-link:hover::before {
      width: 100%;
    }
  </style>
</head>
<body class="bg-gray-50">
  <!-- Navigation -->
  <?php include 'navbar.php'; ?>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
      <h1 class="text-4xl font-bold gradient-text mb-4">Site Map</h1>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">Navigate through our website with ease</p>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="p-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Main Pages -->
          <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Main Pages</h2>
            <ul class="space-y-3">
              <li class="sitemap-item pl-4 py-2 rounded">
                <a href="index.php" class="sitemap-link text-gray-700 hover:text-blue-600 font-medium">Home</a>
              </li>
              <li class="sitemap-item pl-4 py-2 rounded">
                <a href="about_us.php" class="sitemap-link text-gray-700 hover:text-blue-600 font-medium">About Us</a>
                <ul class="ml-6 mt-2 space-y-2">
                  <li><a href="about_us.php#mission" class="text-gray-600 hover:text-blue-500 text-sm">Our Mission</a></li>
                  <li><a href="about_us.php#history" class="text-gray-600 hover:text-blue-500 text-sm">School History</a></li>
                  <li><a href="about_us.php#faculty" class="text-gray-600 hover:text-blue-500 text-sm">Faculty</a></li>
                </ul>
              </li>
             
              <li class="sitemap-item pl-4 py-2 rounded">
                <a href="contactus.php" class="sitemap-link text-gray-700 hover:text-blue-600 font-medium">Contact Us</a>
              </li>
            </ul>
          </div>

        

          <!-- Policies -->
          <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Policies</h2>
            <ul class="space-y-3">
              <li class="sitemap-item pl-4 py-2 rounded">
                <a href="privacy.php" class="sitemap-link text-gray-700 hover:text-blue-600 font-medium">Privacy Policy</a>
              </li>
              <li class="sitemap-item pl-4 py-2 rounded">
                <a href="terms.php" class="sitemap-link text-gray-700 hover:text-blue-600 font-medium">Terms of Service</a>
              </li>
            
            </ul>
          </div>

          <!-- Support -->
          <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Support</h2>
            <ul class="space-y-3">
             
              <li class="sitemap-item pl-4 py-2 rounded">
                <a href="feedback.php" class="sitemap-link text-gray-700 hover:text-blue-600 font-medium">Feedback</a>
              </li>
              
             
           
            </ul>
          </div>

          <!-- Quick Links -->
          <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Quick Links</h2>
            <ul class="space-y-3">
              <li class="sitemap-item pl-4 py-2 rounded">
                <a href="login.php" class="sitemap-link text-gray-700 hover:text-blue-600 font-medium">Login</a>
              </li>
              
              <li class="sitemap-item pl-4 py-2 rounded">
                <a href="sitemap.php" class="sitemap-link text-gray-700 hover:text-blue-600 font-medium">Site Map</a>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-12 bg-white rounded-xl shadow-lg p-8">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Can't Find What You Need?</h2>
      <p class="text-gray-600 mb-6">If you're having trouble finding something on our website, try our search feature or contact us directly.</p>
      <div class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
          <form class="flex">
            <input type="text" placeholder="Search our website..." class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700 transition">Search</button>
          </form>
        </div>
        <a href="contactus.php" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition text-center">Contact Us</a>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <script>
    // Add animation to sitemap items
    const sitemapItems = document.querySelectorAll('.sitemap-item');
    
    const itemObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-fadeIn');
          const delay = Array.from(sitemapItems).indexOf(entry.target) * 50;
          entry.target.style.animationDelay = `${delay}ms`;
        }
      });
    }, { threshold: 0.1 });

    sitemapItems.forEach(item => {
      itemObserver.observe(item);
    });
  </script>
</body>
</html>