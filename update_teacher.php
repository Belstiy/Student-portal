<?php
session_start();
include 'db_connection.php';

// // Check if user is logged in and is a registral
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'registral') {
//     echo "<p class='text-red-600 font-semibold'>You do not have permission to access this page.</p>";
//     exit();
// }

$teacher_id = $first_name = $last_name = $sex = $email = $phone = $department = $qualification = "";
$is_data_found = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['search'])) {
        $teacher_id = trim($_POST['teacher_id']);
        $stmt = $conn->prepare("SELECT * FROM teachers WHERE teacher_id = ?");
        $stmt->bind_param("s", $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $teacher_id = $row['teacher_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $sex = $row['sex'];
            $email = $row['email'];
            $phone = $row['phone'];
            $department = $row['department'];
            $qualification = $row['qualification'];
            $is_data_found = true;
        } else {
            echo "<p class='text-red-600 font-medium'>❌ No teacher found with ID '$teacher_id'.</p>";
        }
        $stmt->close();
    }

    if (isset($_POST['update'])) {
        $teacher_id = trim($_POST['teacher_id']);
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $sex = $_POST['sex'];
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $department = trim($_POST['department']);
        $qualification = trim($_POST['qualification']);

        $stmt = $conn->prepare("UPDATE teachers SET first_name = ?, last_name = ?, sex = ?, email = ?, phone = ?, department = ?, qualification = ? WHERE teacher_id = ?");
        $stmt->bind_param("ssssssss", $first_name, $last_name, $sex, $email, $phone, $department, $qualification, $teacher_id);

        if ($stmt->execute()) {
            echo "<p class='text-green-600 font-medium'>✅ Teacher information updated successfully!</p>";
        } else {
            echo "<p class='text-red-600 font-medium'>❌ Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Teacher</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-2xl bg-white p-8 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">🔍 Search & Update Teacher</h2>

        <form method="POST" action="" class="space-y-4">
            <!-- Search Section -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Teacher ID (to Search):</label>
                <input type="text" name="teacher_id" value="<?php echo htmlspecialchars($teacher_id); ?>" required class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="flex justify-center">
                <button type="submit" name="search" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-md transition duration-200">Search Teacher</button>
            </div>

            <!-- Update Section -->
            <?php if ($is_data_found): ?>
                <hr class="my-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name:</label>
                        <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required class="mt-1 w-full px-4 py-2 border rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name:</label>
                        <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required class="mt-1 w-full px-4 py-2 border rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sex:</label>
                        <select name="sex" required class="mt-1 w-full px-4 py-2 border rounded-md">
                            <option value="">-- Select --</option>
                            <option value="Male" <?php if ($sex == "Male") echo "selected"; ?>>Male</option>
                            <option value="Female" <?php if ($sex == "Female") echo "selected"; ?>>Female</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required class="mt-1 w-full px-4 py-2 border rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone:</label>
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required class="mt-1 w-full px-4 py-2 border rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Department:</label>
                        <input type="text" name="department" value="<?php echo htmlspecialchars($department); ?>" required class="mt-1 w-full px-4 py-2 border rounded-md">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Qualification:</label>
                        <input type="text" name="qualification" value="<?php echo htmlspecialchars($qualification); ?>" required class="mt-1 w-full px-4 py-2 border rounded-md">
                    </div>
                </div>

                <div class="mt-6 flex justify-center">
                    <button type="submit" name="update" class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-md transition duration-200">Update Teacher</button>
                </div>
            <?php endif; ?>
        </form>

        <div class="mt-6 text-center">
            <a href="registeral.php" class="text-blue-600 hover:underline text-sm">🔙 Back to Registeral Home Page</a>
        </div>
    </div>
</body>
</html>
