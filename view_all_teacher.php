<?php
session_start();
include 'db_connection.php';

// Check if user is logged in and is a registral
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'registral') {
//     echo "<p class='text-red-600 font-semibold'>You do not have permission to access this page.</p>";
//     exit();
// }

// Fetch all teacher records from the database
$sql = "SELECT * FROM teachers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Teachers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen px-4 py-10">
    <div class="max-w-7xl mx-auto bg-white p-8 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold text-[#009dc4] mb-6 text-center">👩‍🏫 All Teachers</h2>

        <?php if ($result->num_rows > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 rounded-md text-sm">
                    <thead class="bg-[#009dc4] text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">Teacher ID</th>
                            <th class="px-4 py-2 text-left">First Name</th>
                            <th class="px-4 py-2 text-left">Last Name</th>
                            <th class="px-4 py-2 text-left">Sex</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Phone</th>
                            <th class="px-4 py-2 text-left">Department</th>
                            <th class="px-4 py-2 text-left">Qualification</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2"><?php echo htmlspecialchars($row['teacher_id']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($row['first_name']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($row['last_name']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($row['sex']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($row['department']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($row['qualification']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-red-600 font-medium">❌ No teachers found in the database.</p>
        <?php endif; ?>

        <div class="mt-6 text-center">
            <a href="registeral.php" class="text-[#009dc4] hover:underline text-sm">🔙 Back to Registeral Home Page</a>
        </div>
    </div>
</body>
</html>
