<?php
include 'db_connection.php';

// Check if student_id is provided in the URL
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Prepare SQL query to fetch student data based on student_id
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if student data is found
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        $error = "❌ No student found with ID: $student_id.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['student_id'])) {
    $error = "❌ Student ID is missing.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Student Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-xl p-8">
        <h2 class="text-2xl font-bold text-[#009dc4] mb-6 flex items-center gap-2">
            🔍 Search for Student Information
        </h2>

        <form method="GET" action="" class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">Enter Student ID:</label>
            <div class="flex gap-4 items-center">
                <input type="text" name="student_id" required class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-[#009dc4] focus:border-[#009dc4]">
                <button type="submit" class="bg-[#009dc4] text-white px-6 py-2 rounded-md hover:bg-[#007a9b]">View Student</button>
            </div>
        </form>

        <?php if (isset($error)): ?>
            <p class="text-red-600 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if (isset($student)): ?>
            <h2 class="text-xl font-semibold text-[#009dc4] mb-4">📚 Student Information</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border border-gray-200 shadow-sm rounded-md">
                    <tbody class="text-sm text-gray-700">
                        <?php foreach ($student as $key => $value): ?>
                            <?php if ($key == 'photo_path'): ?>
                                <tr class="border-t">
                                    <th class="bg-gray-100 p-3">Photo</th>
                                    <td class="p-3"><img src="<?php echo $value; ?>" alt="Student Photo" class="w-24 h-24 rounded shadow-md object-cover"></td>
                                </tr>
                            <?php elseif ($key == 'certificate_path'): ?>
                                <tr class="border-t">
                                    <th class="bg-gray-100 p-3">Certificate</th>
                                    <td class="p-3"><a href="<?php echo $value; ?>" target="_blank" class="text-[#009dc4] underline hover:text-[#007a9b]">View Certificate</a></td>
                                </tr>
                            <?php else: ?>
                                <tr class="border-t">
                                    <th class="bg-gray-100 p-3 capitalize"><?php echo str_replace('_', ' ', $key); ?></th>
                                    <td class="p-3"><?php echo $value; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="mt-6">
            <a href="registeral.php" class="inline-block bg-[#009dc4] text-white px-5 py-2 rounded-md hover:bg-[#007a9b] transition">
                🔙 Back to Registeral Home Page
            </a>
        </div>
    </div>

</body>
</html>
