<?php
include 'db_connection.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $current_username = $_POST['current_username'];
  $current_password = md5($_POST['current_password']); // md5-encrypted
  $new_username = $_POST['new_username'];
  $new_password = md5($_POST['new_password']);

  // Check if current credentials belong to a department head
  $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND role = 'department_head'");
  $check_stmt->bind_param("ss", $current_username, $current_password);
  $check_stmt->execute();
  $result = $check_stmt->get_result();

  if ($result->num_rows > 0) {
    // Check if new username is already taken by someone else
    $existing_stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND username != ?");
    $existing_stmt->bind_param("ss", $new_username, $current_username);
    $existing_stmt->execute();
    $existing_result = $existing_stmt->get_result();

    if ($existing_result->num_rows > 0) {
      $message = "<p class='text-red-600 font-semibold'>❌ New username is already taken. Please choose a different one.</p>";
    } else {
      // Update the credentials
      $update_stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE username = ? AND role = 'department_head'");
      $update_stmt->bind_param("sss", $new_username, $new_password, $current_username);

      if ($update_stmt->execute()) {
        $message = "<p class='text-green-600 font-semibold'>✅ Username and password updated successfully.</p>";
      } else {
        $message = "<p class='text-red-600 font-semibold'>❌ Failed to update credentials. Please try again.</p>";
      }
      $update_stmt->close();
    }
    $existing_stmt->close();
  } else {
    $message = "<p class='text-red-600 font-semibold'>❌ Invalid current credentials or not a department head account.</p>";
  }

  $check_stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Department Head Credentials</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#eef2f5] min-h-screen flex flex-col justify-center items-center px-4">

  <h2 class="text-2xl font-bold text-[#009dc4] mb-6 text-center">Update Department Head Credentials</h2>

  <?php if (!empty($message)) echo "<div class='mb-4 text-center'>$message</div>"; ?>

  <form method="POST" class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <label class="block mb-2 font-medium">Current Username:</label>
    <input type="text" name="current_username" required class="w-full px-4 py-2 border rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">

    <label class="block mb-2 font-medium">Current Password:</label>
    <input type="password" name="current_password" required class="w-full px-4 py-2 border rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">

    <label class="block mb-2 font-medium">New Username:</label>
    <input type="text" name="new_username" required class="w-full px-4 py-2 border rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">

    <label class="block mb-2 font-medium">New Password:</label>
    <input type="password" name="new_password" required class="w-full px-4 py-2 border rounded-md mb-6 focus:outline-none focus:ring-2 focus:ring-[#009dc4]">

    <input type="submit" value="Update Credentials" class="w-full bg-[#009dc4] hover:bg-[#007fa3] text-white font-semibold py-2 px-4 rounded-md cursor-pointer">
  </form>

  <a href="Department_Head.php" class="mt-6 inline-block bg-[#007fa3] hover:bg-[#005f7a] text-white font-semibold py-2 px-6 rounded-md">
    🔙 Back to Department Head Home Page
  </a>

</body>
</html>
