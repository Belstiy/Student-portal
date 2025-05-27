<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in and has the 'registral' role (or another appropriate role)
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'registral') {
    echo "<p>You do not have permission to perform this action.</p>";
    exit();
}

// Check if the form has been submitted and required fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['grade'], $_POST['section'])) {
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $stream = $_POST['stream'];
    $academic_year = $_POST['academic_year'];

    // Prepare the update SQL query for assigning class based on grade and section
    $stmt = $conn->prepare("UPDATE assigned_classes SET stream = ?, academic_year = ? WHERE grade = ? AND section = ?");
    $stmt->bind_param("ssss", $stream, $academic_year, $grade, $section);

    // Execute the query
    if ($stmt->execute()) {
        echo "<p>✅ Assigned class updated successfully for Grade: $grade, Section: $section.</p>";
    } else {
        echo "<p style='color: red;'>❌ Error updating assigned class. Please try again.</p>";
    }

    // Close the statement
    $stmt->close();
}
?>

<h2>Update Assigned Class by Grade and Section</h2>

<form method="POST" action="update_assigned_class.php">
    <label for="grade">Grade:</label>
    <input type="text" name="grade" id="grade" required><br><br>

    <label for="section">Section:</label>
    <input type="text" name="section" id="section" required><br><br>

    <label for="stream">Stream:</label>
    <input type="text" name="stream" id="stream" required><br><br>

    <label for="academic_year">Academic Year:</label>
    <input type="text" name="academic_year" id="academic_year" required><br><br>

    <button type="submit">Update Assigned Class</button>
</form>

<p><a href="view_assigned_classes.php">Go back to View Assigned Classes</a></p>
