<?php
session_start();
include 'db_connection.php';

// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'department_head') {
//     echo "<p class='text-red-600 font-semibold'>❌ You do not have permission to access this page.</p>";
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_code'])) {
    $course_code = trim($_POST['course_code']);

    if (!empty($course_code)) {
        $stmt = $conn->prepare("SELECT * FROM courses WHERE course_code = ?");
        $stmt->bind_param("s", $course_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $delete_stmt = $conn->prepare("DELETE FROM courses WHERE course_code = ?");
            $delete_stmt->bind_param("s", $course_code);

            if ($delete_stmt->execute()) {
                echo "<p class='text-green-600 font-semibold'>✅ Course with Code: $course_code has been successfully deleted.</p>";
            } else {
                echo "<p class='text-red-600 font-semibold'>❌ Failed to delete the course. Please try again.</p>";
            }

            $delete_stmt->close();
        } else {
            echo "<p class='text-red-600 font-semibold'>❌ Course with Code: $course_code not found.</p>";
        }

        $stmt->close();
    } else {
        echo "<p class='text-red-600 font-semibold'>❌ Please enter a course code.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-6xl mx-auto bg-white p-8 rounded shadow-lg">
        <h2 class="text-2xl font-bold text-[#009dc4] mb-6">📘 Delete Course by Course Code</h2>

        <form method="POST" action="" class="space-y-4">
            <div>
                <label for="course_code" class="block text-sm font-medium text-gray-700">Course Code:</label>
                <input type="text" name="course_code" id="course_code" required class="mt-1 p-3 w-full border border-gray-300 rounded focus:ring-[#009dc4] focus:border-[#009dc4]" />
            </div>

            <button type="submit" class="w-full py-2 bg-[#009dc4] text-white rounded hover:bg-[#007ba7]">Delete Course</button>
        </form>

        <div class="mt-6">
            <p><a href="manage_courses.php" class="text-[#009dc4] hover:underline font-medium">🔙 Back to Manage Courses</a></p>
        </div>
    </div>
</body>
</html>
