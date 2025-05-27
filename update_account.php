<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Update User</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-6">
  <h2 class="text-2xl font-bold mb-4 text-center">Update User Account</h2>

  <?php
  $message = "";
  $updatedUser = null;

  if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];

    $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, sex=?, username=?, role=?, status=? WHERE user_id=?");
    $stmt->bind_param("sssssss",
      $_POST['first_name'],
      $_POST['last_name'],
      $_POST['sex'],
      $_POST['username'],
      $_POST['role'],
      $_POST['status'],
      $user_id
    );

    if ($stmt->execute()) {
      $message = "<p class='text-green-600 font-semibold'>User (ID: $user_id) updated successfully.</p>";

      $select_stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
      $select_stmt->bind_param("s", $user_id);
      $select_stmt->execute();
      $updatedUser = $select_stmt->get_result()->fetch_assoc();
      $select_stmt->close();
    } else {
      $message = "<p class='text-red-600 font-semibold'>Error updating user (ID: $user_id).</p>";
    }

    $stmt->close();
  }
  ?>

  <?php if (!empty($message)) echo "<div class='w-full max-w-md mb-4 text-center'>$message</div>"; ?>

  <?php if ($updatedUser): ?>
    <h3 class="text-xl font-semibold mb-2 text-center">Updated User Form (Auto-filled)</h3>
    <form method="POST" action="" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md mb-6">
      <input type="text" name="user_id" placeholder="User ID" value="<?php echo htmlspecialchars($updatedUser['user_id']); ?>" class="w-full mb-3 p-2 border rounded" required>
      <input type="text" name="first_name" placeholder="First Name" value="<?php echo htmlspecialchars($updatedUser['first_name']); ?>" class="w-full mb-3 p-2 border rounded" required>
      <input type="text" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($updatedUser['last_name']); ?>" class="w-full mb-3 p-2 border rounded" required>
      
      <select name="sex" class="w-full mb-3 p-2 border rounded">
        <option <?php if ($updatedUser['sex'] == 'Male') echo 'selected'; ?>>Male</option>
        <option <?php if ($updatedUser['sex'] == 'Female') echo 'selected'; ?>>Female</option>
        <option <?php if ($updatedUser['sex'] == 'Other') echo 'selected'; ?>>Other</option>
      </select>

      <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($updatedUser['username']); ?>" class="w-full mb-3 p-2 border rounded" required>

      <select name="role" class="w-full mb-3 p-2 border rounded">
        <option <?php if ($updatedUser['role'] == 'admin') echo 'selected'; ?>>admin</option>
        <option <?php if ($updatedUser['role'] == 'student') echo 'selected'; ?>>student</option>
        <option <?php if ($updatedUser['role'] == 'teacher') echo 'selected'; ?>>teacher</option>
        <option <?php if ($updatedUser['role'] == 'registral') echo 'selected'; ?>>registral</option>
        <option <?php if ($updatedUser['role'] == 'department_head') echo 'selected'; ?>>department_head</option>
      </select>

      <select name="status" class="w-full mb-4 p-2 border rounded">
        <option <?php if ($updatedUser['status'] == 'active') echo 'selected'; ?>>active</option>
        <option <?php if ($updatedUser['status'] == 'inactive') echo 'selected'; ?>>inactive</option>
      </select>

      <input type="submit" name="update" value="Update User Again" class="w-full p-2 rounded text-white font-semibold" style="background-color:#00c603;" onmouseover="this.style.backgroundColor='#005603'" onmouseout="this.style.backgroundColor='#00c603'">
    </form>
  <?php endif; ?>

  <h3 class="text-xl font-semibold mb-2 text-center">Update Another User</h3>
  <form method="POST" action="" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md mb-6">
    <input type="text" name="user_id" placeholder="User ID" class="w-full mb-3 p-2 border rounded" required>
    <input type="text" name="first_name" placeholder="First Name" class="w-full mb-3 p-2 border rounded" required>
    <input type="text" name="last_name" placeholder="Last Name" class="w-full mb-3 p-2 border rounded" required>

    <select name="sex" class="w-full mb-3 p-2 border rounded">
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
    </select>

    <input type="text" name="username" placeholder="Username" class="w-full mb-3 p-2 border rounded" required>

    <select name="role" class="w-full mb-3 p-2 border rounded">
      <option>admin</option>
      <option>student</option>
      <option>teacher</option>
      <option>registral</option>
      <option>department_head</option>
    </select>

    <select name="status" class="w-full mb-4 p-2 border rounded">
      <option>active</option>
      <option>inactive</option>
    </select>

    <input type="submit" name="update" value="Update User" class="w-full p-2 rounded text-white font-semibold" style="background-color:#00c603;" onmouseover="this.style.backgroundColor='#005603'" onmouseout="this.style.backgroundColor='#00c603'">
  </form>

  <div class="text-center mt-4">
    <a href="manage_user_account.php" class="text-blue-600 font-semibold hover:underline">← Close Page</a>
  </div>
</body>
</html>
