<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Department Head Home Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="min-h-screen flex flex-col justify-center items-center p-6">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-lg text-center">
      <h1 class="text-3xl font-bold text-green-700 mb-6">Department Head Home Page</h1>

      <div class="space-y-4">
        <a href="update_department_account.php" class="block w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-300">
          Update Username & Password
        </a>
        <a href="manage_courses.php" class="block w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-300">
          Manage Courses
        </a>
        <a href="assign_teacher_to_course.php" class="block w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-300">
          Assign Teacher to Courses
        </a>
        <a href="view_assigned_teachers.php" class="block w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-300">
          View Assigned Teachers to Course
        </a>
       

        <a href="update_assigned_teacher.php" class="block w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-300">
          Update Assigned Teachers to Course
        </a>
        <a href="delete_assigned_teacher.php" class="block w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-300">
          Delete Assigned Teachers to Course
        </a>

        <a href="logout.php" class="block w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-300">
          Logout
        </a>
      </div>
    </div>
  </div>

</body>
</html>
