<?php
// Database connection
include 'db_connection.php';

// Collect POST data
$user_id = $_POST['user_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$sex = $_POST['sex'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$role = $_POST['role'];
$status = $_POST['status'];

// Check if username already exists
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo "Username already exists. <a href='user_registration.php'>Try again</a>";
} else {
  $insert = $conn->prepare("INSERT INTO users (user_id, first_name, last_name, sex, username, password, role, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $insert->bind_param("ssssssss", $user_id, $first_name, $last_name, $sex, $username, $password, $role, $status);
  if ($insert->execute()) {
    echo "Registration successful! <a href='login.php'>Login here</a>";
  } else {
    echo "Registration failed. Please try again.";
  }
}
$conn->close();
?>
