<?php
include 'db_connection.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $current_username = $_POST['current_username'];
  $current_password = md5($_POST['current_password']);
  $new_username = $_POST['new_username'];
  $new_password = md5($_POST['new_password']);

  $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND role = 'teacher'");
  $check_stmt->bind_param("ss", $current_username, $current_password);
  $check_stmt->execute();
  $result = $check_stmt->get_result();

  if ($result->num_rows > 0) {
    $existing_stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND username != ?");
    $existing_stmt->bind_param("ss", $new_username, $current_username);
    $existing_stmt->execute();
    $existing_result = $existing_stmt->get_result();

    if ($existing_result->num_rows > 0) {
      $message = "<p class='text-red-600'>❌ New username already taken. Please choose another.</p>";
    } else {
      $update_stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE username = ? AND role = 'teacher'");
      $update_stmt->bind_param("sss", $new_username, $new_password, $current_username);

      if ($update_stmt->execute()) {
        $message = "<p class='text-green-600'>✅ Username and password updated successfully.</p>";
      } else {
        $message = "<p class='text-red-600'>❌ Failed to update credentials. Try again.</p>";
      }
      $update_stmt->close();
    }
    $existing_stmt->close();
  } else {
    $message = "<p class='text-red-600'>❌ Invalid current username or password.</p>";
  }

  $check_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Teacher Credentials</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-start py-10">

  <div class="w-full max-w-md">
    <a href="teacher.php" class="mb-4 inline-block text-[#009dc4] hover:underline text-sm">
      🔙 Back to Teacher Home Page
    </a>

    <h2 class="text-2xl font-bold text-center text-[#009dc4] mb-6">Update Teacher Username & Password</h2>

    <?php if (!empty($message)) echo "<div class='text-center mb-4'>$message</div>"; ?>

    <form method="POST" class="bg-white shadow-md rounded-lg px-8 py-6">
      <label class="block text-gray-700 font-semibold mb-2">Current Username:</label>
      <input type="text" name="current_username" required class="w-full px-3 py-2 border border-gray-300 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">

      <label class="block text-gray-700 font-semibold mb-2">Current Password:</label>
      <input type="password" name="current_password" required class="w-full px-3 py-2 border border-gray-300 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">

      <label class="block text-gray-700 font-semibold mb-2">New Username:</label>
      <input type="text" name="new_username" required class="w-full px-3 py-2 border border-gray-300 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">

      <label class="block text-gray-700 font-semibold mb-2">New Password:</label>
      <input type="password" name="new_password" required class="w-full px-3 py-2 border border-gray-300 rounded-md mb-6 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">

      <input type="submit" value="Update Credentials" class="w-full bg-[#009dc4] text-white py-2 rounded-md hover:bg-[#007ca0] transition">
    </form>
  </div>

</body>
</html>
