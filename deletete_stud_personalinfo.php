<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in and has 'registral' role
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'registral') {
//     echo "<p class='text-red-600 font-semibold'>❌ You do not have permission to perform this action.</p>";
//     exit();
// }

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // Check if the student exists
    $stmt = $conn->prepare("SELECT student_id FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Student exists, proceed with deletion
        $delete_stmt = $conn->prepare("DELETE FROM students WHERE student_id = ?");
        $delete_stmt->bind_param("s", $student_id);

        if ($delete_stmt->execute()) {
            $message = "<p class='text-green-600 font-semibold'>✅ Student with Student ID: $student_id has been successfully deleted.</p>";
        } else {
            $message = "<p class='text-red-600 font-semibold'>❌ There was an error deleting the student record. Please try again.</p>";
        }

        $delete_stmt->close();
    } else {
        $message = "<p class='text-red-600 font-semibold'>❌ Student with Student ID: $student_id does not exist.</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-[#009dc4]">🗑️ Delete Student by Student ID</h2>
            <a href="registeral.php" class="bg-[#009dc4] text-white px-4 py-2 rounded-md hover:bg-[#007a9b] transition">
                🔙 Back to Registeral Home Page
            </a>
        </div>

        <?php if (!empty($message)) echo $message; ?>

        <form method="POST" action="deletete_stud_personalinfo.php" class="space-y-4">
            <div>
                <label for="student_id" class="block text-sm font-medium text-gray-700">Enter Student ID:</label>
                <input type="text" name="student_id" id="student_id" required class="mt-1 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
            </div>

            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition">
                Delete Student
            </button>
        </form>

        <p class="mt-6">
            <a href="view_all_student_personalinfo.php" class="text-[#009dc4] hover:underline">🔍 Go back to All Students List</a>
        </p>
    </div>
</body>
</html>
