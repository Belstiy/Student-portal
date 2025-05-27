<?php
include 'db_connection.php';

$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = $_POST['year'];
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $semester = $_POST['semester'];

    $stmt = $conn->prepare("SELECT * FROM student_results WHERE year = ? AND grade = ? AND section = ? AND semester = ?");
    $stmt->bind_param("ssss", $year, $grade, $section, $semester);
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Student Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            max-width: 1100px;
            margin: auto;
            background-color: #f9f9f9;
        }

        h2, h3 {
            color: #009dc4;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            width: 120px;
            margin-top: 10px;
            color: #333;
        }

        input, select {
            padding: 8px;
            width: 250px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #009dc4;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #007fa3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #009dc4;
            color: white;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            background-color: #009dc4;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 14px;
        }

        .back-btn:hover {
            background-color: #007fa3;
        }
    </style>
</head>
<body>

<a href="teacher.php" class="back-btn">🔙 Back to Teacher Home Page</a>

<h2>View Student Results</h2>

<form method="POST">
    <label>Year:</label>
    <input type="text" name="year" required><br>
    <label>Grade:</label>
    <input type="text" name="grade" required><br>
    <label>Section:</label>
    <input type="text" name="section" required><br>
    <label>Semester:</label>
    <select name="semester" required>
        <option value="">Select Semester</option>
        <option value="1">Semester 1</option>
        <option value="2">Semester 2</option>
        <option value="3">Semester 3</option>
    </select><br>
    <button type="submit">Search</button>
</form>

<?php if (!empty($results)): ?>
    <h3>Results:</h3>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Grade</th>
            <th>Section</th>
            <th>Year</th>
            <th>Semester</th>
            <th>Total</th>
            <th>Average</th>
            <th>Status</th>
            <th>Rank</th>
        </tr>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['student_id']) ?></td>
                <td><?= htmlspecialchars($row['grade']) ?></td>
                <td><?= htmlspecialchars($row['section']) ?></td>
                <td><?= htmlspecialchars($row['year']) ?></td>
                <td><?= htmlspecialchars($row['semester']) ?></td>
                <td><?= htmlspecialchars($row['total']) ?></td>
                <td><?= htmlspecialchars($row['average']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td><?= htmlspecialchars($row['rank']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <p style="color: red; font-weight: bold;">No results found for the selected filters.</p>

<?php endif; ?>

</body>
</html>
