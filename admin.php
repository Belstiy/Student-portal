<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Home Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .admin-photo {
      background-image: url('https://www.researchgate.net/publication/365841840/figure/fig2/AS:11431281103617135@1669745109846/Professor-Birhanu-Nega-Minister-at-the-Ministry-of-Education.png');
      background-size: 400px;
      background-position: 600px;
      position: relative;
    }
    .admin-photo::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.4);
    }
    .admin-info {
      position: relative;
      z-index: 1;
    }
    .sidebar-button {
      transition: all 0.2s ease;
    }
    .sidebar-button:hover {
      transform: translateX(5px);
      background-color: #1e40af !important;
    }
    .feature-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
  </style>
  <script>
    function navigateTo(page) {
      window.location.href = page;
    }
  </script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

  <header class="bg-blue-700 text-white py-6 shadow-md text-center">
    <h1 class="text-3xl font-bold">Administrative Control Panel</h1>
  </header>

  <div class="flex flex-1">
    <!-- Sidebar with buttons -->
    <div class="w-64 bg-blue-800 text-white p-4 flex flex-col">
      <div class="space-y-4 mb-6">
        <button onclick="navigateTo('manage_user_account.php')" 
                class="sidebar-button w-full bg-blue-700 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg text-left">
          Manage User Account
        </button>

        <button onclick="navigateTo('set_billing_rate.php')" 
                class="sidebar-button w-full bg-blue-700 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg text-left">
          Set Billing Rate
        </button>

        <button onclick="navigateTo('admin_payment_verify.php')" 
                class="sidebar-button w-full bg-blue-700 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg text-left">
          Verify Payments
        </button>
      </div>
      
      <div class="mt-auto">
        <button onclick="navigateTo('logout.php')" 
                class="sidebar-button w-full bg-red-600 hover:bg-red-500 text-white font-semibold py-3 px-4 rounded-lg text-left">
          Logout
        </button>
      </div>
    </div>

    <!-- Main content area -->
    <div class="flex-1 flex flex-col">
      <!-- Admin Photo with Info Overlay -->
      <div class="admin-photo h-64 flex items-end p-6 text-white">
        <div class="admin-info">
          <h2 class="text-3xl font-bold mb-1">Welcome, Administrator</h2>
        </div>
      </div>

      <!-- Dashboard Content -->
      <div class="flex-1 p-8 bg-gray-50">
        <div class="max-w-4xl mx-auto">
          <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-semibold text-blue-800 mb-4">Admin Dashboard Overview</h2>
            <p class="mb-4 text-gray-700">This control panel provides comprehensive management tools for all user accounts, billing rates, and payment verification processes.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
              <div class="bg-blue-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">User Management</h3>
                <p class="text-gray-700">Create, edit, or deactivate user accounts with full access control and permission settings.</p>
              </div>
              <div class="bg-blue-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Billing System</h3>
                <p class="text-gray-700">Set and adjust student billing rates according to different programs and academic levels.</p>
              </div>
              <div class="bg-blue-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Payment Verification</h3>
                <p class="text-gray-700">Verify and track student payments with detailed transaction history and reporting.</p>
              </div>
              <div class="bg-blue-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">System Monitoring</h3>
                <p class="text-gray-700">Monitor all system activities with real-time alerts and comprehensive logs.</p>
              </div>
            </div>
          </div>

          <!-- Quick Stats -->
          <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-semibold text-blue-800 mb-4">System Statistics</h3>
            <div class="grid grid-cols-3 gap-4">
              <div class="bg-blue-100 p-4 rounded-lg text-center">
                <p class="text-2xl font-bold text-blue-800">1,248</p>
                <p class="text-gray-700">Active Users</p>
              </div>
              <div class="bg-blue-100 p-4 rounded-lg text-center">
                <p class="text-2xl font-bold text-blue-800">₦5.2M</p>
                <p class="text-gray-700">Monthly Revenue</p>
              </div>
              <div class="bg-blue-100 p-4 rounded-lg text-center">
                <p class="text-2xl font-bold text-blue-800">87%</p>
                <p class="text-gray-700">Payment Completion</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg-gray-200 text-center py-4 text-sm">
    <p>&copy; 2025 Hailemariam Mamo School. All rights reserved.</p>
  </footer>

</body>
</html>