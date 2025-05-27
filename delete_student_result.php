<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connection.php';

    $student_id = $_POST['student_id'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];

    // Check if the student result exists
    $check_result = $conn->prepare("SELECT grade, section FROM student_results WHERE student_id = ? AND year = ? AND semester = ?");
    $check_result->bind_param("sss", $student_id, $year, $semester);
    $check_result->execute();
    $result = $check_result->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $grade = $row['grade'];
        $section = $row['section'];

        // Delete the student result
        $delete_result = $conn->prepare("DELETE FROM student_results WHERE student_id = ? AND year = ? AND semester = ?");
        $delete_result->bind_param("sss", $student_id, $year, $semester);
        $delete_result->execute();

        // Delete the subject marks
        $delete_marks = $conn->prepare("DELETE FROM subject_marks WHERE student_id = ? AND year = ? AND semester = ?");
        $delete_marks->bind_param("sss", $student_id, $year, $semester);
        $delete_marks->execute();

        // Ranking Logic
        $students = [];
        $query = $conn->prepare("SELECT id, average FROM student_results WHERE grade = ? AND section = ? AND year = ? AND semester = ? ORDER BY average DESC");
        $query->bind_param("ssss", $grade, $section, $year, $semester);
        $query->execute();
        $result = $query->get_result();

        $rank = 0;
        $prev_avg = null;
        $real_rank = 0;

        while ($row = $result->fetch_assoc()) {
            $real_rank++;
            if ($prev_avg !== null && $prev_avg != $row['average']) {
                $rank = $real_rank;
            } elseif ($prev_avg === null) {
                $rank = 1;
            }
            $students[] = ['id' => $row['id'], 'rank' => $rank];
            $prev_avg = $row['average'];
        }

        foreach ($students as $s) {
            $update = $conn->prepare("UPDATE student_results SET rank = ? WHERE id = ?");
            $update->bind_param("ii", $s['rank'], $s['id']);
            $update->execute();
        }

        echo "<script>alert('Result deleted and rankings updated successfully!');</script>";
    } else {
        echo "<script>alert('No result found for this student in the specified year and semester.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Student Results</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f9fc;
            color: #333;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 157, 196, 0.2);
        }

        h2 {
            text-align: center;
            color: #009dc4;
            margin-bottom: 25px;
        }

        label {
            display: inline-block;
            width: 130px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select {
            padding: 8px;
            width: calc(100% - 150px);
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #009dc4;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #007fa3;
        }

        .back-btn {
            display: inline-block;
            margin-top: 25px;
            text-decoration: none;
            background-color: #007fa3;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .back-btn:hover {
            background-color: #005f7a;
        }
    </style>
</head>
<body>
<h2>Delete Student Results</h2>
<form method="POST">
    <label>Student ID:</label><input type="text" name="student_id" required><br>
    <label>Year:</label><input type="text" name="year" required><br>
    <label>Semester:</label>
    <select name="semester" required>
        <option value="">Select Semester</option>
        <option value="1">Semester 1</option>
        <option value="2">Semester 2</option>
        <option value="3">Semester 3</option>
    </select><br>

    <button type="submit">Delete Result</button>
</form>

<a href="teacher.php" class="back-btn">🔙 Back to Teacher Home Page</a>
</body>
</html>
