<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Teacher Home Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .teacher-photo {
      background-image: url(https://as2.ftcdn.net/v2/jpg/00/51/56/01/1000_F_51560196_vUKBTclebqPxT4KnYiF62ydEpNto7nBs.jpg);
      background-size: 500px;
      background-position: center;
      position: relative;
    }
    .teacher-photo::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.4);
    }
    .teacher-info {
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
      <h2 class="text-xl font-bold">Teacher Portal</h2>
      <p class="text-sm text-blue-200 mt-1">Hailemariam Mamo School</p>
    </div>
    
    <div class="flex-1 p-4 space-y-2">
      <a href="update_teacher_account.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Update Account
      </a>
      <a href="view_asig.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        View Class Students
      </a>
      <a href="enter_marks_with_calc.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Enter Results
      </a>
      <a href="view_all_student_results.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        View Results
      </a>
      <a href="update_exam_result.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Update Results
      </a>
      <a href="delete_student_result.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
        Delete Results
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
    <!-- Teacher Photo with Info Overlay -->
    <div class="teacher-photo h-64 flex items-end p-6 text-white">
      <div class="teacher-info">
        <h1 class="text-3xl font-bold mb-1">Welcome, Teacher!</h1>
        <p class="text-blue-200">Hailemariyam Mamo School</p>
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
              <p>📝 <a href="enter_marks_with_calc.php" class="text-blue-600 hover:underline">Enter today's class results</a></p>
              <p>👨‍🎓 <a href="view_asig.php" class="text-blue-600 hover:underline">View your class roster</a></p>
              <p>📊 <a href="view_all_student_results.php" class="text-blue-600 hover:underline">Check student progress</a></p>
            </div>
          </div>
          
          <!-- Recent Activities -->
          <div class="bg-white p-6 rounded-xl shadow feature-card transition duration-300">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">Recent Activities</h3>
            <div class="space-y-3">
              <p>✅ Submitted Grade 10 Math results</p>
              <p>📅 Upcoming staff meeting tomorrow</p>
              <p>📚 New curriculum materials available</p>
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
                <p class="font-medium">Midterm Exam Grading Deadline</p>
                <p class="text-sm text-gray-600">All midterm results must be submitted by Friday</p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="bg-blue-100 p-2 rounded-full mr-3 flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div>
                <p class="font-medium">Professional Development Day</p>
                <p class="text-sm text-gray-600">Next Wednesday - No regular classes</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>