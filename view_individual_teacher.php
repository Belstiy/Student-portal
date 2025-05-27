<?php
session_start();
include 'db_connection.php';

// Check if user is logged in and is a registral
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'registral') {
//     echo "<p class='text-red-600 font-semibold'>You do not have permission to access this page.</p>";
//     exit();
// }

$teacher_details = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher_id = trim($_POST['teacher_id']);

    $stmt = $conn->prepare("SELECT * FROM teachers WHERE teacher_id = ?");
    $stmt->bind_param("s", $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $teacher_details = "
            <div class='bg-white p-6 rounded-lg shadow-md mt-6'>
                <h2 class='text-xl font-bold text-[#009dc4] mb-4'>👩‍🏫 Teacher Details</h2>
                <p><strong>Teacher ID:</strong> " . htmlspecialchars($row['teacher_id']) . "</p>
                <p><strong>First Name:</strong> " . htmlspecialchars($row['first_name']) . "</p>
                <p><strong>Last Name:</strong> " . htmlspecialchars($row['last_name']) . "</p>
                <p><strong>Sex:</strong> " . htmlspecialchars($row['sex']) . "</p>
                <p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>
                <p><strong>Phone:</strong> " . htmlspecialchars($row['phone']) . "</p>
                <p><strong>Department:</strong> " . htmlspecialchars($row['department']) . "</p>
                <p><strong>Qualification:</strong> " . htmlspecialchars($row['qualification']) . "</p>
            </div>";
    } else {
        $message = "<p class='text-red-600 mt-4 font-medium'>❌ No teacher found with ID '$teacher_id'.</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Teacher Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-xl bg-white p-8 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold text-[#009dc4] mb-6 text-center">🔍 View Teacher Information</h2>

        <form method="POST" action="" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Enter Teacher ID:</label>
                <input type="text" name="teacher_id" required class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-[#009dc4] hover:bg-[#0082a5] text-white font-medium px-6 py-2 rounded-md transition duration-200">Search Teacher</button>
            </div>
        </form>

        <?php
        echo $message;
        echo $teacher_details;
        ?>

        <div class="mt-6 text-center">
            <a href="registeral.php" class="text-[#009dc4] hover:underline text-sm">🔙 Back to Registeral Home Page</a>
        </div>
    </div>
</body>
</html>
