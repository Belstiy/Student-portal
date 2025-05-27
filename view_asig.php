<?php
include 'db_connection.php';

// Fetch all assigned classes with section, stream, and academic year
$stmt = $conn->prepare("SELECT ac.student_id, s.first_name, s.last_name, ac.assigned_class, ac.grade, ac.section, ac.stream, ac.academic_year, ac.assignment_date, s.sex
                        FROM assigned_classes ac
                        JOIN students s ON ac.student_id = s.student_id
                        ORDER BY ac.assignment_date DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assigned Classes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-[#009dc4]">📚 All Assigned Classes</h2>
            <a href="teacher.php" class="bg-[#009dc4] text-white px-4 py-2 rounded-md hover:bg-[#007ca3] transition">
                🔙 Back to Teacher Home Page
            </a>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-300 rounded-lg">
                    <thead class="bg-[#009dc4] text-white">
                        <tr>
                            <th class="px-4 py-2">Student ID</th>
                            <th class="px-4 py-2">First Name</th>
                            <th class="px-4 py-2">Last Name</th>
                            <th class="px-4 py-2">Assigned Class</th>
                            <th class="px-4 py-2">Grade</th>
                            <th class="px-4 py-2">Section</th>
                            <th class="px-4 py-2">Stream</th>
                            <th class="px-4 py-2">Academic Year</th>
                            <th class="px-4 py-2">Sex</th>
                            <th class="px-4 py-2">Assignment Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php while ($assigned_class = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2"><?php echo $assigned_class['student_id']; ?></td>
                                <td class="px-4 py-2"><?php echo $assigned_class['first_name']; ?></td>
                                <td class="px-4 py-2"><?php echo $assigned_class['last_name']; ?></td>
                                <td class="px-4 py-2"><?php echo $assigned_class['assigned_class']; ?></td>
                                <td class="px-4 py-2"><?php echo $assigned_class['grade']; ?></td>
                                <td class="px-4 py-2"><?php echo $assigned_class['section']; ?></td>
                                <td class="px-4 py-2"><?php echo $assigned_class['stream']; ?></td>
                                <td class="px-4 py-2"><?php echo $assigned_class['academic_year']; ?></td>
                                <td class="px-4 py-2"><?php echo $assigned_class['sex']; ?></td>
                                <td class="px-4 py-2"><?php echo $assigned_class['assignment_date']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-gray-700 font-medium">No classes have been assigned yet.</p>
        <?php endif; ?>
    </div>

</body>
</html>
