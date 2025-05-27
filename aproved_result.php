<?php
include 'db_connection.php';

$results = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];

    $stmt = $conn->prepare("SELECT r.id, r.student_id, r.grade, r.section, r.year, r.semester, r.total, r.average, r.status, r.rank, r.approved, s.first_name, s.last_name 
                            FROM student_results r 
                            JOIN students s ON r.student_id = s.student_id 
                            WHERE r.grade = ? AND r.section = ? AND r.year = ? AND r.semester = ?");
    $stmt->bind_param("ssss", $grade, $section, $year, $semester);
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve'])) {
    $result_id = $_POST['result_id'];
    $approve_stmt = $conn->prepare("UPDATE student_results SET approved = 1 WHERE id = ?");
    $approve_stmt->bind_param("i", $result_id);
    $approve_stmt->execute();
    echo "<script>alert('Student result approved successfully.');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Approve Student Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[#009dc4]">📄 Search and Approve Student Results</h2>
        <a href="registeral.php" class="bg-[#009dc4] text-white px-4 py-2 rounded-md hover:bg-[#007ca3] transition">
            🔙 Back to Registeral Home Page
        </a>
    </div>

    <form method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Grade</label>
            <input type="text" name="grade" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Section</label>
            <input type="text" name="section" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Year</label>
            <input type="text" name="year" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Semester</label>
            <select name="semester" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                <option value="">Select Semester</option>
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="3">Semester 3</option>
            </select>
        </div>
        <div class="md:col-span-4">
            <button type="submit" name="search" class="mt-2 bg-[#009dc4] text-white px-4 py-2 rounded-md hover:bg-[#007ca3] transition">
                🔍 Search
            </button>
        </div>
    </form>

    <?php if (!empty($results)) { ?>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-300 rounded-lg">
                <thead class="bg-[#009dc4] text-white">
                    <tr>
                        <th class="px-4 py-2">Student ID</th>
                        <th class="px-4 py-2">Full Name</th>
                        <th class="px-4 py-2">Grade</th>
                        <th class="px-4 py-2">Section</th>
                        <th class="px-4 py-2">Year</th>
                        <th class="px-4 py-2">Semester</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Average</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Rank</th>
                        <th class="px-4 py-2">Approval</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($results as $row) { ?>
                        <tr class="<?= $row['approved'] ? 'bg-green-100' : 'bg-orange-100' ?>">
                            <td class="px-4 py-2"><?= $row['student_id'] ?></td>
                            <td class="px-4 py-2"><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                            <td class="px-4 py-2"><?= $row['grade'] ?></td>
                            <td class="px-4 py-2"><?= $row['section'] ?></td>
                            <td class="px-4 py-2"><?= $row['year'] ?></td>
                            <td class="px-4 py-2"><?= $row['semester'] ?></td>
                            <td class="px-4 py-2"><?= $row['total'] ?></td>
                            <td class="px-4 py-2"><?= $row['average'] ?></td>
                            <td class="px-4 py-2"><?= $row['status'] ?></td>
                            <td class="px-4 py-2"><?= $row['rank'] ?></td>
                            <td class="px-4 py-2">
                                <?php if (!$row['approved']) { ?>
                                    <form method="POST" class="m-0">
                                        <input type="hidden" name="result_id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="approve" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 transition">
                                            Approve
                                        </button>
                                    </form>
                                <?php } else { echo "<span class='text-green-600 font-semibold'>Approved</span>"; } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
        echo "<p class='text-red-600 mt-4'>No results found for the selected criteria.</p>";
    } ?>
</div>

</body>
</html>
