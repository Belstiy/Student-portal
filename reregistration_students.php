<?php
include 'db_connection.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reregister_student'])) {
    $student_id = $_POST['student_id'];
    $stream = $_POST['stream'];
    $new_year = $_POST['academic_year'];

    // Get current student record
    $stmt = $conn->prepare("SELECT grade, academic_year FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $student_result = $stmt->get_result();

    if ($student_result->num_rows === 0) {
        $message = "<p class='text-red-600 font-semibold'>❌ Student ID $student_id not found.</p>";
    } else {
        $student = $student_result->fetch_assoc();
        $current_grade = $student['grade'];
        $current_year = $student['academic_year'];

        // Check if a billing rate exists for the new year
        $stmt = $conn->prepare("SELECT * FROM billing_rates WHERE year > ?");
        $stmt->bind_param("s", $current_year);
        $stmt->execute();
        $billing_result = $stmt->get_result();

        if ($billing_result->num_rows === 0) {
            $message = "<p class='text-red-600 font-semibold'>❌ No registration available for the year ($new_year). Please wait patiently.</p>";
        } else {
            // Check if student is promoted
            $stmt = $conn->prepare("SELECT status FROM student_results WHERE student_id = ? ORDER BY year DESC LIMIT 1");
            $stmt->bind_param("s", $student_id);
            $stmt->execute();
            $result_status = $stmt->get_result()->fetch_assoc();
            $new_grade = $current_grade;

            if ($result_status && strtolower($result_status['status']) === 'promoted') {
                $new_grade = $current_grade + 1;
            }

            // Update the student record
            $stmt = $conn->prepare("UPDATE students SET academic_year = ?, grade = ?, stream = ?, status = 'Pending' WHERE student_id = ?");
            $stmt->bind_param("siss", $new_year, $new_grade, $stream, $student_id);

            if ($stmt->execute()) {
                $message = "<p class='text-green-600 font-semibold'>✅ Re-registration successful for Student ID: <strong>$student_id</strong>. Updated to Grade <strong>$new_grade</strong> for the academic year <strong>$new_year</strong>.</p>";
            } else {
                $message = "<p class='text-red-600 font-semibold'>❌ Failed to update student record.</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Re-Registration</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @media (max-width: 640px) {
      h2 { font-size: 1.5rem; }
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center px-4">

  <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md sm:max-w-lg transition-all duration-300">
    <h2 class="text-3xl sm:text-2xl font-bold text-center text-blue-700 mb-6">🔄 Student Re-Registration Form</h2>

    <?php if (!empty($message)) echo "<div class='mb-4 text-sm text-center'>$message</div>"; ?>

    <form method="POST" class="space-y-5">
      <input type="hidden" name="reregister_student" value="1">

      <div>
        <label class="block font-semibold mb-1">Student ID:</label>
        <input type="text" name="student_id" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
      </div>

      <div>
        <label class="block font-semibold mb-1">New Academic Year:</label>
        <input type="text" name="academic_year" required
               value="<?php echo date('Y') . '-' . (date('Y') + 1); ?>"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
      </div>

      <div>
        <label class="block font-semibold mb-1">Stream:</label>
        <select name="stream" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <option value="" disabled selected hidden>-- Select Stream --</option>
          <option value="NS">Non Selected</option>
          <option value="NS">NS</option>
          <option value="SS">SS</option>
        </select>
      </div>

      <div class="text-center">
        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
          Re-Register
        </button>
      </div>
    </form>

    <div class="mt-6 text-center">
      <a href="student.php"
         class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition duration-200">
        🔙 <span class="ml-1 underline">Back to Student Home Page</span>
      </a>
    </div>
  </div>

</body>
</html>

