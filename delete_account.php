<?php include 'db_connection.php'; ?>

<?php
$deletedUserID = null;
$message = "";

if (isset($_POST['delete'])) {
  $user_id = $_POST['user_id'];

  $check_stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
  $check_stmt->bind_param("s", $user_id);
  $check_stmt->execute();
  $result = $check_stmt->get_result();

  if ($result->num_rows > 0) {
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    if ($stmt->execute()) {
      $message = "<p class='text-green-600 font-semibold'>User with ID <strong>$user_id</strong> deleted successfully.</p>";
      $deletedUserID = $user_id;
    } else {
      $message = "<p class='text-red-600 font-semibold'>Error deleting user.</p>";
    }
    $stmt->close();
  } else {
    $message = "<p class='text-red-600 font-semibold'>User ID <strong>$user_id</strong> does not exist.</p>";
  }

  $check_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete User</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
  <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
    <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Delete User by ID</h2>
    
    <?php if (!empty($message)) echo "<div class='mb-4 text-center'>$message</div>"; ?>

    <?php if ($deletedUserID): ?>
      <h3 class="text-lg font-semibold text-gray-600 mb-2">Deleted User Info</h3>
      <input type="text" class="w-full px-3 py-2 mb-4 border border-gray-300 rounded-md bg-gray-100" value="<?= htmlspecialchars($deletedUserID) ?>" readonly>
    <?php endif; ?>

    <h3 class="text-lg font-semibold text-gray-600 mb-2">Delete Another User</h3>
    <form method="POST" action="" class="space-y-4">
      <input type="text" name="user_id" placeholder="Enter User ID to Delete" required
             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400">
      <input type="submit" name="delete" value="Delete User"
             class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 cursor-pointer transition duration-150">
    </form>

    <div class="mt-6 text-center">
      <a href="manage_user_account.php" class="text-blue-600 hover:underline font-medium">← Close Page</a>
    </div>
  </div>
</body>
</html>
