<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connection.php';

    $student_id = $_POST['student_id'];
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $stream = $_POST['stream'];
    $subjects = $_POST['subjects'] ?? [];

    // Check for duplicates
    $check_result = $conn->prepare("SELECT id FROM student_results WHERE student_id = ? AND year = ? AND semester = ?");
    $check_result->bind_param("sss", $student_id, $year, $semester);
    $check_result->execute();
    $result_exists = $check_result->get_result()->num_rows > 0;

    $check_marks = $conn->prepare("SELECT id FROM subject_marks WHERE student_id = ? AND year = ? AND semester = ?");
    $check_marks->bind_param("sss", $student_id, $year, $semester);
    $check_marks->execute();
    $marks_exists = $check_marks->get_result()->num_rows > 0;

    if ($result_exists || $marks_exists) {
        echo "<script>alert('This student already has results for Semester $semester in Year $year.');</script>";
    } else {
        $all_subjects = ['amharic', 'english', 'mathematics', 'biology', 'chemistry', 'physics', 'history', 'civics', 'geography', 'it', 'pe', 'technicaldrawing', 'business', 'economics'];

        if ($semester == 3) {
            $stmt1 = $conn->prepare("SELECT total, average FROM student_results WHERE student_id = ? AND year = ? AND semester = 1");
            $stmt1->bind_param("ss", $student_id, $year);
            $stmt1->execute();
            $data1 = $stmt1->get_result()->fetch_assoc();
            $total1 = $data1['total'] ?? 0;
            $avg1 = $data1['average'] ?? 0;

            $stmt2 = $conn->prepare("SELECT total, average FROM student_results WHERE student_id = ? AND year = ? AND semester = 2");
            $stmt2->bind_param("ss", $student_id, $year);
            $stmt2->execute();
            $data2 = $stmt2->get_result()->fetch_assoc();
            $total2 = $data2['total'] ?? 0;
            $avg2 = $data2['average'] ?? 0;

            $total = round(($total1 + $total2) / 2, 2);
            $average = round(($avg1 + $avg2) / 2, 2);
        } else {
            $total = array_sum($subjects);
            $average = round($total / count($subjects), 2);

            $placeholders = implode(',', array_fill(0, count($all_subjects), '?'));
            $stmt2 = $conn->prepare("INSERT INTO subject_marks (student_id, year, semester, " . implode(',', $all_subjects) . ") VALUES (?, ?, ?, $placeholders)");
            $bind_types = "sss" . str_repeat("i", count($all_subjects));
            $values = [$student_id, $year, $semester];
            foreach ($all_subjects as $subject) {
                $values[] = isset($subjects[$subject]) ? (int)$subjects[$subject] : NULL;
            }
            $stmt2->bind_param($bind_types, ...$values);
            $stmt2->execute();
        }

        $status = ($average >= 50) ? "Promoted" : "Failed";

        $stmt = $conn->prepare("INSERT INTO student_results (student_id, grade, section, year, semester, total, average, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssdss", $student_id, $grade, $section, $year, $semester, $total, $average, $status);
        $stmt->execute();

        // Ranking
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

        echo "<script>alert('Result submitted and ranked successfully!');</script>";
    }
}

include 'db_connection.php';
$existing_entries = [];
$query = $conn->query("SELECT student_id, year, semester FROM student_results");
while ($row = $query->fetch_assoc()) {
    $existing_entries[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Student Result</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: auto;
            padding: 30px;
            background-color: #f4f9fb;
            color: #333;
        }
        h2 {
            color: #009dc4;
            text-align: center;
        }
        label {
            display: inline-block;
            width: 140px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        input, select {
            padding: 8px;
            width: 220px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .subject-inputs {
            margin-top: 20px;
            background: #eef9fc;
            padding: 15px;
            border-radius: 8px;
        }
        button {
            background-color: #009dc4;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #007a9e;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            background-color: #009dc4;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            font-size: 14px;
        }
        .back-btn:hover {
            background-color: #007a9e;
        }
    </style>
    <script>
        const existingResults = <?php echo json_encode($existing_entries); ?>;

        function updateSubjects() {
            const stream = document.querySelector("select[name='stream']").value;
            const semester = document.querySelector("select[name='semester']").value;
            const subjectDiv = document.querySelector('.subject-inputs');

            if (semester === '3') {
                subjectDiv.innerHTML = '<p>Semester 3 results are automatically calculated.</p>';
                return;
            }

            let subjects = [];
            if (stream === '1') {
                subjects = ['Amharic','English','Mathematics','Biology','Chemistry','Physics','History','Civics','Geography','IT','PE'];
            } else if (stream === '2') {
                subjects = ['Amharic','English','Mathematics','Biology','Chemistry','Physics','Civics','TechnicalDrawing','IT','PE'];
            } else if (stream === '3') {
                subjects = ['Amharic','English','Mathematics','History','Business','Economics','Civics','Geography','IT','PE'];
            }

            let html = "";
            subjects.forEach(subject => {
                const key = subject.toLowerCase().replace(/\s/g, '');
                html += `<label>${subject}:</label> <input type='number' name='subjects[${key}]' min='0' max='100' required><br>`;
            });

            subjectDiv.innerHTML = html;
        }

        function validateForm() {
            const studentId = document.querySelector("input[name='student_id']").value;
            const year = document.querySelector("input[name='year']").value;
            const semester = document.querySelector("select[name='semester']").value;

            if (!studentId || !year || !semester) {
                alert("Please fill in student ID, year, and semester.");
                return false;
            }

            const duplicate = existingResults.some(entry =>
                entry.student_id === studentId && entry.year === year && entry.semester === semester
            );

            if (duplicate) {
                alert(`This student already has a result for Semester ${semester} in Year ${year}.`);
                return false;
            }

            return true;
        }

        window.addEventListener("DOMContentLoaded", () => {
            document.querySelector("select[name='stream']").addEventListener('change', updateSubjects);
            document.querySelector("select[name='semester']").addEventListener('change', updateSubjects);
            updateSubjects();
        });
    </script>
</head>
<body>
    <a class="back-btn" href="teacher.php">🔙 Back to Teacher Home Page</a>
    <h2>Submit Student Results</h2>
    <form method="POST" onsubmit="return validateForm()">
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
        <select name="stream" required>
            <option value="">Select Stream</option>
            <option value="1">Non-Selected</option>
            <option value="2">Natural Science</option>
            <option value="3">Social Science</option>
        </select><br>

        <div class="subject-inputs"></div>

        <button type="submit">Submit Result</button>
    </form>
</body>
</html>
