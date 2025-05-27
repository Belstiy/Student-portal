<?php
include 'db_connection.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $current_username = $_POST['current_username'];
  $current_password = md5($_POST['current_password']);
  $new_username = $_POST['new_username'];
  $new_password = md5($_POST['new_password']);

  $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND role = 'student'");
  $check_stmt->bind_param("ss", $current_username, $current_password);
  $check_stmt->execute();
  $result = $check_stmt->get_result();

  if ($result->num_rows > 0) {
    $existing_stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND username != ?");
    $existing_stmt->bind_param("ss", $new_username, $current_username);
    $existing_stmt->execute();
    $existing_result = $existing_stmt->get_result();

    if ($existing_result->num_rows > 0) {
      $message = "<p class='text-red-600 font-semibold text-center'>❌ New username already taken. Please choose another.</p>";
    } else {
      $update_stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE username = ? AND role = 'student'");
      $update_stmt->bind_param("sss", $new_username, $new_password, $current_username);

      if ($update_stmt->execute()) {
        $message = "<p class='text-green-600 font-semibold text-center'>✅ Username and password updated successfully.</p>";
      } else {
        $message = "<p class='text-red-600 font-semibold text-center'>❌ Failed to update credentials. Try again.</p>";
      }
      $update_stmt->close();
    }
    $existing_stmt->close();
  } else {
    $message = "<p class='text-red-600 font-semibold text-center'>❌ Invalid current username or password.</p>";
  }

  $check_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Student Credentials</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Important for responsiveness -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Smooth button interaction */
    .responsive-btn {
      transition: transform 0.2s ease, background-color 0.3s ease;
    }

    .responsive-btn:hover {
      transform: scale(1.02);
    }

    .responsive-btn:active {
      transform: scale(0.97);
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-6 sm:px-6 md:px-10">

  <div class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl bg-white shadow-lg rounded-2xl p-6 sm:p-8">
    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-center text-gray-700 mb-6">🔐 Update Username & Password</h2>

    <?php if (!empty($message)) echo "<div class='mb-4'>$message</div>"; ?>

    <form method="POST" class="space-y-4">
      <div>
        <label class="block text-sm md:text-base font-medium text-gray-700">Current Username</label>
        <input type="text" name="current_username" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400">
      </div>

      <div>
        <label class="block text-sm md:text-base font-medium text-gray-700">Current Password</label>
        <input type="password" name="current_password" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400">
      </div>

      <div>
        <label class="block text-sm md:text-base font-medium text-gray-700">New Username</label>
        <input type="text" name="new_username" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400">
      </div>

      <div>
        <label class="block text-sm md:text-base font-medium text-gray-700">New Password</label>
        <input type="password" name="new_password" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400">
      </div>

      <button type="submit" class="responsive-btn w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold">
        Update Credentials
      </button>
    </form>

    <div class="mt-8 text-center">
      <a href="student.php" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition duration-200">
        🔙 <span class="ml-1 underline">Back to Student Home Page</span>
      </a>
    </div>
  </div>

  <script>
    // Optional JS: You can expand this for more dynamic behavior
    function checkDeviceWidth() {
      const width = window.innerWidth;
      console.log("Screen width:", width);
      // Example: Apply additional style or behavior if needed
    }

    window.addEventListener("load", checkDeviceWidth);
    window.addEventListener("resize", checkDeviceWidth);
  </script>
</body>
</html>
