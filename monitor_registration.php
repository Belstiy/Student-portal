<?php
include 'db_connection.php';

// Set filter status
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'All';

// Map 'Approved' to 'Active'
if ($status_filter === 'Approved') {
    $status_filter = 'Active';
}

// Prepare query
if ($status_filter === 'All') {
    $sql = "SELECT * FROM students ORDER BY academic_year DESC";
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT * FROM students WHERE status = ? ORDER BY academic_year DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $status_filter);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monitor Student Registrations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-[#009dc4]">📋 Monitor Student Registrations</h2>
            <a href="registeral.php" class="bg-[#009dc4] text-white px-4 py-2 rounded-md hover:bg-[#007a9b] transition">
                🔙 Back to Registeral Home Page
            </a>
        </div>

        <form method="GET" class="mb-4">
            <label for="status" class="block mb-1 text-sm font-medium text-gray-700">Filter by Status:</label>
            <select name="status" id="status" onchange="this.form.submit()" class="w-full md:w-64 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
                <option value="All" <?php echo ($_GET['status'] ?? '') == 'All' ? 'selected' : ''; ?>>All</option>
                <option value="Pending" <?php echo ($_GET['status'] ?? '') == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="Active" <?php echo ($_GET['status'] ?? '') == 'Active' ? 'selected' : ''; ?>>Active</option>
                <option value="Rejected" <?php echo ($_GET['status'] ?? '') == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
            </select>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-md">
                <thead>
                    <tr class="bg-[#009dc4] text-white">
                        <th class="px-4 py-2 text-left">Student ID</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Grade</th>
                        <th class="px-4 py-2 text-left">Academic Year</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2"><?php echo htmlspecialchars($row['student_id']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($row['grade']); ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($row['academic_year']); ?></td>
                            <td class="px-4 py-2"><?php echo $row['status'] === 'Approved' ? 'Active' : htmlspecialchars($row['status']); ?></td>
                            <td class="px-4 py-2">
                                <a href="view_individual_student_personalinfo.php?id=<?php echo $row['student_id']; ?>" class="text-[#009dc4] hover:underline">View</a> |
                                <a href="deletete_stud_personalinfo.php?id=<?php echo $row['student_id']; ?>" onclick="return confirm('Are you sure you want to delete this student?')" class="text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

<?php $stmt->close(); ?>
