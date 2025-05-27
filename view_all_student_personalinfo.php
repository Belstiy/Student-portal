<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in and has 'registral' role
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'registral') {
//     echo "<p class='text-red-600 font-semibold'>❌ You do not have permission to view this page.</p>";
//     exit();
// }

// Fetch all students' detailed information from the database
$stmt = $conn->prepare("SELECT student_id, first_name, middle_name, last_name, sex, dob, region, zone, woreda, kebele, phone, guardian_name, guardian_phone, photo_path, certificate_path, grade, stream, academic_year, status FROM students");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Students Info</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 min-h-screen">

<div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[#009dc4]">📚 All Student Detailed Information</h2>
        <a href="registeral.php" class="bg-[#009dc4] text-white px-4 py-2 rounded-md hover:bg-[#007a9b] transition">
            🔙 Back to Registeral Home Page
        </a>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200 shadow rounded-md">
                <thead class="bg-[#009dc4] text-white">
                    <tr>
                        <th class="p-3">Student ID</th>
                        <th class="p-3">First Name</th>
                        <th class="p-3">Middle Name</th>
                        <th class="p-3">Last Name</th>
                        <th class="p-3">Sex</th>
                        <th class="p-3">Date of Birth</th>
                        <th class="p-3">Region</th>
                        <th class="p-3">Zone</th>
                        <th class="p-3">Woreda</th>
                        <th class="p-3">Kebele</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Guardian Name</th>
                        <th class="p-3">Guardian Phone</th>
                        <th class="p-3">Photo</th>
                        <th class="p-3">Certificate</th>
                        <th class="p-3">Grade</th>
                        <th class="p-3">Stream</th>
                        <th class="p-3">Academic Year</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-700">
                    <?php while ($student = $result->fetch_assoc()): ?>
                        <tr class="border-t">
                            <td class="p-3"><?php echo $student['student_id']; ?></td>
                            <td class="p-3"><?php echo $student['first_name']; ?></td>
                            <td class="p-3"><?php echo $student['middle_name']; ?></td>
                            <td class="p-3"><?php echo $student['last_name']; ?></td>
                            <td class="p-3"><?php echo $student['sex']; ?></td>
                            <td class="p-3"><?php echo $student['dob']; ?></td>
                            <td class="p-3"><?php echo $student['region']; ?></td>
                            <td class="p-3"><?php echo $student['zone']; ?></td>
                            <td class="p-3"><?php echo $student['woreda']; ?></td>
                            <td class="p-3"><?php echo $student['kebele']; ?></td>
                            <td class="p-3"><?php echo $student['phone']; ?></td>
                            <td class="p-3"><?php echo $student['guardian_name']; ?></td>
                            <td class="p-3"><?php echo $student['guardian_phone']; ?></td>
                            <td class="p-3">
                                <?php if ($student['photo_path']): ?>
                                    <img src="<?php echo $student['photo_path']; ?>" alt="Photo" class="w-20 h-20 object-cover rounded shadow">
                                <?php else: ?>
                                    <span class="text-gray-500">No photo</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3">
                                <?php if ($student['certificate_path']): ?>
                                    <a href="<?php echo $student['certificate_path']; ?>" target="_blank" class="text-[#009dc4] underline hover:text-[#007a9b]">View Certificate</a>
                                <?php else: ?>
                                    <span class="text-gray-500">No certificate</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3"><?php echo $student['grade']; ?></td>
                            <td class="p-3"><?php echo $student['stream']; ?></td>
                            <td class="p-3"><?php echo $student['academic_year']; ?></td>
                            <td class="p-3"><?php echo $student['status']; ?></td>
                            <td class="p-3">
                                <a href="view_individual_student_personalinfo.php?student_id=<?php echo $student['student_id']; ?>" class="text-[#009dc4] hover:underline">View</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-red-600 mt-4">❌ No students found.</p>
    <?php endif; ?>
</div>

</body>
</html>
