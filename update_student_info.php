<?php
include 'db_connection.php';
$success_message = "";
$show_form_again = true;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_student'])) {
    $stud_id = $_POST['stud_id'];

    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
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

    $photo_path = "";
    $cert_path = "";

    if (!empty($_FILES['photo']['name'])) {
        $photo_dir = "uploads/photos/";
        if (!file_exists($photo_dir)) mkdir($photo_dir, 0777, true);
        $photo_path = $photo_dir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path);
    }

    if (!empty($_FILES['certificate']['name'])) {
        $cert_dir = "uploads/certificates/";
        if (!file_exists($cert_dir)) mkdir($cert_dir, 0777, true);
        $cert_path = $cert_dir . basename($_FILES["certificate"]["name"]);
        move_uploaded_file($_FILES["certificate"]["tmp_name"], $cert_path);
    }

    $sql = "UPDATE students SET 
            first_name=?, middle_name=?, last_name=?, sex=?, dob=?, region=?, zone=?, woreda=?, kebele=?, 
            phone=?, guardian_name=?, guardian_phone=?, grade=?, academic_year=?, stream=?";
    if ($photo_path) $sql .= ", photo_path='$photo_path'";
    if ($cert_path) $sql .= ", certificate_path='$cert_path'";
    $sql .= " WHERE student_id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssss", 
        $fname, $mname, $lname, $sex, $dob, $region, $zone, $woreda, $kebele,
        $phone, $guardian_name, $guardian_phone, $grade, $academic_year, $stream, $stud_id
    );

    if ($stmt->execute()) {
        $success_message = "✅ Student $stud_id updated successfully.";
    } else {
        $success_message = "❌ Failed to update student: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Student</title>
  <script>
    function clearForm(formId) {
      const form = document.getElementById(formId);
      form.reset();
    }

    function duplicateForm() {
      const formContainer = document.getElementById("formContainer");
      const newForm = document.getElementById("studentFormTemplate").cloneNode(true);
      newForm.style.display = "block";
      newForm.id = "studentForm" + Math.floor(Math.random() * 100000);
      formContainer.appendChild(newForm);
    }

    function handleAfterSubmit() {
      clearForm('studentForm1');
      duplicateForm();
    }
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-8">

  <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md border-t-4" style="border-color: #009dc4;">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-bold text-[#009dc4]">🛠️ Update Student Information</h2>
      <a href="registeral.php" class="text-white bg-[#009dc4] px-4 py-2 rounded hover:bg-[#007aa1]">
        🔙 Back to Registeral Home Page
      </a>
    </div>

    <?php if ($success_message): ?>
      <p class="mb-4 text-green-600 font-semibold"><?php echo $success_message; ?></p>
      <script>handleAfterSubmit();</script>
    <?php endif; ?>

    <div id="formContainer">
      <div id="studentFormTemplate" style="display: none;">
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
          <input type="hidden" name="update_student" value="1">

          <?php include 'student_form_fields.php'; ?>

          <button type="submit" class="bg-[#009dc4] text-white px-4 py-2 rounded hover:bg-[#007aa1]">Update Student</button>
        </form>
      </div>

      <div id="studentForm1">
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
          <input type="hidden" name="update_student" value="1">

          <!-- Form Fields -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php
            $fields = [
              "Student ID (to update)" => "stud_id",
              "First Name" => "first_name",
              "Middle Name" => "middle_name",
              "Last Name" => "last_name",
              "Region" => "region",
              "Zone" => "zone",
              "Woreda" => "woreda",
              "Kebele" => "kebele",
              "Phone" => "phone",
              "Guardian Name" => "guardian_name",
              "Guardian Phone" => "guardian_phone",
              "Grade" => "grade",
              "Academic Year" => "academic_year"
            ];
            foreach ($fields as $label => $name) {
              echo <<<HTML
              <div>
                <label class="block font-semibold">$label:</label>
                <input type="text" name="$name" class="w-full border rounded p-2" required>
              </div>
HTML;
            }
            ?>
            <div>
              <label class="block font-semibold">Sex:</label>
              <select name="sex" class="w-full border rounded p-2" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>

            <div>
              <label class="block font-semibold">Date of Birth:</label>
              <input type="date" name="dob" class="w-full border rounded p-2" required>
            </div>

            <div>
              <label class="block font-semibold">Stream:</label>
              <select name="stream" class="w-full border rounded p-2" required>
                <option value="Not Selected">Not Selected</option>
                <option value="NS">NS</option>
                <option value="SS">SS</option>
              </select>
            </div>

            <div>
              <label class="block font-semibold">Upload New Photo (optional):</label>
              <input type="file" name="photo" accept="image/*" class="w-full">
            </div>

            <div>
              <label class="block font-semibold">Upload New Certificate (optional):</label>
              <input type="file" name="certificate" accept=".pdf,.jpg,.jpeg,.png" class="w-full">
            </div>
          </div>

          <button type="submit" class="mt-4 bg-[#009dc4] text-white px-6 py-2 rounded hover:bg-[#007aa1]">Update Student</button>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
