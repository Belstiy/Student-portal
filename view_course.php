<?php
session_start();
include 'db_connection.php';

//if (!isset($_SESSION['role']) || $_SESSION['role'] != 'department_head') {
    //echo "<p class='text-red-600 font-semibold'>❌ You do not have permission to access this page.</p>";
  //  exit();
//}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_code'])) {
    $course_code = trim($_POST['course_code']);
    
    if (!empty($course_code)) {
        $stmt = $conn->prepare("SELECT * FROM courses WHERE course_code = ?");
        $stmt->bind_param("s", $course_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $course = $result->fetch_assoc();
        } else {
            echo "<p class='text-red-600 font-semibold'>❌ Course with Code: $course_code not found.</p>";
            $course = null;
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
    <title>View Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">
        <h2 class="text-2xl font-bold text-[#009dc4] mb-6">📘 View Course by Course Code</h2>

        <h3 class="text-lg font-semibold text-gray-700 mb-4">Enter Course Code to View</h3>
        <form method="POST" action="" class="space-y-4 mb-6">
            <div>
                <label for="course_code" class="block text-sm font-medium text-gray-600">Course Code:</label>
                <input type="text" name="course_code" id="course_code" required class="w-full border border-gray-300 rounded px-3 py-2" />
            </div>
            <button type="submit" class="bg-[#009dc4] text-white px-6 py-2 rounded hover:bg-[#007fa3]">Find Course</button>
        </form>

        <?php if (isset($course)): ?>
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Course Details</h3>
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Course Code:</label>
                    <input type="text" value="<?= htmlspecialchars($course['course_code']) ?>" readonly class="w-full border border-gray-300 bg-gray-100 rounded px-3 py-2" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Course Name:</label>
                    <input type="text" value="<?= htmlspecialchars($course['course_name']) ?>" readonly class="w-full border border-gray-300 bg-gray-100 rounded px-3 py-2" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Grade:</label>
                    <input type="text" value="<?= htmlspecialchars($course['grade']) ?>" readonly class="w-full border border-gray-300 bg-gray-100 rounded px-3 py-2" />
                </div>
            </form>
        <?php endif; ?>

        <div class="mt-6">
            <a href="manage_courses.php" class="text-[#009dc4] hover:underline font-medium">🔙 Back to Manage Courses</a>
        </div>
    </div>
</body>
</html>
