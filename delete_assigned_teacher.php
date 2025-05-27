<?php
session_start();
include 'db_connection.php';

//if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'department_head') {
  //  echo "<p class='error-msg'>❌ You do not have permission to access this page.</p>";
    //exit();
//}

$assignments = [];
$fetch_stmt = $conn->prepare("
    SELECT 
        tc.id, 
        t.first_name, 
        t.last_name, 
        c.course_name, 
        c.grade,
        tc.section, 
        tc.year 
    FROM teacher_courses tc
    JOIN teachers t ON tc.teacher_id = t.teacher_id
    JOIN courses c ON tc.course_code = c.course_code
");
$fetch_stmt->execute();
$result = $fetch_stmt->get_result();
$assignments = $result->fetch_all(MYSQLI_ASSOC);
$fetch_stmt->close();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $assignment_id = $_POST['assignment_id'];

    $delete_stmt = $conn->prepare("DELETE FROM teacher_courses WHERE id = ?");
    $delete_stmt->bind_param("i", $assignment_id);

    if ($delete_stmt->execute()) {
        $message = "<p class='success-msg'>✅ Assignment deleted successfully.</p>";
    } else {
        $message = "<p class='error-msg'>❌ Failed to delete assignment. Please try again.</p>";
    }
    $delete_stmt->close();

    header("Location: delete_assigned_teacher.php?deleted=1");
    exit();
}

if (isset($_GET['deleted']) && $_GET['deleted'] == 1) {
    $message = "<p class='success-msg'>✅ Assignment deleted successfully.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #009dc4;
            text-align: center;
            margin-top: 30px;
        }

        form {
            background-color: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
        }

        label {
            font-weight: bold;
            color: #333;
        }

        select, button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        select:focus, button:focus {
            border-color: #009dc4;
            outline: none;
        }

        button {
            background-color: #009dc4;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #007fa4;
        }

        a {
            text-decoration: none;
            color: #009dc4;
            display: block;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        .success-msg, .error-msg {
            max-width: 600px;
            margin: 20px auto;
            padding: 12px;
            border-radius: 6px;
            text-align: center;
            font-weight: bold;
        }

        .success-msg {
            background-color: #e1f9f0;
            color: #006644;
            border: 1px solid #009dc4;
        }

        .error-msg {
            background-color: #fce4e4;
            color: #c62828;
            border: 1px solid #e53935;
        }
    </style>
</head>
<body>

<h2>🗑️ Delete Assigned Teacher</h2>
<?php if ($message) echo $message; ?>

<form method="POST" action="">
    <label for="assignment_id">Select Assignment to Delete:</label><br>
    <select name="assignment_id" id="assignment_id" required>
        <option value="">-- Select Assignment --</option>
        <?php foreach ($assignments as $assign): ?>
            <option value="<?= $assign['id'] ?>">
                <?= htmlspecialchars($assign['first_name'] . ' ' . $assign['last_name']) ?> - 
                <?= htmlspecialchars($assign['course_name']) ?> (<?= htmlspecialchars($assign['grade']) ?>) - 
                Section <?= htmlspecialchars($assign['section']) ?> - 
                Year <?= htmlspecialchars($assign['year']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this assignment?')">
        ❌ Delete Assignment
    </button>
</form>

<p><a href="Department_Head.php">🔙 Back to Department Head</a></p>

</body>
</html>
