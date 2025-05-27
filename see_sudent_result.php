<?php
include 'db_connection.php';

$student_id = $_GET['student_id'] ?? '';
$year = $_GET['year'] ?? '';
$semester = $_GET['semester'] ?? '';
$result_available = false;
$marks_available = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $student_id && $year && $semester) {
    // Fetch approved result
    $stmt = $conn->prepare("SELECT * FROM student_results WHERE student_id = ? AND year = ? AND semester = ? AND approved = 1");
    $stmt->bind_param("sss", $student_id, $year, $semester);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($semester == '3') {
        // Fetch semester 1 and 2 marks
        $stmt1 = $conn->prepare("SELECT * FROM subject_marks WHERE student_id = ? AND year = ? AND semester = 1");
        $stmt1->bind_param("ss", $student_id, $year);
        $stmt1->execute();
        $marks1 = $stmt1->get_result()->fetch_assoc();

        $stmt2 = $conn->prepare("SELECT * FROM subject_marks WHERE student_id = ? AND year = ? AND semester = 2");
        $stmt2->bind_param("ss", $student_id, $year);
        $stmt2->execute();
        $marks2 = $stmt2->get_result()->fetch_assoc();

        if ($marks1 && $marks2) {
            $marks = [];
            foreach ($marks1 as $subject => $mark1) {
                if (in_array($subject, ['id', 'student_id', 'year', 'semester'])) continue;
                $mark2 = $marks2[$subject] ?? 0;
                $marks[$subject] = round(($mark1 + $mark2) / 2, 2);
            }
            $marks_available = true;
        } else {
            $error_message = "Marks for semester 1 or 2 are missing.";
        }

        if ($result->num_rows > 0) {
            $result_data = $result->fetch_assoc();
            $result_available = true;
        } else {
            $error_message = "No approved result found for Semester 3.";
        }

    } else {
        // For semester 1 or 2
        if ($result->num_rows > 0) {
            $result_data = $result->fetch_assoc();
            $result_available = true;

            $stmt2 = $conn->prepare("SELECT * FROM subject_marks WHERE student_id = ? AND year = ? AND semester = ?");
            $stmt2->bind_param("sss", $student_id, $year, $semester);
            $stmt2->execute();
            $marks = $stmt2->get_result()->fetch_assoc();

            if ($marks && is_array($marks)) {
                $marks_available = true;
            } else {
                $error_message = "No subject marks found for Semester $semester.";
            }
        } else {
            $error_message = "No approved result found for Semester $semester.";
        }
    }

    // Fetch student info
    $stmt3 = $conn->prepare("SELECT first_name, last_name, photo_path FROM students WHERE student_id = ?");
    $stmt3->bind_param("s", $student_id);
    $stmt3->execute();
    $student_info = $stmt3->get_result()->fetch_assoc();

    if ($student_info) {
        $full_name = $student_info['first_name'] . " " . $student_info['last_name'];
        $photo_path =  $student_info['photo_path'];
    } else {
        $error_message = "Student information not found.";
        $result_available = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Transcript</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            background-color: #f5f7fa;
            padding: 20px;
        }

        .report-card {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            padding: 30px;
        }

        .search-form {
            background: var(--light-color);
            padding: 25px;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
            box-shadow: var(--box-shadow);
        }

        .search-form h2 {
            color: var(--secondary-color);
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--secondary-color);
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-family: inherit;
            font-size: 16px;
            transition: var(--transition);
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .error {
            color: var(--danger-color);
            background: #fde8e8;
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        .transcript-section {
            display: none;
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .student-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--light-color);
            margin-bottom: 20px;
            box-shadow: var(--box-shadow);
        }

        .header-text h2 {
            color: var(--secondary-color);
            margin-bottom: 10px;
            font-size: 22px;
        }

        .header-text p {
            margin-bottom: 5px;
            color: #555;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .result-table th, .result-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .result-table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
        }

        .result-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .result-table tr:hover {
            background-color: #f1f1f1;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
            background: var(--light-color);
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .summary p {
            background: white;
            padding: 15px;
            border-radius: var(--border-radius);
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .summary p strong {
            color: var(--primary-color);
        }

        .print-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background-color: var(--secondary-color);
            margin-top: 20px;
        }

        .print-btn:hover {
            background-color: #1a252f;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
            }

            .summary {
                grid-template-columns: 1fr;
            }

            .result-table {
                display: block;
                overflow-x: auto;
            }
        }

        @media print {
            body {
                background: none;
                padding: 0;
            }

            .search-form, button {
                display: none;
            }

            .report-card {
                box-shadow: none;
                padding: 0;
            }

            .transcript-section {
                display: block !important;
            }
        }
    </style>
</head>
<body>
<div class="report-card">
    <form method="get" class="search-form">
        <h2>Check Your Transcript</h2>
        <div class="form-group">
            <label for="student_id">Student ID:</label>
            <input type="text" name="student_id" id="student_id" required value="<?= htmlspecialchars($student_id) ?>">
        </div>
        
        <div class="form-group">
            <label for="year">Academic Year:</label>
            <input type="text" name="year" id="year" required value="<?= htmlspecialchars($year) ?>">
        </div>
        
        <div class="form-group">
            <label for="semester">Semester:</label>
            <select name="semester" id="semester" required>
                <option value="">--Select Semester--</option>
                <option value="1" <?= $semester === '1' ? 'selected' : '' ?>>Semester 1</option>
                <option value="2" <?= $semester === '2' ? 'selected' : '' ?>>Semester 2</option>
                <option value="3" <?= $semester === '3' ? 'selected' : '' ?>>Semester 3</option>
            </select>
        </div>

        <button type="submit">View Result</button>
        <p><a href="student.php">🔙 Back to  Home</a></p>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && (!$student_id || !$year || !$semester)): ?>
        <p class="error">Please enter Student ID, Year, and Semester.</p>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <p class="error"><?= $error_message ?></p>
    <?php endif; ?>

    <?php if ($result_available && $marks_available): ?>
        <div class="transcript-section" id="transcript">
            <div class="header">
                <?php if ($photo_path): ?>
                    <img src="<?= $photo_path ?>" class="student-photo" alt="Student Photo">
                <?php endif; ?>
                <div class="header-text">
                    <h2>Hailemariam Mamo Secondary & Preparatory School Student Transcript</h2>
                    <p><strong>Name:</strong> <?= $full_name ?></p>
                    <p><strong>ID:</strong> <?= $student_id ?> |
                       <strong>Grade:</strong> <?= $result_data['grade'] ?> |
                       <strong>Section:</strong> <?= $result_data['section'] ?> |
                       <strong>Year:</strong> <?= $result_data['year'] ?> |
                       <strong>Semester:</strong> <?= $semester ?></p>
                </div>
            </div>

            <table class="result-table">
                <thead>
                    <tr><th>Subject</th><th>Mark</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($marks as $subject => $mark):
                        if (in_array($subject, ['id', 'student_id', 'year', 'semester'])) continue;
                    ?>
                        <tr>
                            <td><?= ucfirst(str_replace('_', ' ', $subject)) ?></td>
                            <td><?= $mark ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="summary">
                <p><strong>Total:</strong> <?= $result_data['total'] ?></p>
                <p><strong>Average:</strong> <?= $result_data['average'] ?></p>
                <p><strong>Rank:</strong> <?= $result_data['rank'] ?></p>
                <p><strong>Status:</strong> <?= $result_data['status'] ?></p>
            </div>

            <button class="print-btn" onclick="window.print()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                    <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                </svg>
                Print Report
            </button>
        </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show transcript section if available
        const transcriptSection = document.getElementById('transcript');
        if (transcriptSection) {
            transcriptSection.style.display = 'block';
        }

        // Form validation
        const form = document.querySelector('.search-form');
        form.addEventListener('submit', function(e) {
            const studentId = document.getElementById('student_id').value.trim();
            const year = document.getElementById('year').value.trim();
            const semester = document.getElementById('semester').value;
            
            if (!studentId || !year || !semester) {
                e.preventDefault();
                alert('Please fill in all fields');
            }
        });

        // Auto-format year input (e.g., 2023-2024)
        const yearInput = document.getElementById('year');
        if (yearInput) {
            yearInput.addEventListener('input', function() {
                const value = this.value.replace(/\D/g, '');
                if (value.length > 4) {
                    this.value = value.slice(0, 4) + '-' + value.slice(4, 8);
                }
            });
        }

        // Show loading state when form is submitted
        form.addEventListener('submit', function() {
            const button = form.querySelector('button');
            button.disabled = true;
            button.innerHTML = 'Loading...';
        });
    });

    // Print only the transcript section
    function printTranscript() {
        const originalContents = document.body.innerHTML;
        const transcript = document.getElementById('transcript').innerHTML;
        
        document.body.innerHTML = `
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                }
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .student-photo {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    object-fit: cover;
                    margin-bottom: 10px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
                .summary {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 20px;
                }
            </style>
            ${transcript}
        `;
        
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
</body>
</html>