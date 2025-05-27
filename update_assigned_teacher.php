<?php
session_start();
include 'db_connection.php';

//if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'department_head') {
   // echo "<p>\u274c You do not have permission to access this page.</p>";
   // exit();
//}

$assignments = [];
$assignment_stmt = $conn->prepare("
    SELECT 
        tc.id, 
        t.first_name, 
        t.last_name, 
        c.course_name, 
        tc.section, 
        tc.year 
    FROM teacher_courses tc
    JOIN teachers t ON tc.teacher_id = t.teacher_id
    JOIN courses c ON tc.course_code = c.course_code
");
$assignment_stmt->execute();
$result = $assignment_stmt->get_result();
$assignments = $result->fetch_all(MYSQLI_ASSOC);
$assignment_stmt->close();

$selected_id = $teacher_id = $course_code = $section = $year = $grade = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['load'])) {
    $selected_id = $_POST['assignment_id'];
    $stmt = $conn->prepare("SELECT * FROM teacher_courses WHERE id = ?");
    $stmt->bind_param("i", $selected_id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if ($row) {
        $teacher_id = $row['teacher_id'];
        $course_code = $row['course_code'];
        $section = $row['section'];
        $year = $row['year'];

        $course_stmt = $conn->prepare("SELECT grade FROM courses WHERE course_code = ?");
        $course_stmt->bind_param("s", $course_code);
        $course_stmt->execute();
        $grade_row = $course_stmt->get_result()->fetch_assoc();
        $grade = $grade_row['grade'] ?? '';
        $course_stmt->close();
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $selected_id = $_POST['assignment_id'];
    $grade = isset($_POST['grade']) ? $_POST['grade'] : '';

    $course_code = $_POST['course_code'];
    $section = trim($_POST['section']);
    $year = trim($_POST['year']);

    $stmt = $conn->prepare("SELECT teacher_id FROM teacher_courses WHERE id = ?");
    $stmt->bind_param("i", $selected_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $teacher_row = $res->fetch_assoc();
    $teacher_id = $teacher_row['teacher_id'] ?? '';
    $stmt->close();

    if ($teacher_id) {
        $teacher_dept_stmt = $conn->prepare("SELECT department FROM teachers WHERE teacher_id = ?");
        $teacher_dept_stmt->bind_param("s", $teacher_id);
        $teacher_dept_stmt->execute();
        $teacher_dept_result = $teacher_dept_stmt->get_result();
        $teacher_dept_row = $teacher_dept_result->fetch_assoc();
        $teacher_dept = trim($teacher_dept_row['department']);
        $teacher_dept_stmt->close();

        $course_stmt = $conn->prepare("SELECT course_name FROM courses WHERE course_code = ?");
        $course_stmt->bind_param("s", $course_code);
        $course_stmt->execute();
        $course_result = $course_stmt->get_result();
        $course_row = $course_result->fetch_assoc();
        $course_name = trim($course_row['course_name']);
        $course_stmt->close();

        if ($teacher_dept !== $course_name) {
            $message = "<p style='color:red;'>\u274c Cannot update. The course <strong>$course_name</strong> does not match the teacher's department <strong>$teacher_dept</strong>.</p>";
        } else {
            $check_stmt = $conn->prepare("
                SELECT * FROM teacher_courses 
                WHERE teacher_id = ? AND course_code = ? AND section = ? AND year = ? AND id != ?
            ");
            $check_stmt->bind_param("ssssi", $teacher_id, $course_code, $section, $year, $selected_id);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                $message = "<p style='color:red;'>\u274c Duplicate entry exists. Teacher already assigned to this course-section-year.</p>";
            } else {
                $update_stmt = $conn->prepare("
                    UPDATE teacher_courses 
                    SET course_code = ?, section = ?, year = ? 
                    WHERE id = ?
                ");
                $update_stmt->bind_param("sssi", $course_code, $section, $year, $selected_id);

                if ($update_stmt->execute()) {
                    $message = "<p style='color:green;'>Teacher Assignment updated successfully.</p>";
                } else {
                    $message = "<p style='color:red;'> Failed to update assignment.</p>";
                }
                $update_stmt->close();
            }
            $check_stmt->close();
        }
    } else {
        $message = "<p style='color:red;'> Invalid assignment selected.</p>";
    }
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 30px;
        background-color: #f9f9f9;
        color: #333;
    }

    h2 {
        color: #009dc4;
        border-bottom: 2px solid #009dc4;
        padding-bottom: 5px;
          text-align: center;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        max-width: 600px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        margin-left: 300px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    select:focus {
        border-color: #009dc4;
        outline: none;
    }

    button {
        background-color: #009dc4;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #007ea6;
    }

    p {
        font-size: 15px;
        line-height: 1.5;
        margin-left: 300px;
    }

    a {
        color: #009dc4;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    hr {
        margin: 40px 0 20px 0;
        border: none;
        border-top: 1px solid #ccc;
    }

    .message-success {
        color: green;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .message-error {
        color: red;
        font-weight: bold;
        margin-bottom: 15px;
    }
</style>


<h2> Update Assigned Teacher to Courses</h2>
<?php if ($message) echo $message; ?>

<form method="POST" action="">
    <label for="assignment_id">Select Assignment to Update:</label><br>
    <select name="assignment_id" id="assignment_id" required>
        <option value="">-- Select Assignment --</option>
        <?php foreach ($assignments as $assign): ?>
            <option value="<?= $assign['id'] ?>" <?= ($assign['id'] == $selected_id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($assign['first_name'] . ' ' . $assign['last_name']) ?> - 
                <?= htmlspecialchars($assign['course_name']) ?> - 
                Section <?= htmlspecialchars($assign['section']) ?> - 
                Year <?= htmlspecialchars($assign['year']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>
    <button type="submit" name="load">Load Assignment</button>
</form>

<?php if ($teacher_id): ?>
    <hr>
    <form method="POST" action="">
        <input type="hidden" name="assignment_id" value="<?= $selected_id ?>">

        <label for="grade">Update Grade:</label><br>
        <select name="grade" id="grade" onchange="fetchCoursesByGrade(this.value, '<?= $course_code ?>')" required>
            <option value="">-- Select Grade --</option>
            <?php
            $grades = ["Grade 9", "Grade 10", "Grade 11", "Grade 12"];
            foreach ($grades as $g) {
                $selected = ($g == $grade) ? 'selected' : '';
                echo "<option value=\"$g\" $selected>$g</option>";
            }
            ?>
        </select><br><br>

        <label for="course_code">Update Course:</label><br>
        <select name="course_code" id="course_code" required>
            <option value="">-- Select Course --</option>
        </select><br><br>

        <label for="section">Update Section:</label><br>
        <input type="text" name="section" id="section" value="<?= htmlspecialchars($section) ?>" required><br><br>

        <label for="year">Update Year:</label><br>
        <input type="text" name="year" id="year" value="<?= htmlspecialchars($year) ?>" required><br><br>

        <button type="submit" name="update">Update Assignment</button>
    </form>

    <script>
    function fetchCoursesByGrade(grade, selectedCourseCode = '') {
        if (grade === '') {
            document.getElementById("course_code").innerHTML = "<option value=''>-- Select Course --</option>";
            return;
        }
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_courses_by_grade.php?grade=" + encodeURIComponent(grade), true);
        xhr.onload = function () {
            if (this.status === 200) {
                let courseDropdown = document.getElementById("course_code");
                courseDropdown.innerHTML = "<option value=''>-- Select Course --</option>" + this.responseText;

                if (selectedCourseCode) {
                    Array.from(courseDropdown.options).forEach(option => {
                        if (option.value === selectedCourseCode) {
                            option.selected = true;
                        }
                    });
                }
            }
        };
        xhr.send();
    }

    window.onload = function () {
        const grade = document.getElementById("grade").value;
        if (grade) {
            fetchCoursesByGrade(grade, '<?= $course_code ?>');
        }
    }
    </script>
<?php endif; ?>

<p><a href="Department_Head.php">Back to Department Head</a></p>
