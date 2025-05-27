<?php
include 'db_connection.php';

$registeredUser = null;
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = trim($_POST['user_id']);
    $confirm_user_id = trim($_POST['confirm_user_id']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $sex = $_POST['sex'];
    $username = trim($_POST['username']);
    $confirm_username = trim($_POST['confirm_username']);
    $password_raw = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    // Server-side validation
    if (
        empty($user_id) || empty($confirm_user_id) || empty($first_name) || empty($last_name) || empty($sex) ||
        empty($username) || empty($confirm_username) || empty($password_raw) || empty($confirm_password) ||
        empty($role) || empty($status)
    ) {
        $message = "<p class='text-red-500 text-center font-semibold'>❌ Please fill in all fields.</p>";
    } elseif ($user_id !== $confirm_user_id) {
        $message = "<p class='text-red-500 text-center font-semibold'>❌ User IDs do not match.</p>";
    } elseif ($username !== $confirm_username) {
        $message = "<p class='text-red-500 text-center font-semibold'>❌ Usernames do not match.</p>";
    } elseif ($password_raw !== $confirm_password) {
        $message = "<p class='text-red-500 text-center font-semibold'>❌ Passwords do not match.</p>";
    } else {
        // Check if user ID already exists
        $check_id_stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $check_id_stmt->bind_param("s", $user_id);
        $check_id_stmt->execute();
        $id_result = $check_id_stmt->get_result();

        if ($id_result->num_rows > 0) {
            $message = "<p class='text-red-500 text-center font-semibold'>❌ User ID already exists.</p>";
        } else {
            // Check if username already exists
            $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $check_stmt->bind_param("s", $username);
            $check_stmt->execute();
            $result = $check_stmt->get_result();

            if ($result->num_rows > 0) {
                $message = "<p class='text-red-500 text-center font-semibold'>❌ Username already exists.</p>";
            } else {
                // Insert new user
                $password = md5($password_raw);
                $stmt = $conn->prepare("INSERT INTO users (user_id, first_name, last_name, sex, username, password, role, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $user_id, $first_name, $last_name, $sex, $username, $password, $role, $status);

                if ($stmt->execute()) {
                    $message = "<p class='text-green-600 text-center font-semibold'>✅ User registered successfully!</p>";
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
                    $message = "<p class='text-red-500 text-center font-semibold'>❌ Error registering user.</p>";
                }
                $stmt->close();
            }
            $check_stmt->close();
        }
        $check_id_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register Student Account</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script>
    function validateForm() {
      const form = document.forms['registerForm'];
      const fields = ['user_id', 'confirm_user_id', 'first_name', 'last_name', 'sex', 'username', 'confirm_username', 'password', 'confirm_password', 'role', 'status'];
      for (let field of fields) {
        if (form[field].value.trim() === '') {
          alert('Please fill in all fields.');
          return false;
        }
      }

      if (form['user_id'].value !== form['confirm_user_id'].value) {
        alert('User IDs do not match.');
        return false;
      }

      if (form['username'].value !== form['confirm_username'].value) {
        alert('Usernames do not match.');
        return false;
      }

      if (form['password'].value !== form['confirm_password'].value) {
        alert('Passwords do not match.');
        return false;
      }

      return true;
    }
  </script>
</head>
<body class="bg-gray-100 min-h-screen py-8">

  <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold text-center text-cyan-700 mb-2">Student Registration</h2>
    <p class="text-center text-gray-600 mb-6">Create your student account for the system</p>

    <?= $message ?>

    <?php if ($registeredUser): ?>
      <h3 class="text-lg font-semibold mt-6 text-center text-green-700">Registered User Info</h3>
      <div class="grid grid-cols-1 gap-4 mt-4">
        <?php foreach ($registeredUser as $label => $value): ?>
          <div>
            <label class="block text-sm font-medium text-gray-700"><?= ucfirst(str_replace('_', ' ', $label)) ?></label>
            <input type="text" value="<?= htmlspecialchars($value) ?>" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100">
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form name="registerForm" method="POST" action="" onsubmit="return validateForm();" class="mt-6 space-y-4">
      <input type="text" name="user_id" placeholder="User ID" class="w-full p-2 border rounded-md" required>
      <input type="text" name="confirm_user_id" placeholder="Confirm User ID" class="w-full p-2 border rounded-md" required>
      <input type="text" name="first_name" placeholder="First Name" class="w-full p-2 border rounded-md" required>
      <input type="text" name="last_name" placeholder="Last Name" class="w-full p-2 border rounded-md" required>

      <select name="sex" class="w-full p-2 border rounded-md" required>
        <option value="">Select Sex</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>

      <input type="text" name="username" placeholder="Username" class="w-full p-2 border rounded-md" required>
      <input type="text" name="confirm_username" placeholder="Confirm Username" class="w-full p-2 border rounded-md" required>
      <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded-md" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" class="w-full p-2 border rounded-md" required>

      <select name="role" class="w-full p-2 border rounded-md" required>
        <option value="student">Student</option>
      </select>

      <select name="status" class="w-full p-2 border rounded-md" required>
        <option value="">Select Status</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>

      <input type="submit" value="Register" class="w-full bg-cyan-600 text-white font-semibold py-2 rounded-md hover:bg-cyan-700">
    </form>

    <a href="index.php" class="block mt-4 text-center text-cyan-600 hover:underline">← Back to Home Page</a>
  </div>

</body>
</html>
