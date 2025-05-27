<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in as a department head
//if (!isset($_SESSION['role']) || $_SESSION['role'] != 'department_head') {
//    echo "<p class='text-red-600 font-semibold text-center mt-8'>❌ You do not have permission to access this page.</p>";
 //   exit();  
//}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_code = trim($_POST['course_code']);
    $course_name = trim($_POST['course_name']);
    $grade = $_POST['grade'];

    if (!empty($course_code) && !empty($course_name) && !empty($grade)) {
        // Check if the course code already exists in the database
        $check_stmt = $conn->prepare("SELECT * FROM courses WHERE course_code = ?");
        $check_stmt->bind_param("s", $course_code);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            // Course code already exists
            echo "<p class='text-red-600 font-semibold text-center'>❌ Course with code '$course_code' already exists. Please choose a different course code.</p>";
        } else {
            // Course code does not exist, proceed with inserting the new course
            $stmt = $conn->prepare("INSERT INTO courses (course_code, course_name, grade) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $course_code, $course_name, $grade);

            if ($stmt->execute()) {
                echo "<p class='text-green-600 font-semibold text-center'>✅ Course '$course_name' (Code: $course_code) added successfully for $grade.</p>";
            } else {
                echo "<p class='text-red-600 font-semibold text-center'>❌ Failed to add course. Please try again.</p>";
            }

            $stmt->close();
        }

        $check_stmt->close();
    } else {
        echo "<p class='text-red-600 font-semibold text-center'>❌ Please fill in all fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#eef2f5] min-h-screen flex flex-col items-center px-4 py-10">

    <h2 class="text-2xl font-bold text-[#009dc4] mb-6">📘 Add New Course</h2>

    <form method="POST" action="" class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <label for="course_code" class="block font-medium mb-2">Course Code:</label>
        <input type="text" name="course_code" id="course_code" required class="w-full px-4 py-2 border rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">

        <label for="course_name" class="block font-medium mb-2">Course Name:</label>
        <input type="text" name="course_name" id="course_name" required class="w-full px-4 py-2 border rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">

        <label for="grade" class="block font-medium mb-2">Grade:</label>
        <select name="grade" id="grade" required class="w-full px-4 py-2 border rounded-md mb-6 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
            <option value="">-- Select Grade --</option>
            <option value="Grade 9">Grade 9</option>
            <option value="Grade 10">Grade 10</option>
            <option value="Grade 11">Grade 11</option>
            <option value="Grade 12">Grade 12</option>
        </select>

        <button type="submit" class="w-full bg-[#009dc4] hover:bg-[#007fa3] text-white font-semibold py-2 px-4 rounded-md cursor-pointer">
            Add Course
        </button>
    </form>

    <p class="mt-6">
        <a href="manage_courses.php" class="inline-block bg-[#007fa3] hover:bg-[#005f7a] text-white py-2 px-6 rounded-md">
            🔙 Back to Manage Courses
        </a>
    </p>

</body>
</html>
