<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_student'])) {
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

    // Upload photo
    $photo = $_FILES['photo']['name'];
    $photo_dir = "uploads/photos/";
    if (!file_exists($photo_dir)) mkdir($photo_dir, 0777, true);
    $photo_path = $photo_dir . basename($photo);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path);

    // Upload certificate
    $cert = $_FILES['certificate']['name'];
    $cert_dir = "uploads/certificates/";
    if (!file_exists($cert_dir)) mkdir($cert_dir, 0777, true);
    $cert_path = $cert_dir . basename($cert);
    move_uploaded_file($_FILES["certificate"]["tmp_name"], $cert_path);

    // Insert into database with auto-increment ID and default status 'Pending'
    $stmt = $conn->prepare("INSERT INTO students (
        first_name, middle_name, last_name, sex, dob, region, zone, woreda, kebele, phone,
        photo_path, certificate_path, guardian_name, guardian_phone, grade, academic_year, stream, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");

    $stmt->bind_param("ssssssssssssssssss", 
        $fname, $mname, $lname, $sex, $dob, $region, $zone, $woreda, $kebele, $phone,
        $photo_path, $cert_path, $guardian_name, $guardian_phone, $grade, $academic_year, $stream
    );

    $stmt->execute();

    echo "<p>✅ Registration successful. Your application is <b>Pending</b> approval.</p>";
}
?>

<h2>📚 Student Registration Form</h2>
<form id="student-form" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="register_student" value="1">

  <label>First Name:</label>
  <input type="text" name="first_name" required><br><br>

  <label>Middle Name:</label>
  <input type="text" name="middle_name" required><br><br>

  <label>Last Name:</label>
  <input type="text" name="last_name" required><br><br>

  <label>Sex:</label>
  <select name="sex" required>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select><br><br>

  <label>Date of Birth:</label>
  <input type="date" name="dob" required><br><br>

  <label>Region:</label>
  <input type="text" name="region" required><br><br>

  <label>Zone:</label>
  <input type="text" name="zone" required><br><br>

  <label>Woreda:</label>
  <input type="text" name="woreda" required><br><br>

  <label>Kebele:</label>
  <input type="text" name="kebele" required><br><br>

  <label>Student Phone:</label>
  <input type="text" name="phone" required><br><br>

  <label>Guardian Name:</label>
  <input type="text" name="guardian_name" required><br><br>

  <label>Guardian Phone:</label>
  <input type="text" name="guardian_phone" required><br><br>

  <label>Student Photo:</label>
  <input type="file" name="photo" accept="image/*" required><br><br>

  <label>Grade 8 Ministry Certificate:</label>
  <input type="file" name="certificate" accept=".pdf,.jpg,.jpeg,.png" required><br><br>

  <label>Grade:</label>
  <input type="text" name="grade" required><br><br>

  <label>Academic Year:</label>
  <input type="text" name="academic_year" value="<?php echo date('Y') . '-' . (date('Y') + 1); ?>" required><br><br>

  <label>Stream:</label>
  <select name="stream" required>
    <option value="Not Selected">Not Selected</option>
    <option value="NS">NS</option>
    <option value="SS">SS</option>
  </select><br><br>

  <button type="submit">Register Student</button>
</form>

<script>
  <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_student'])): ?>
    document.getElementById("student-form").reset();
  <?php endif; ?>
</script>
