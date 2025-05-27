<?php include 'db_connection.php'; ?>

<?php
$registeredUser = null;
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_POST['user_id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $sex = $_POST['sex'];
  $username = $_POST['username'];
  $password = md5($_POST['password']); // md5 encrypted
  $role = $_POST['role'];
  $status = $_POST['status'];

  $check_id_stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
  $check_id_stmt->bind_param("s", $user_id);
  $check_id_stmt->execute();
  $id_result = $check_id_stmt->get_result();

  if ($id_result->num_rows > 0) {
    $message = "<p class='text-red-600 font-semibold'>❌ User ID already exists. Please use a different User ID.</p>";
  } else {
    $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
      $message = "<p class='text-red-600 font-semibold'>❌ Username already exists. Try another.</p>";
    } else {
      $stmt = $conn->prepare("INSERT INTO users (user_id, first_name, last_name, sex, username, password, role, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssssss", $user_id, $first_name, $last_name, $sex, $username, $password, $role, $status);

      if ($stmt->execute()) {
        $message = "<p class='text-green-600 font-semibold'>✅ User registered successfully!</p>";
        $registeredUser = [
          "user_id" => $user_id,
          "first_name" => $first_name,
          "last_name" => $last_name,
          "sex" => $sex,
          "username" => $username,
          "role" => $role,
          "status" => $status
        ];
      } else {
        $message = "<p class='text-red-600 font-semibold'>❌ Error registering user.</p>";
      }
      $stmt->close();
    }
    $check_stmt->close();
  }
  $check_id_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center px-4 py-10">

  <div class="w-full max-w-xl bg-white rounded-lg shadow-lg p-8 space-y-6">
    <h2 class="text-3xl font-bold text-center text-green-700">User Registration</h2>

    <?php if (!empty($message)): ?>
      <div class="text-center">
        <?= $message ?>
      </div>
    <?php endif; ?>

    <?php if ($registeredUser): ?>
      <div>
        <h3 class="text-2xl font-semibold text-center text-green-700 mb-4">Registered User Info</h3>
        <div class="space-y-3">
          <?php foreach ($registeredUser as $key => $value): ?>
            <input type="text" class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100" value="<?= htmlspecialchars($value) ?>" readonly>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

    <div>
      <h3 class="text-2xl font-semibold text-center text-gray-800 mb-4">Register Another User</h3>
      <form action="" method="POST" class="space-y-4">
        <input type="text" name="user_id" placeholder="User ID" required class="w-full border border-gray-300 rounded-md px-4 py-2">
        <input type="text" name="first_name" placeholder="First Name" required class="w-full border border-gray-300 rounded-md px-4 py-2">
        <input type="text" name="last_name" placeholder="Last Name" required class="w-full border border-gray-300 rounded-md px-4 py-2">

        <select name="sex" required class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white">
          <option value="">--Select Sex--</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select>

        <input type="text" name="username" placeholder="Username" required class="w-full border border-gray-300 rounded-md px-4 py-2">
        <input type="password" name="password" placeholder="Password" required class="w-full border border-gray-300 rounded-md px-4 py-2">

        <select name="role" required class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white">
          <option value="">--Select Role--</option>
          <option value="admin">Admin</option>
          <option value="student">Student</option>
          <option value="teacher">Teacher</option>
          <option value="registral">Registral</option>
          <option value="department_head">Department Head</option>
        </select>

        <select name="status" required class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white">
          <option value="">--Select Status--</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>

        <input type="submit" value="Register" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">

      </form>
    </div>

    <div class="text-center">
      <a href="manage_user_account.php" class="text-blue-600 hover:underline">← Back to Manage User Account</a>
    </div>
  </div>

</body>
</html>
