<?php
session_start();
include 'db_connection.php';

//if (!isset($_SESSION['role']) || $_SESSION['role'] != 'department_head') {
   // echo "<p class='error'>❌ You do not have permission to access this page.</p>";
 //  exit();
//}

$teachers_query = "SELECT teacher_id, first_name, last_name FROM teachers";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher_id = $_POST['teacher_id'];
    $course_code = $_POST['course_code'];
    $section = trim($_POST['section']);
    $year = trim($_POST['year']);

    $teacher_stmt = $conn->prepare("SELECT department FROM teachers WHERE teacher_id = ?");
    $teacher_stmt->bind_param("s", $teacher_id);
    $teacher_stmt->execute();
    $teacher_result = $teacher_stmt->get_result();

    $course_stmt = $conn->prepare("SELECT course_name FROM courses WHERE course_code = ?");
    $course_stmt->bind_param("s", $course_code);
    $course_stmt->execute();
    $course_result = $course_stmt->get_result();

    if ($teacher_result->num_rows > 0 && $course_result->num_rows > 0) {
        $teacher_row = $teacher_result->fetch_assoc();
        $course_row = $course_result->fetch_assoc();

        $teacher_dept = trim($teacher_row['department']);
        $course_name = trim($course_row['course_name']);

        if ($teacher_dept !== $course_name) {
            $message = "<p class='error'>❌ Teacher cannot be assigned to <strong>$course_name</strong> because their department (<strong>$teacher_dept</strong>) does not match the course name.</p>";
        } else {
            $check_stmt = $conn->prepare("SELECT * FROM teacher_courses WHERE teacher_id = ? AND course_code = ? AND section = ? AND year = ?");
            $check_stmt->bind_param("ssss", $teacher_id, $course_code, $section, $year);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                $message = "<p class='error'>❌ This teacher (ID: <strong>$teacher_id</strong>) is already assigned to <strong>$course_name</strong> (Section <strong>$section</strong>) for academic year <strong>$year</strong>.</p>";
            } else {
                $assign_stmt = $conn->prepare("INSERT INTO teacher_courses (teacher_id, course_code, section, year) VALUES (?, ?, ?, ?)");
                $assign_stmt->bind_param("ssss", $teacher_id, $course_code, $section, $year);

                if ($assign_stmt->execute()) {
                    $message = "<p class='success'>✅ Teacher assigned to <strong>$course_name</strong> (Section <strong>$section</strong>) for year <strong>$year</strong> successfully.</p>";
                } else {
                    $message = "<p class='error'>❌ Failed to assign teacher to course. Please try again.</p>";
                }
                $assign_stmt->close();
            }
            $check_stmt->close();
        }
    } else {
        $message = "<p class='error'>❌ Invalid teacher or course selected.</p>";
    }

    $teacher_stmt->close();
    $course_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Teacher to Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 40%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
        }
        h2 {
            color: #009dc4;
            font-size: 2rem;
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
        }
        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px 0;
        }
        button {
            background-color: #009dc4;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
        }
        button:hover {
            background-color: #007ba7;
        }
        .message {
            margin: 15px 0;
            font-size: 1rem;
            text-align: center;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        a {
            text-decoration: none;
            color: #009dc4;
            font-weight: bold;
            text-align: center;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📘 Assign Teacher to Course</h2>

    <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>

    <form method="POST" action="">
        <label for="teacher_id">Select Teacher:</label>
        <select name="teacher_id" id="teacher_id" required>
            <option value="">-- Select Teacher --</option>
            <?php
            $teachers_result = $conn->query($teachers_query);
            while ($teacher = $teachers_result->fetch_assoc()) {
                echo "<option value='" . $teacher['teacher_id'] . "'>" . $teacher['first_name'] . " " . $teacher['last_name'] . "</option>";
            }
            ?>
        </select>

        <label for="grade">Select Grade:</label>
        <select name="grade" id="grade" required onchange="fetchCourses()">
            <option value="">-- Select Grade --</option>
            <option value="Grade 9">Grade 9</option>
            <option value="Grade 10">Grade 10</option>
            <option value="Grade 11">Grade 11</option>
            <option value="Grade 12">Grade 12</option>
        </select>

        <label for="course_code">Select Course:</label>
        <select name="course_code" id="course_code" required>
            <option value="">-- Select Course --</option>
        </select>

        <label for="section">Enter Section:</label>
        <input type="text" name="section" id="section" placeholder="e.g., A up to D" required>

        <label for="year">Academic Year:</label>
        <input type="text" name="year" id="year" placeholder="e.g., 2024/2025" required>

        <button type="submit">Assign Teacher</button>
    </form>

    <p><a href="Department_Head.php">🔙 Back to Department Head</a></p>
</div>

<script>
function fetchCourses() {
    var grade = document.getElementById("grade").value;
    var courseSelect = document.getElementById("course_code");
    courseSelect.innerHTML = "<option>Loading...</option>";

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_courses_by_grade.php?grade=" + encodeURIComponent(grade), true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            courseSelect.innerHTML = xhr.responseText;
        } else {
            courseSelect.innerHTML = "<option value=''>Error loading courses</option>";
        }
    };
    xhr.send();
}
</script>

</body>
</html>
