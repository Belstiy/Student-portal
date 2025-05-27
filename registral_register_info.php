<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_student'])) {
    $stud_id = $_POST['stud_id'];
    $mname = $_POST['middle_name'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $sex = $_POST['sex'];
    $dob = $_POST['dob'];
    $region = $_POST['region'];
    $zone = $_POST['zone'];
    $woreda = $_POST['woreda'];
    $kebele = $_POST['kebele'];
    $phone = $_POST['phone'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_phone = $_POST['guardian_phone'];
    $grade = $_POST['grade'];
    $academic_year = $_POST['academic_year'];
    $stream = $_POST['stream'];

    $stmt = $conn->prepare("SELECT student_id FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $stud_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<div class='text-red-600 font-semibold mb-4'>❌ Student ID $stud_id already exists. Please enter a different Student ID.</div>";
        $stmt->close();
    } else {
        $photo = $_FILES['photo']['name'];
        $photo_dir = "uploads/photos/";
        if (!file_exists($photo_dir)) mkdir($photo_dir, 0777, true);
        $photo_path = $photo_dir . basename($photo);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path);

        $cert = $_FILES['certificate']['name'];
        $cert_dir = "uploads/certificates/";
        if (!file_exists($cert_dir)) mkdir($cert_dir, 0777, true);
        $cert_path = $cert_dir . basename($cert);
        move_uploaded_file($_FILES["certificate"]["tmp_name"], $cert_path);

        $stmt = $conn->prepare("INSERT INTO students (
            student_id, first_name, middle_name, last_name, sex, dob, region, zone, woreda, kebele, phone,
            photo_path, certificate_path, guardian_name, guardian_phone, grade, academic_year, stream, status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
        
        $stmt->bind_param("ssssssssssssssssss", 
            $stud_id, $fname, $mname, $lname, $sex, $dob, $region, $zone, $woreda, $kebele, $phone,
            $photo_path, $cert_path, $guardian_name, $guardian_phone, $grade, $academic_year, $stream
        );

        $stmt->execute();

        echo "<div class='text-green-600 font-semibold mb-4'>✅ Registration successful for Student ID: $stud_id. Status is currently <b>Pending</b> until billing is completed.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Student Registration</title>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg border-l-8" style="border-color: #009dc4;">
    <h2 class="text-2xl font-bold text-[#009dc4] mb-6">📚 Student Registration Form</h2>

    <form id="student-form" method="POST" enctype="multipart/form-data" class="space-y-4">
      <input type="hidden" name="register_student" value="1">

      <div>
        <label class="block font-medium">Student ID:</label>
        <input type="text" name="stud_id" class="w-full p-2 border rounded" required>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block font-medium">First Name:</label>
          <input type="text" name="first_name" class="w-full p-2 border rounded" required>
        </div>
        <div>
          <label class="block font-medium">Middle Name:</label>
          <input type="text" name="middle_name" class="w-full p-2 border rounded" required>
        </div>
        <div>
          <label class="block font-medium">Last Name:</label>
          <input type="text" name="last_name" class="w-full p-2 border rounded" required>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block font-medium">Sex:</label>
          <select name="sex" class="w-full p-2 border rounded" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div>
          <label class="block font-medium">Date of Birth:</label>
          <input type="date" name="dob" class="w-full p-2 border rounded" required>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><label class="block font-medium">Region:</label><input type="text" name="region" class="w-full p-2 border rounded" required></div>
        <div><label class="block font-medium">Zone:</label><input type="text" name="zone" class="w-full p-2 border rounded" required></div>
        <div><label class="block font-medium">Woreda:</label><input type="text" name="woreda" class="w-full p-2 border rounded" required></div>
        <div><label class="block font-medium">Kebele:</label><input type="text" name="kebele" class="w-full p-2 border rounded" required></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><label class="block font-medium">Student Phone:</label><input type="text" name="phone" class="w-full p-2 border rounded" required></div>
        <div><label class="block font-medium">Guardian Name:</label><input type="text" name="guardian_name" class="w-full p-2 border rounded" required></div>
        <div><label class="block font-medium">Guardian Phone:</label><input type="text" name="guardian_phone" class="w-full p-2 border rounded" required></div>
      </div>

      <div>
        <label class="block font-medium">Student Photo:</label>
        <input type="file" name="photo" accept="image/*" class="w-full" required>
      </div>

      <div>
        <label class="block font-medium">Grade 8 Ministry Certificate:</label>
        <input type="file" name="certificate" accept=".pdf,.jpg,.jpeg,.png" class="w-full" required>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block font-medium">Grade:</label>
          <input type="text" name="grade" class="w-full p-2 border rounded" required>
        </div>
        <div>
          <label class="block font-medium">Academic Year:</label>
          <input type="text" name="academic_year" value="<?php echo date('Y') . '-' . (date('Y') + 1); ?>" class="w-full p-2 border rounded" required>
        </div>
        <div>
          <label class="block font-medium">Stream:</label>
          <select name="stream" class="w-full p-2 border rounded" required>
            <option value="Not Selected">Not Selected</option>
            <option value="NS">NS</option>
            <option value="SS">SS</option>
          </select>
        </div>
      </div>

      <div class="flex items-center justify-between mt-6">
        <button type="submit" class="bg-[#009dc4] text-white font-semibold px-6 py-2 rounded hover:bg-[#007ea1] transition">Register Student</button>
        <a href="registeral.php" class="text-[#009dc4] font-semibold underline flex items-center">
          🔙 Back to Registeral Home Page
        </a>
      </div>
    </form>
  </div>

  <script>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_student'])): ?>
      document.getElementById("student-form").reset();
    <?php endif; ?>
  </script>
</body>
</html>
