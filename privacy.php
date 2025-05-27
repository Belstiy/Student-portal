<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Privacy Policy - Hailemariam Mamo School</title>
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
    .policy-section {
      transition: all 0.3s ease;
    }
    .policy-section:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="bg-gray-50">
  <!-- Navigation -->
  <?php include 'navbar.php'; ?>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
      <h1 class="text-4xl font-bold gradient-text mb-4">Privacy Policy</h1>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">Last updated: <?php echo date('F j, Y'); ?></p>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      <!-- Policy Sections -->
      <div class="policy-section p-8 border-b border-gray-100">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">1. Information We Collect</h2>
        <p class="text-gray-600 mb-4">We collect information to provide better services to all our users. The types of information we collect include:</p>
        <ul class="list-disc pl-6 space-y-2 text-gray-600">
          <li>Personal information (name, email, phone number)</li>
          <li>Academic records and performance data</li>
          <li>Device and usage information</li>
          <li>Contact preferences</li>
        </ul>
      </div>

      <div class="policy-section p-8 border-b border-gray-100">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">2. How We Use Information</h2>
        <p class="text-gray-600 mb-4">We use the information we collect to:</p>
        <ul class="list-disc pl-6 space-y-2 text-gray-600">
          <li>Provide and maintain our educational services</li>
          <li>Improve and personalize learning experiences</li>
          <li>Communicate with students, parents, and staff</li>
          <li>Ensure school security and safety</li>
          <li>Comply with legal obligations</li>
        </ul>
      </div>

      <div class="policy-section p-8 border-b border-gray-100">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">3. Information Sharing</h2>
        <p class="text-gray-600">We do not share personal information with companies, organizations, or individuals outside of Hailemariam Mamo School except in the following cases:</p>
        <div class="mt-4 space-y-4">
          <div class="bg-blue-50 p-4 rounded-lg">
            <h3 class="font-medium text-blue-800">With your consent</h3>
            <p class="text-blue-700 mt-1">We will share information with third parties when we have your explicit consent.</p>
          </div>
          <div class="bg-green-50 p-4 rounded-lg">
            <h3 class="font-medium text-green-800">For legal reasons</h3>
            <p class="text-green-700 mt-1">We will share information if we believe it's necessary to comply with laws or legal processes.</p>
          </div>
        </div>
      </div>

      <div class="policy-section p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">4. Your Rights</h2>
        <p class="text-gray-600 mb-4">You have rights regarding your personal information:</p>
        <div class="grid md:grid-cols-2 gap-4">
          <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="font-medium text-gray-800">Access and Correction</h3>
            <p class="text-gray-600 mt-1">You can request access to or correction of your personal data.</p>
          </div>
          <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="font-medium text-gray-800">Data Portability</h3>
            <p class="text-gray-600 mt-1">You can request a copy of your data in a machine-readable format.</p>
          </div>
          <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="font-medium text-gray-800">Deletion</h3>
            <p class="text-gray-600 mt-1">You can request deletion of your personal data under certain conditions.</p>
          </div>
          <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="font-medium text-gray-800">Complaints</h3>
            <p class="text-gray-600 mt-1">You can lodge a complaint with the appropriate data protection authority.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-12 bg-white rounded-xl shadow-lg p-8">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">Contact Us</h2>
      <p class="text-gray-600 mb-6">If you have questions about this Privacy Policy, please contact us:</p>
      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <h3 class="font-medium text-gray-800 mb-2">Email</h3>
          <p class="text-blue-600">privacy@hailemariammamo.edu</p>
        </div>
        <div>
          <h3 class="font-medium text-gray-800 mb-2">Mailing Address</h3>
          <p class="text-gray-600">Hailemariam Mamo School<br>Privacy Office<br>Addis Ababa, Ethiopia</p>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <script>
    // Animate sections when they come into view
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-fadeIn');
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.policy-section').forEach(section => {
      observer.observe(section);
    });
  </script>
</body>
</html>