<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terms of Service - Hailemariam Mamo School</title>
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
    .term-card {
      transition: all 0.3s ease;
      border-left: 4px solid transparent;
    }
    .term-card:hover {
      transform: translateX(5px);
      border-left-color: #0ea5e9;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>
<body class="bg-gray-50">
  <!-- Navigation -->
  <?php include 'navbar.php'; ?>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
      <h1 class="text-4xl font-bold gradient-text mb-4">Terms of Service</h1>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">Effective date: <?php echo date('F j, Y'); ?></p>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-12">
      <div class="p-8 border-b border-gray-100">
        <p class="text-gray-600 mb-6">Welcome to Hailemariam Mamo School. By accessing or using our services, you agree to be bound by these Terms of Service.</p>
        
        <div class="space-y-8">
          <div class="term-card p-6 bg-gray-50 rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">1. Acceptance of Terms</h2>
            <p class="text-gray-600">By using our website, services, or enrolling in our school, you agree to comply with and be bound by these Terms of Service and our Privacy Policy.</p>
          </div>

          <div class="term-card p-6 bg-gray-50 rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">2. Enrollment and Registration</h2>
            <p class="text-gray-600 mb-3">To access certain services, you may be required to register and provide accurate information about yourself.</p>
            <ul class="list-disc pl-6 space-y-1 text-gray-600">
              <li>You must provide accurate and complete registration information</li>
              <li>You are responsible for maintaining the confidentiality of your account</li>
              <li>You must notify us immediately of any unauthorized use of your account</li>
            </ul>
          </div>

          <div class="term-card p-6 bg-gray-50 rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">3. Student Conduct</h2>
            <p class="text-gray-600 mb-3">All students are expected to adhere to the following code of conduct:</p>
            <div class="grid md:grid-cols-2 gap-4">
              <div class="bg-white p-4 rounded border border-gray-200">
                <h3 class="font-medium text-gray-800 mb-1">Respect</h3>
                <p class="text-gray-600 text-sm">Treat all community members with respect and dignity</p>
              </div>
              <div class="bg-white p-4 rounded border border-gray-200">
                <h3 class="font-medium text-gray-800 mb-1">Integrity</h3>
                <p class="text-gray-600 text-sm">Maintain academic honesty in all work</p>
              </div>
              <div class="bg-white p-4 rounded border border-gray-200">
                <h3 class="font-medium text-gray-800 mb-1">Responsibility</h3>
                <p class="text-gray-600 text-sm">Take responsibility for your actions and learning</p>
              </div>
              <div class="bg-white p-4 rounded border border-gray-200">
                <h3 class="font-medium text-gray-800 mb-1">Safety</h3>
                <p class="text-gray-600 text-sm">Follow all safety protocols and procedures</p>
              </div>
            </div>
          </div>

          <div class="term-card p-6 bg-gray-50 rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">4. Intellectual Property</h2>
            <p class="text-gray-600">All content provided by Hailemariam Mamo School, including curriculum materials, logos, and trademarks, are the property of the school and protected by intellectual property laws.</p>
          </div>

          <div class="term-card p-6 bg-gray-50 rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">5. Termination</h2>
            <p class="text-gray-600">We may terminate or suspend access to our services immediately, without prior notice, for any violation of these Terms of Service.</p>
          </div>

          <div class="term-card p-6 bg-gray-50 rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">6. Changes to Terms</h2>
            <p class="text-gray-600">We reserve the right to modify these terms at any time. Continued use of our services after changes constitutes acceptance of the new terms.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-8">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Contact Information</h2>
      <p class="text-gray-600 mb-6">For questions about these Terms of Service, please contact us:</p>
      <div class="grid md:grid-cols-3 gap-6">
        <div>
          <h3 class="font-medium text-gray-800 mb-2">Email</h3>
          <p class="text-blue-600">terms@hailemariammamo.edu</p>
        </div>
        <div>
          <h3 class="font-medium text-gray-800 mb-2">Phone</h3>
          <p class="text-gray-600">+251 123 456 789</p>
        </div>
        <div>
          <h3 class="font-medium text-gray-800 mb-2">Address</h3>
          <p class="text-gray-600">Hailemariam Mamo School<br>Addis Ababa, Ethiopia</p>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <script>
    // Add animation to term cards when scrolling
    const termCards = document.querySelectorAll('.term-card');
    
    const cardObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-fadeIn');
          const delay = Array.from(termCards).indexOf(entry.target) * 100;
          entry.target.style.animationDelay = `${delay}ms`;
        }
      });
    }, { threshold: 0.1 });

    termCards.forEach(card => {
      cardObserver.observe(card);
    });
  </script>
</body>
</html>