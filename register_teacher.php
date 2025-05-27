<?php
session_start();
include 'db_connection.php';

// // Check if user is logged in and is a registral
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'registral') {
//     echo "<p class='text-red-600 font-semibold text-center mt-10'>❌ You do not have permission to access this page.</p>";
//     exit();
// }

// Handle form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher_id = trim($_POST['teacher_id']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $sex = $_POST['sex'];
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $department = trim($_POST['department']);
    $qualification = trim($_POST['qualification']);

    $check_stmt = $conn->prepare("SELECT * FROM teachers WHERE teacher_id = ?");
    $check_stmt->bind_param("s", $teacher_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $message = "<p class='text-red-600 font-medium'>❌ A teacher with ID '$teacher_id' already exists.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO teachers (teacher_id, first_name, last_name, sex, email, phone, department, qualification) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $teacher_id, $first_name, $last_name, $sex, $email, $phone, $department, $qualification);

        if ($stmt->execute()) {
            $message = "<p class='text-green-600 font-medium'>✅ Teacher registered successfully!</p>";
        } else {
            $message = "<p class='text-red-600 font-medium'>❌ Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
    $check_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Teacher</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-custom { background-color: #009dc4; }
        .hover\:bg-custom-dark:hover { background-color: #007fa1; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-2xl">
        <h2 class="text-2xl font-bold text-[#009dc4] mb-6 flex items-center gap-2">👩‍🏫 Register a New Teacher</h2>
        <?php echo $message; ?>
        <form method="POST" action="" class="space-y-4">
            <div>
                <label class="block font-medium mb-1">Teacher ID:</label>
                <input type="text" name="teacher_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">First Name:</label>
                    <input type="text" name="first_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
                </div>
                <div>
                    <label class="block font-medium mb-1">Last Name:</label>
                    <input type="text" name="last_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
                </div>
            </div>
            <div>
                <label class="block font-medium mb-1">Sex:</label>
                <select name="sex" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
                    <option value="">-- Select --</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Email:</label>
                    <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
                </div>
                <div>
                    <label class="block font-medium mb-1">Phone:</label>
                    <input type="text" name="phone" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Department:</label>
                    <input type="text" name="department" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
                </div>
                <div>
                    <label class="block font-medium mb-1">Qualification:</label>
                    <input type="text" name="qualification" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="bg-custom hover:bg-custom-dark text-white font-semibold py-2 px-6 rounded-lg transition duration-300">Register Teacher</button>
            </div>
        </form>
        <div class="mt-6 text-center">
            <a href="registeral.php" class="text-[#009dc4] font-semibold hover:underline">🔙 Back to Registeral Home Page</a>
        </div>
    </div>
</body>
</html>
