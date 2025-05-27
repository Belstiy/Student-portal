<?php
session_start();
include 'db_connection.php';

// Check if the user is a department head
//if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'department_head') {
   // echo "<p>❌ You do not have permission to access this page.</p>";
   // exit();
//}

$year = '';
$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = trim($_POST['year']);

    // Fetch assigned teachers with joined course and teacher details, including section
    $stmt = $conn->prepare("
        SELECT 
            tc.teacher_id,
            t.first_name,
            t.last_name,
            tc.course_code,
            c.course_name,
            c.grade,
            tc.section,
            tc.year
        FROM teacher_courses tc
        JOIN teachers t ON tc.teacher_id = t.teacher_id
        JOIN courses c ON tc.course_code = c.course_code
        WHERE tc.year = ?
        ORDER BY c.grade, c.course_name, tc.section
    ");
    $stmt->bind_param("s", $year);
    $stmt->execute();
    $result = $stmt->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Assigned Teachers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="max-w-4xl mx-auto p-6 mt-8 bg-white shadow-lg rounded-lg">

    <h2 class="text-2xl font-semibold text-center text-[#009dc4] mb-6">📋 View Assigned Teachers by Year</h2>

    <form method="POST" action="" class="space-y-4">
        <div>
            <label for="year" class="block font-medium text-gray-700">Enter Academic Year:</label>
            <input type="text" name="year" id="year" value="<?= htmlspecialchars($year) ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
        </div>
        <button type="submit" class="w-full bg-[#009dc4] text-white font-bold py-2 px-4 rounded-lg hover:bg-[#007ba7]">View Assignments</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h3 class="text-xl font-semibold text-center text-[#009dc4] mt-6">📘 Results for Year: <?= htmlspecialchars($year) ?></h3>
        <?php if (count($results) > 0): ?>
            <table class="min-w-full mt-6 border-collapse">
                <thead>
                    <tr class="bg-[#009dc4] text-white">
                        <th class="px-4 py-2 border border-gray-300">Teacher ID</th>
                        <th class="px-4 py-2 border border-gray-300">First Name</th>
                        <th class="px-4 py-2 border border-gray-300">Last Name</th>
                        <th class="px-4 py-2 border border-gray-300">Course Code</th>
                        <th class="px-4 py-2 border border-gray-300">Course Name</th>
                        <th class="px-4 py-2 border border-gray-300">Grade</th>
                        <th class="px-4 py-2 border border-gray-300">Section</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr class="text-center">
                            <td class="px-4 py-2 border border-gray-300"><?= htmlspecialchars($row['teacher_id']) ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?= htmlspecialchars($row['first_name']) ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?= htmlspecialchars($row['last_name']) ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?= htmlspecialchars($row['course_code']) ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?= htmlspecialchars($row['course_name']) ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?= htmlspecialchars($row['grade']) ?></td>
                            <td class="px-4 py-2 border border-gray-300"><?= htmlspecialchars($row['section']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-red-500 text-center mt-6">❌ No assignments found for the year <strong><?= htmlspecialchars($year) ?></strong>.</p>
        <?php endif; ?>
    <?php endif; ?>

    <p class="text-center mt-6">
        <a href="Department_Head.php" class="text-[#009dc4] font-semibold hover:underline">🔙 Back to Department Head</a>
    </p>

</div>

</body>
</html>
