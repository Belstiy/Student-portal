<?php
include 'db_connection.php';

if (isset($_GET['grade'])) {
    $grade = $_GET['grade'];

    $stmt = $conn->prepare("SELECT course_code, course_name FROM courses WHERE grade = ?");
    $stmt->bind_param("s", $grade);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<option value=''>-- Select Course --</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['course_code'] . "'>" . $row['course_name'] . "</option>";
    }

    $stmt->close();
}
?>
