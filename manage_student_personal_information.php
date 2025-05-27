<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students Personal Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .registral-photo {
            background-image: url('https://c8.alamy.com/comp/2J25TNX/gondar-ethiopia-april-222019-ethiopian-students-in-uniform-behind-fasiledes-secondary-school-in-gondar-city-gondar-ethiopia-april-22-2019-2J25TNX.jpg');
            background-size: cover;
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
            <h2 class="text-xl font-bold">Student Management</h2>
            <p class="text-sm text-blue-200 mt-1">Hailemariam Mamo School</p>
        </div>
        
        <div class="flex-1 p-4 space-y-2">
            <a href="registral_register_info.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
                Register Student Info
            </a>
            <a href="update_student_info.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
                Update Student Info
            </a>
            <a href="view_individual_student_personalinfo.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
                View Individual Student
            </a>
            <a href="view_all_student_personalinfo.php" class="sidebar-button block w-full py-3 px-4 bg-blue-700 hover:bg-blue-600 text-white rounded-lg text-left">
                View All Students
            </a>
            <a href="deletete_stud_personalinfo.php" class="sidebar-button block w-full py-3 px-4 bg-red-600 hover:bg-red-500 text-white rounded-lg text-left">
                Delete Student Info
            </a>
        </div>
        
        <div class="p-4 border-t border-blue-700">
            <a href="registeral.php" class="sidebar-button block w-full py-3 px-4 bg-gray-600 hover:bg-gray-500 text-white rounded-lg text-left">
                Back to Registeral Home
            </a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col">
        <!-- Registral Photo with Info Overlay -->
        <div class="registral-photo h-64 flex items-end p-6 text-white">
            <div class="registral-info">
                <h1 class="text-3xl font-bold mb-1">Student Records Management</h1>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="flex-1 p-6 bg-gray-50">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white p-6 rounded-xl shadow mb-6">
                    <h2 class="text-2xl font-bold text-blue-800 mb-4">Student Information Management</h2>
                    <p class="text-gray-700 mb-4">
                        Manage all student records including registration, updates, and personal information.
                        Ensure data accuracy and completeness for academic administration.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Quick Stats -->
                    <div class="bg-white p-6 rounded-xl shadow feature-card transition duration-300">
                        <h3 class="text-lg font-semibold text-blue-800 mb-3">Quick Statistics</h3>
                        <div class="space-y-3">
                            <p><span class="font-medium">Total Students:</span> 1,248</p>
                            <p><span class="font-medium">New This Semester:</span> 142</p>
                            <p><span class="font-medium">Pending Updates:</span> 23</p>
                        </div>
                    </div>
                    
                    <!-- Recent Activities -->
                    <div class="bg-white p-6 rounded-xl shadow feature-card transition duration-300">
                        <h3 class="text-lg font-semibold text-blue-800 mb-3">Recent Activities</h3>
                        <div class="space-y-3">
                            <p>✅ Processed 28 new registrations</p>
                            <p>📝 Updated 15 student records</p>
                            <p>📅 Semester registration ongoing</p>
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
                                <p class="font-medium">Data Verification Deadline</p>
                                <p class="text-sm text-gray-600">All student records must be verified by Friday</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-2 rounded-full mr-3 flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">System Maintenance</p>
                                <p class="text-sm text-gray-600">Saturday 2AM-4AM - System unavailable</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>