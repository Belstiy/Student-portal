<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "stud_management");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} ?>