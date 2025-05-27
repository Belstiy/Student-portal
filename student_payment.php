<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $payment_method = $_POST['payment_method'];
    $amount = $_POST['amount'];
    $billing_year = $_POST['billing_year'];

    // Step 1: Validate billing amount and year
    $stmt = $conn->prepare("SELECT amount FROM billing_rates WHERE year = ?");
    $stmt->bind_param("s", $billing_year);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo "<p class='text-red-600 font-semibold mt-4 text-center'>❌ No billing rate found for the selected year.</p>";
        exit;
    }

    $stmt->bind_result($expected_amount);
    $stmt->fetch();

    if ($amount != $expected_amount) {
        echo "<p class='text-red-600 font-semibold mt-4 text-center'>❌ Entered amount (Birr $amount) does not match the expected amount (Birr $expected_amount) for billing year $billing_year.</p>";
        exit;
    }

    // Step 2: Upload the payment slip
    $payment_slip = $_FILES['payment_slip']['name'];
    $upload_dir = "uploads/payment_slips/";
    if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);
    $slip_path = $upload_dir . basename($payment_slip);
    move_uploaded_file($_FILES["payment_slip"]["tmp_name"], $slip_path);

    // Step 3: Insert into student_payment table
    $stmt = $conn->prepare("INSERT INTO student_payment (student_id, amount, payment_method, slip_path, status, billing_year) VALUES (?, ?, ?, ?, 'Pending', ?)");
    $stmt->bind_param("sdsss", $student_id, $amount, $payment_method, $slip_path, $billing_year);
    $stmt->execute();

    echo "<p class='text-green-600 font-semibold mt-4 text-center'>✅ Payment slip uploaded successfully. Awaiting admin verification.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-10">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-lg">
        <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center">💳 Student Payment Form</h2>

        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block mb-1 font-medium">Student ID</label>
                <input type="text" name="student_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block mb-1 font-medium">Payment Method</label>
                <select name="payment_method" required class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="Bank">Bank</option>
                    <option value="Mobile Banking">Mobile Banking</option>
                    <option value="Cash">Cash</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Amount (Birr)</label>
                <input type="number" name="amount" step="0.01" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block mb-1 font-medium">Billing Year</label>
                <input type="text" name="billing_year" value="<?php echo date('Y') . '-' . (date('Y') + 1); ?>" required class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 text-gray-700 cursor-not-allowed">
            </div>

            <div>
                <label class="block mb-1 font-medium">Upload Bank Slip / Screenshot</label>
                <input type="file" name="payment_slip" accept="image/*,application/pdf" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-200">Submit Payment</button>
        </form>

        <!-- Back Button -->
        <div class="mt-6 text-center">
            <a href="student.php" class="text-blue-600 hover:underline text-sm inline-flex items-center">🔙 Back to Student Home Page</a>
        </div>
    </div>

</body>
</html>
