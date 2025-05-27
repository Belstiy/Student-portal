<?php
session_start();
include 'db_connection.php';

// Check if the user has the correct permissions (e.g., 'registral' role)
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'registral') {
//     echo "<p class='text-red-600 font-semibold'>You do not have permission to perform this action.</p>";
//     exit();
// }

// Handle form submission to assign students
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $stream = $_POST['stream'];
    $academic_year = $_POST['academic_year'];

    // Fetch active students for the specified grade, stream, and year
    $stmt = $conn->prepare("SELECT student_id, first_name, last_name FROM students 
                            WHERE grade = ? AND stream = ? AND academic_year = ? AND status = 'Active'");
    $stmt->bind_param("sss", $grade, $stream, $academic_year);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $class_capacity = 50;
        $assigned_students = 0;

        while ($student = $result->fetch_assoc()) {
            $check_stmt = $conn->prepare("SELECT 1 FROM assigned_classes 
                                          WHERE student_id = ? AND grade = ? AND stream = ? AND academic_year = ?");
            $check_stmt->bind_param("ssss", $student['student_id'], $grade, $stream, $academic_year);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                echo "<p class='text-yellow-600 font-medium'>⚠️ Student " . $student['first_name'] . " " . $student['last_name'] . " is already assigned to Grade $grade, Stream $stream, Academic Year $academic_year.</p>";
                continue;
            }

            if ($assigned_students < $class_capacity) {
                $assigned_students++;
                $assigned_class = "Class " . $grade . "-" . $assigned_students;

                $insert_stmt = $conn->prepare("INSERT INTO assigned_classes (student_id, assigned_class, grade, section, stream, academic_year) 
                                               VALUES (?, ?, ?, ?, ?, ?)");
                $insert_stmt->bind_param("ssssss", $student['student_id'], $assigned_class, $grade, $section, $stream, $academic_year);
                $insert_stmt->execute();

                echo "<p class='text-green-600 font-medium'>✅ Student " . $student['first_name'] . " " . $student['last_name'] . " assigned to $assigned_class ($section, $stream).</p>";
            } else {
                echo "<p class='text-red-600 font-semibold'>❌ Class capacity of $class_capacity reached for Grade $grade, Section $section.</p>";
                break;
            }
        }
    } else {
        echo "<p class='text-gray-700 font-medium'>No active students found for Grade: $grade, Stream: $stream, Academic Year: $academic_year.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Students to Classes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-[#009dc4]">📚 Assign Students to Classes</h2>
            <a href="registeral.php" class="bg-[#009dc4] text-white px-4 py-2 rounded-md hover:bg-[#007ca3] transition">
                🔙 Back to Registeral Home Page
            </a>
        </div>

        <form method="POST" action="assigned_class.php" class="space-y-4">
            <div>
                <label for="grade" class="block text-sm font-medium text-gray-700">Grade:</label>
                <input type="text" name="grade" id="grade" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
            </div>

            <div>
                <label for="section" class="block text-sm font-medium text-gray-700">Section:</label>
                <select name="section" id="section" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>

            <div>
                <label for="stream" class="block text-sm font-medium text-gray-700">Stream:</label>
                <select name="stream" id="stream" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
                    <option value="Not Selected">Not Selected</option>
                    <option value="NS">NS</option>
                    <option value="SS">SS</option>
                </select>
            </div>

            <div>
                <label for="academic_year" class="block text-sm font-medium text-gray-700">Academic Year:</label>
                <input type="text" name="academic_year" id="academic_year" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">
            </div>

            <div>
                <button type="submit" class="w-full bg-[#009dc4] text-white py-2 rounded-md hover:bg-[#007ca3] transition">
                    ✅ Assign Students
                </button>
            </div>
        </form>
    </div>

</body>
</html>
