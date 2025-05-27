<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in as a department head
//if (!isset($_SESSION['role']) || $_SESSION['role'] != 'department_head') {
  //  echo "<p class='text-red-600 font-semibold'>❌ You do not have permission to access this page.</p>";
  //  exit();
//}

// Fetch the course details if the course code is provided and exists
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

// Handle update form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $course_code = trim($_POST['course_code']);
    $course_name = trim($_POST['course_name']);
    $grade = $_POST['grade'];

    if (!empty($course_name) && !empty($grade)) {
        $update_stmt = $conn->prepare("UPDATE courses SET course_name = ?, grade = ? WHERE course_code = ?");
        $update_stmt->bind_param("sss", $course_name, $grade, $course_code);

        if ($update_stmt->execute()) {
            echo "<p class='text-green-600 font-semibold'>✅ Course with Code: $course_code has been successfully updated.</p>";
        } else {
            echo "<p class='text-red-600 font-semibold'>❌ Failed to update the course. Please try again.</p>";
        }

        $update_stmt->close();
    } else {
        echo "<p class='text-red-600 font-semibold'>❌ Please fill in all the fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-xl">
        <h2 class="text-2xl font-bold text-[#009dc4] mb-6">📘 Update Course by Course Code</h2>

        <?php if (isset($course)): ?>
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Edit Course Details</h3>
            <form method="POST" action="" class="space-y-4">
                <div>
                    <label for="course_code" class="block text-sm font-medium text-gray-600">Course Code:</label>
                    <input type="text" name="course_code" id="course_code" value="<?= htmlspecialchars($course['course_code']) ?>" readonly class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" />
                </div>

                <div>
                    <label for="course_name" class="block text-sm font-medium text-gray-600">Course Name:</label>
                    <input type="text" name="course_name" id="course_name" value="<?= htmlspecialchars($course['course_name']) ?>" required class="w-full border border-gray-300 rounded px-3 py-2" />
                </div>

                <div>
                    <label for="grade" class="block text-sm font-medium text-gray-600">Grade:</label>
                    <select name="grade" id="grade" required class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="Grade 9" <?= ($course['grade'] == 'Grade 9') ? 'selected' : '' ?>>Grade 9</option>
                        <option value="Grade 10" <?= ($course['grade'] == 'Grade 10') ? 'selected' : '' ?>>Grade 10</option>
                        <option value="Grade 11" <?= ($course['grade'] == 'Grade 11') ? 'selected' : '' ?>>Grade 11</option>
                        <option value="Grade 12" <?= ($course['grade'] == 'Grade 12') ? 'selected' : '' ?>>Grade 12</option>
                    </select>
                </div>

                <button type="submit" name="update" class="bg-[#009dc4] text-white px-6 py-2 rounded hover:bg-[#007fa3]">Update Course</button>
            </form>

        <?php else: ?>
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Enter Course Code to Edit</h3>
            <form method="POST" action="" class="space-y-4">
                <div>
                    <label for="course_code" class="block text-sm font-medium text-gray-600">Course Code:</label>
                    <input type="text" name="course_code" id="course_code" required class="w-full border border-gray-300 rounded px-3 py-2" />
                </div>
                <button type="submit" class="bg-[#009dc4] text-white px-6 py-2 rounded hover:bg-[#007fa3]">Find Course</button>
            </form>
        <?php endif; ?>

        <div class="mt-6">
            <a href="manage_courses.php" class="inline-block text-[#009dc4] hover:underline font-medium">🔙 Back to Manage Courses</a>
        </div>
    </div>
</body>
</html>
