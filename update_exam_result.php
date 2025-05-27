<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connection.php';

    $student_id = $_POST['student_id'];
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $stream = $_POST['stream'];
    $subjects = $_POST['subjects'];

    $total = array_sum($subjects);
    $average = round($total / count($subjects), 2);
    $status = ($average >= 50) ? "Promoted" : "Failed";

    $check_result = $conn->prepare("SELECT id FROM student_results WHERE student_id = ? AND year = ? AND semester = ?");
    $check_result->bind_param("sss", $student_id, $year, $semester);
    $check_result->execute();
    $result = $check_result->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE student_results 
                                SET grade = ?, section = ?, total = ?, average = ?, status = ?
                                WHERE student_id = ? AND year = ? AND semester = ?");
        $stmt->bind_param("ssddssss", $grade, $section, $total, $average, $status, $student_id, $year, $semester);
        $stmt->execute();

        $all_subjects = ['amharic', 'english', 'mathematics', 'biology', 'chemistry', 'physics', 'history', 'civics', 'geography', 'it', 'pe', 'technicaldrawing', 'business', 'economics'];
        $values = array_map(fn($sub) => isset($subjects[$sub]) ? (int)$subjects[$sub] : NULL, $all_subjects);
        $values[] = $student_id;
        $values[] = $year;
        $values[] = $semester;

        $placeholders = implode(',', array_map(fn($sub) => "$sub = ?", $all_subjects));
        $stmt2 = $conn->prepare("UPDATE subject_marks 
                                 SET $placeholders 
                                 WHERE student_id = ? AND year = ? AND semester = ?");
        $bind_types = str_repeat("i", count($all_subjects)) . "sss";
        $stmt2->bind_param($bind_types, ...$values);
        $stmt2->execute();

        // Ranking Logic (per semester)
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

        echo "<script>alert('Result updated and rankings recalculated successfully!');</script>";
    } else {
        echo "<script>alert('No result found for this student in year $year and semester $semester to update.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student Results</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #f5f9fc;
            color: #333;
        }

        h2 {
            color: #009dc4;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            width: 150px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select {
            padding: 8px;
            width: 250px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 10px 25px;
            background-color: #009dc4;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #007aa1;
        }

        .subject-inputs {
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 8px;
        }

        .back-btn {
            display: inline-block;
            margin-top: 25px;
            text-decoration: none;
            background-color: #007aa1;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
        }

        .back-btn:hover {
            background-color: #005f7a;
        }
    </style>
    <script>
        function updateSubjects() {
            const stream = document.querySelector("select[name='stream']").value;
            const subjectDiv = document.querySelector('.subject-inputs');
            let subjects = [];

            if (stream === '1') {
                subjects = ['Amharic', 'English', 'Mathematics', 'Biology', 'Chemistry', 'Physics', 'History', 'Civics', 'Geography', 'IT', 'PE'];
            } else if (stream === '2') {
                subjects = ['Amharic', 'English', 'Mathematics', 'Biology', 'Chemistry', 'Physics', 'Civics', 'TechnicalDrawing', 'IT', 'PE'];
            } else if (stream === '3') {
                subjects = ['Amharic', 'English', 'Mathematics', 'History', 'Business', 'Economics', 'Civics', 'Geography', 'IT', 'PE'];
            }

            let html = "";
            subjects.forEach(subject => {
                const key = subject.toLowerCase().replace(/\s/g, '');
                html += `<label>${subject}:</label> <input type='number' name='subjects[${key}]' min='0' max='100' required><br>`;
            });

            subjectDiv.innerHTML = html;
        }
    </script>
</head>
<body>

<h2>Update Student Results</h2>
<form method="POST">
    <label>Student ID:</label><input type="text" name="student_id" required><br>
    <label>Grade:</label><input type="text" name="grade" required><br>
    <label>Section:</label><input type="text" name="section" required><br>
    <label>Year:</label><input type="text" name="year" required><br>

    <label>Semester:</label>
    <select name="semester" required>
        <option value="">Select Semester</option>
        <option value="1">Semester 1</option>
        <option value="2">Semester 2</option>
        <option value="3">Semester 3</option>
    </select><br>

    <label>Stream:</label>
    <select name="stream" onchange="updateSubjects()" required>
        <option value="">Select Stream</option>
        <option value="1">Non-Selected</option>
        <option value="2">Natural Science</option>
        <option value="3">Social Science</option>
    </select><br>

    <div class="subject-inputs"></div>

    <button type="submit">Update Result</button>
</form>

<a href="teacher.php" class="back-btn">🔙 Back to Teacher Home Page</a>

<script>updateSubjects();</script>

</body>
</html>
