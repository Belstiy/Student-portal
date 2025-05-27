<?php
session_start();
include 'db_connection.php';

// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'department_head') {
//     echo "<p class='text-red-600 font-semibold'>❌ You do not have permission to access this page.</p>";
//     exit();
// }

$query = "SELECT * FROM courses";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View All Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-6xl mx-auto bg-white p-8 rounded shadow-lg">
        <h2 class="text-2xl font-bold text-[#009dc4] mb-6">📘 List of All Courses</h2>

        <?php if ($result->num_rows > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-300">
                    <thead class="bg-[#009dc4] text-white">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">Course Code</th>
                            <th class="px-4 py-2 border border-gray-300">Course Name</th>
                            <th class="px-4 py-2 border border-gray-300">Grade</th>
                            <th class="px-4 py-2 border border-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 border border-gray-300"><?= htmlspecialchars($row['course_code']) ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?= htmlspecialchars($row['course_name']) ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?= htmlspecialchars($row['grade']) ?></td>
                                <td class="px-4 py-2 border border-gray-300 text-center">
                                    <a href="update_course.php?course_code=<?= urlencode($row['course_code']) ?>" class="text-blue-600 hover:underline">Update</a> |
                                    <a href="delete_course.php?course_code=<?= urlencode($row['course_code']) ?>" class="text-red-600 hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-gray-700 font-medium">No courses found.</p>
        <?php endif; ?>

        <div class="mt-6 space-y-2">
            <p><a href="add_course.php" class="text-[#009dc4] hover:underline font-medium">📘 Add New Course</a></p>
            <p><a href="manage_courses.php" class="text-[#009dc4] hover:underline font-medium">🔙 Back to Manage Courses</a></p>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
