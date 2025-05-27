<?php
include 'db_connection.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $current_username = $_POST['current_username'];
  $current_password = md5($_POST['current_password']);
  $new_username = $_POST['new_username'];
  $new_password = md5($_POST['new_password']);

  $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND role = 'registral'");
  $check_stmt->bind_param("ss", $current_username, $current_password);
  $check_stmt->execute();
  $result = $check_stmt->get_result();

  if ($result->num_rows > 0) {
    $existing_stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND username != ?");
    $existing_stmt->bind_param("ss", $new_username, $current_username);
    $existing_stmt->execute();
    $existing_result = $existing_stmt->get_result();

    if ($existing_result->num_rows > 0) {
      $message = "<p class='text-red-600'>❌ New username is already in use. Choose another one.</p>";
    } else {
      $update_stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE username = ? AND role = 'registral'");
      $update_stmt->bind_param("sss", $new_username, $new_password, $current_username);

      if ($update_stmt->execute()) {
        $message = "<p class='text-green-600'>✅ Username and password updated successfully.</p>";
      } else {
        $message = "<p class='text-red-600'>❌ Error updating credentials. Please try again.</p>";
      }
      $update_stmt->close();
    }
    $existing_stmt->close();
  } else {
    $message = "<p class='text-red-600'>❌ Invalid current credentials or not a registral account.</p>";
  }

  $check_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Registral Credentials</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Update Registral Credentials</h2>

    <?php if (!empty($message)) echo "<div class='text-center mb-4'>$message</div>"; ?>

    <form method="POST" class="space-y-4">
      <div>
        <label class="block mb-1 font-medium text-gray-700">Current Username:</label>
        <input type="text" name="current_username" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label class="block mb-1 font-medium text-gray-700">Current Password:</label>
        <input type="password" name="current_password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label class="block mb-1 font-medium text-gray-700">New Username:</label>
        <input type="text" name="new_username" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label class="block mb-1 font-medium text-gray-700">New Password:</label>
        <input type="password" name="new_password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <input type="submit" value="Update Credentials"
               class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
      </div>
    </form>
    <div class="mt-10 text-center">
  <a href="registeral.php" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition duration-200">
    🔙 <span class="ml-1 underline">Back to Registral Home Page</span>
  </a>
</div>
  </div>

</body>
</html>
