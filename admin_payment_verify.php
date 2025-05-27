<?php
include 'db_connection.php';

// View all pending payments
$result = $conn->query("SELECT * FROM student_payment WHERE status = 'Pending'");
$pending_count = $conn->query("SELECT COUNT(*) FROM student_payment WHERE status = 'Pending'")->fetch_row()[0];
$verified_count = $conn->query("SELECT COUNT(*) FROM student_payment WHERE status = '✔️ Verified'")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Payments</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar-button {
            transition: all 0.2s ease;
        }
        .sidebar-button:hover {
            transform: translateX(5px);
            background-color: #1e40af !important;
        }
        .payment-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex">

<!-- Sidebar Navigation -->
<div class="w-64 bg-blue-800 text-white p-4 flex flex-col">
    <div class="mb-8 text-center">
        <h2 class="text-xl font-bold">Payment Verification</h2>
        <p class="text-sm text-blue-200 mt-1">Hailemariam Mamo School</p>
    </div>
    
    <div class="space-y-4">
        <button onclick="location.reload()" 
                class="sidebar-button w-full bg-blue-700 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg text-left">
            🔄 Refresh Payments
        </button>
        <a href="admin.php" 
           class="sidebar-button block w-full bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-lg text-left">
            ← Back to Admin
        </a>
    </div>
    
    <div class="mt-auto p-4 bg-blue-900 rounded-lg">
        <h3 class="font-semibold mb-3">Payment Statistics</h3>
        <div class="flex justify-between items-center mb-2">
            <span class="text-sm">⏳ Pending:</span>
            <span class="font-bold"><?php echo $pending_count; ?></span>
        </div>
        <div class="flex justify-between items-center">
            <span class="text-sm">✅ Verified:</span>
            <span class="font-bold"><?php echo $verified_count; ?></span>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="flex-1 p-8 bg-white">
    <h2 class="text-2xl font-bold mb-6 text-blue-800">📄 Pending Payment Verifications</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <div class="grid gap-6">
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php
                $payment_id = $row['id'];
                $student_id = $row['student_id'];
                $amount = $row['amount'];
                $billing_year = $row['billing_year'];
                $slip_path = $row['slip_path'];
                $payment_date = $row['payment_date'] ?? 'Not specified';

                // Get correct billing amount with error handling
                $correct_amount = 0;
                $billing_stmt = $conn->prepare("SELECT amount FROM billing_rates WHERE year = ?");
                if ($billing_stmt) {
                    $billing_stmt->bind_param("s", $billing_year);
                    $billing_stmt->execute();
                    $billing_stmt->bind_result($correct_amount);
                    $billing_stmt->fetch();
                    $billing_stmt->close();
                }

                // Get student info with error handling
                $student_name = '';
                $student_program = '';
                $has_student = false;
                $student_stmt = $conn->prepare("SELECT full_name, program FROM students WHERE student_id = ?");
                if ($student_stmt) {
                    $student_stmt->bind_param("s", $student_id);
                    $student_stmt->execute();
                    $student_stmt->bind_result($student_name, $student_program);
                    $has_student = $student_stmt->fetch();
                    $student_stmt->close();
                }
                ?>

                <div class="payment-card bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden transition duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-blue-700 mb-2">
                                    <?php echo $has_student ? "🎓 $student_name" : "⚠️ Unassigned Student"; ?>
                                </h3>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <p><strong>🆔 Student ID:</strong> <?php echo $student_id; ?></p>
                                        <p><strong>📅 Payment Date:</strong> <?php echo $payment_date; ?></p>
                                        <p><strong>📚 Program:</strong> <?php echo $has_student ? $student_program : "Not assigned"; ?></p>
                                    </div>
                                    <div>
                                        <p><strong>💰 Submitted Amount:</strong> <?php echo $amount; ?></p>
                                        <p><strong>📅 Billing Year:</strong> <?php echo $billing_year; ?></p>
                                        <p><strong>✅ Required Amount:</strong> <?php echo $correct_amount; ?></p>
                                    </div>
                                </div>
                                <p class="mt-2">
                                    <strong>🧾 Payment Slip:</strong> 
                                    <a href="<?php echo $slip_path; ?>" target="_blank" class="text-blue-600 underline">View Slip</a>
                                </p>
                                
                                <?php if (!$has_student): ?>
                                    <div class="mt-4 p-3 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 rounded">
                                        <p>⚠️ This student ID is not currently assigned to any registered student.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="flex flex-col space-y-2 ml-4">
                                <form method="POST" class="flex flex-col space-y-2">
                                    <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
                                    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                                    <input type="hidden" name="submitted_amount" value="<?php echo $amount; ?>">
                                    <input type="hidden" name="correct_amount" value="<?php echo $correct_amount; ?>">
                                    <button type="submit" name="approve" 
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                                        ✅ Approve Payment
                                    </button>
                                    <button type="submit" name="reject" 
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow">
                                        ❌ Reject Payment
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-blue-700 rounded">
            <p>There are currently no pending payments to verify.</p>
        </div>
    <?php endif; ?>
</div>

<?php
// Approve Payment
if (isset($_POST['approve'])) {
    $payment_id = $_POST['payment_id'];
    $student_id = $_POST['student_id'];
    $submitted_amount = $_POST['submitted_amount'];
    $correct_amount = $_POST['correct_amount'];

    if ($submitted_amount == $correct_amount) {
        $conn->query("UPDATE student_payment SET status = '✔️ Verified' WHERE id = $payment_id");
        $conn->query("UPDATE students SET status = 'Active' WHERE student_id = '$student_id'");
        echo "<script>alert('✅ Payment verified and student activated.'); location.reload();</script>";
    } else {
        $conn->query("UPDATE student_payment SET status = '❌ Incorrect Amount' WHERE id = $payment_id");
        echo "<script>alert('❌ Payment amount is incorrect.'); location.reload();</script>";
    }
}

// Reject Payment
if (isset($_POST['reject'])) {
    $payment_id = $_POST['payment_id'];
    $conn->query("UPDATE student_payment SET status = '❌ Rejected' WHERE id = $payment_id");
    echo "<script>alert('❌ Payment rejected.'); location.reload();</script>";
}
?>

</body>
</html>