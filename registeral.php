<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registral Home Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .registral-photo {
      background-image: url(https://smuc.edu.et/wp-content/uploads/2024/09/wond-1024x720.jpg);
      background-size: 600px;
      background-position: center;
      position: relative;
    }
    .registral-photo::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.4);
    }
    .registral-info {
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
</head>
<body class="bg-gray-100 font-sans min-h-screen flex">

  <!-- Sidebar Navigation -->
  <div class="w-64 bg-blue-800 text-white flex flex-col">
    <div class="p-4 text-center border-b border-blue-700">
      <h2 class="text-xl font-bold">Registral Portal</h2>
      <p class="text-sm text-blue-200 mt-1">Hailemariam Mamo School</p>
    </div>
    
    <div class="flex-1 p-4 space-y-2">
      <a href="update_registeral_account.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Update Account
      </a>
      <a href="manage_student_personal_information.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Manage Students
      </a>
      <a href="manage_teacher.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Manage Teachers
      </a>
      <a href="monitor_registration.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Filter Status
      </a>
      <a href="assigned_class.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Assign Classes
      </a>
      <a href="view_assined_class.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        View Classes
      </a>
      <a href="aproved_result.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Approve Results
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
    <!-- Registral Photo with Info Overlay -->
    <div class="registral-photo h-64 flex items-end p-6 text-white">
      <div class="registral-info">
        <h1 class="text-3xl font-bold mb-1">Welcome, Registrar!</h1>
        <p class="text-blue-200">Head of Registration</p>
      </div>
    </div>

    <!-- Dashboard Content -->
    <div class="flex-1 p-6 bg-gray-50">
      <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Quick Actions -->
          <div class="bg-white p-6 rounded-xl shadow feature-card transition duration-300">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">Quick Actions</h3>
            <div class="space-y-3">
              <p>📝 <a href="manage_student_personal_information.php" class="text-blue-600 hover:underline">Update student records</a></p>
              <p>👨‍🏫 <a href="manage_teacher.php" class="text-blue-600 hover:underline">Review teacher assignments</a></p>
              <p>📊 <a href="aproved_result.php" class="text-blue-600 hover:underline">Process pending results</a></p>
            </div>
          </div>
          
          <!-- Recent Activities -->
          <div class="bg-white p-6 rounded-xl shadow feature-card transition duration-300">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">Recent Activities</h3>
            <div class="space-y-3">
              <p>✅ Processed 42 new registrations</p>
              <p>📅 Upcoming registration deadline</p>
              <p>📚 Assigned classes for new semester</p>
            </div>
          </div>
        </div>
        
        <!-- Important Notices -->
        <div class="mt-8 bg-white p-6 rounded-xl shadow feature-card transition duration-300">
          <h3 class="text-lg font-semibold text-blue-800 mb-4">Important Notices</h3>
          <div class="space-y-4">
            <div class="flex items-start">
              <div class="bg-yellow-100 p-2 rounded-full mr-3 flex-shrink-0">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
              </div>
              <div>
                <p class="font-medium">Registration Deadline</p>
                <p class="text-sm text-gray-600">All semester registrations due by Friday</p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="bg-blue-100 p-2 rounded-full mr-3 flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div>
                <p class="font-medium">Staff Meeting</p>
                <p class="text-sm text-gray-600">Monday 10AM - Registration updates</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>