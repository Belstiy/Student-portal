<?php
session_start();
include 'db_connection.php';

// Check if user is logged in and is a registral
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'registral') {
//     echo "<p class='text-red-600 font-semibold'>You do not have permission to access this page.</p>";
//     exit();
// }

$message = "";
$messageClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher_id = trim($_POST['teacher_id']);

    // Check if teacher exists in the database
    $check_stmt = $conn->prepare("SELECT * FROM teachers WHERE teacher_id = ?");
    $check_stmt->bind_param("s", $teacher_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Delete the teacher from the database
        $delete_stmt = $conn->prepare("DELETE FROM teachers WHERE teacher_id = ?");
        $delete_stmt->bind_param("s", $teacher_id);

        if ($delete_stmt->execute()) {
            $message = "✅ Teacher with ID '$teacher_id' has been deleted successfully!";
            $messageClass = "text-green-600";
        } else {
            $message = "❌ Error: " . $delete_stmt->error;
            $messageClass = "text-red-600";
        }

        $delete_stmt->close();
    } else {
        $message = "❌ No teacher found with ID '$teacher_id'.";
        $messageClass = "text-red-600";
    }

    $check_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Teacher</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white p-8 rounded-2xl shadow-md max-w-md w-full">
        <h2 class="text-2xl font-bold text-center text-[#009dc4] mb-6">🗑️ Delete Teacher</h2>

        <?php if (!empty($message)): ?>
            <p class="mb-4 text-sm font-semibold <?php echo $messageClass; ?>"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST" action="" class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Enter Teacher ID:</label>
                <input type="text" name="teacher_id" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
            </div>
            <button type="submit"
                class="w-full bg-[#009dc4] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#007ba0] transition">
                Delete Teacher
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="registeral.php" class="text-[#009dc4] hover:underline text-sm">🔙 Back to Registeral Home Page</a>
        </div>
    </div>
</body>
</html>
