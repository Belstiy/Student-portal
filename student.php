<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Home Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .student-photo {
      background-image: url('https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80');
      background-size: cover;
      background-position: center;
      position: relative;
    }
    .student-photo::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.4);
    }
    .student-info {
      position: relative;
      z-index: 1;
    }
    .sidebar-button {
      transition: all 0.2s ease-in-out;
    }
    .sidebar-button:hover {
      transform: translateX(5px);
      background-color: #1e40af !important;
    }
  </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex">

  <!-- Sidebar Navigation -->
  <div class="w-64 bg-blue-800 text-white flex flex-col">
    <div class="p-4 text-center border-b border-blue-700">
      <h2 class="text-xl font-bold">Student Portal</h2>
      <p class="text-sm text-blue-200 mt-1">Hailemariam Mamo School</p>
    </div>
    
    <div class="flex-1 p-4 space-y-2">
      <a href="update_student_account.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Update Username & Password
      </a>
      <a href="reregistration_students.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Reregistration
      </a>
      <a href="view_current_fee.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        View Current Payment
      </a>
      <a href="student_payment.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Pay For Registration
      </a>
      <a href="see_sudent_result.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        See Academic Results
      </a>
    </div>
    
    <div class="p-4 border-t border-blue-700">
      <a href="logout.php" class="sidebar-button block w-full py-3 px-4 bg-red-600 hover:bg-red-500 text-white rounded-lg text-left">
        Logout
      </a>
    </div>
  </div>

  <!-- Main Content Area -->
  <div class="flex-1 flex flex-col">
    <!-- Student Photo with Info Overlay -->
    <div class="student-photo h-64 flex items-end p-6 text-white">
      <div class="student-info">
        <h1 class="text-3xl font-bold mb-1">Welcome Back!</h1>
        <p class="text-blue-200">Hailemariam Mamo School</p>
      </div>
    </div>

    <!-- Dashboard Content -->
    <div class="flex-1 p-6 bg-gray-50">
      <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Quick Stats Cards -->
          <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">Academic Summary</h3>
            <div class="space-y-3">
              <p><span class="font-medium">Current GPA:</span> you will see greade</p>
              <p><span class="font-medium">Rank:</span>your level </p>
              <p><span class="font-medium">Next Payment Due:</span>if you Pass </p>
            </div>
          </div>
          
          <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">Recent Activities</h3>
            <div class="space-y-3">
              <p>✅ Completed registration for Fall 2023</p>
              <p>📝 Midterm exams scheduled next week</p>
              <p>💳 Payment of $450 received on May 10</p>
            </div>
          </div>
        </div>
        
        <!-- Upcoming Deadlines -->
        <div class="mt-8 bg-white p-6 rounded-xl shadow">
          <h3 class="text-lg font-semibold text-blue-800 mb-4">Important Deadlines</h3>
          <div class="space-y-2">
            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
              <div class="bg-blue-100 p-2 rounded-full mr-3">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div>
                <p class="font-medium">Course Registration Deadline</p>
                <p class="text-sm text-gray-600">June 30, 2023</p>
              </div>
            </div>
            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
              <div class="bg-blue-100 p-2 rounded-full mr-3">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div>
                <p class="font-medium">Tuition Payment Deadline</p>
                <p class="text-sm text-gray-600">July 15, 2023</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>