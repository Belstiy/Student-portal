<?php
include 'db_connection.php';

// Fetch the latest billing rate (since only one row exists)
$stmt = $conn->prepare("SELECT year, amount FROM billing_rates LIMIT 1");
$stmt->execute();
$stmt->bind_result($year, $amount);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Current Billing Fee</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

  <div class="bg-white p-8 rounded-2xl shadow-md max-w-md w-full">
    <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center">📅 Current Registration Payment</h2>

    <form class="space-y-4">
      <?php if ($stmt->fetch()) { ?>
        <div>
          <label for="year" class="block font-medium mb-1">Academic Year</label>
          <input type="text" id="year" value="<?php echo $year; ?>" readonly
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed">
        </div>

        <div>
          <label for="amount" class="block font-medium mb-1">Registration Payment (Birr)</label>
          <input type="text" id="amount" value="<?php echo $amount; ?>" readonly
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed">
        </div>

        <p class="text-green-600 text-sm mt-4 text-center">✅ Please pay this amount during registration.</p>
      <?php } else { ?>
        <p class="text-red-600 text-center text-sm">❌ No billing rate is set. Please contact the registrar office.</p>
      <?php } ?>
    </form>

    <div class="mt-6 text-center">
      <a href="student.php"
         class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition duration-200">
        🔙 <span class="underline ml-1">Back to Student Home Page</span>
      </a>
    </div>
  </div>

</body>
</html>

<?php
$stmt->close();
?>
