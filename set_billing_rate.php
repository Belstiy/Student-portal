<?php
include 'db_connection.php';

$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = $_POST['year'];
    $amount = $_POST['amount'];

    // Ensure only one row exists by deleting old records
    $delete_old = $conn->prepare("DELETE FROM billing_rates");
    $delete_old->execute();

    // Insert the new billing rate (single-row constraint)
    $stmt = $conn->prepare("INSERT INTO billing_rates (year, amount) VALUES (?, ?)");
    $stmt->bind_param("id", $year, $amount);
    $stmt->execute();

    $successMessage = "✅ Billing amount set for $year and updated.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Set Billing Rate</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Set/Update Billing Rate</h2>

    <?php if (!empty($successMessage)): ?>
      <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
        <?= htmlspecialchars($successMessage) ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
      <div>
        <label for="year" class="block text-sm font-medium text-gray-700">Academic Year:</label>
        <input type="number" id="year" name="year" value="<?= date('Y') ?>" required
               class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
      </div>

      <div>
        <label for="amount" class="block text-sm font-medium text-gray-700">Billing Amount (Birr):</label>
        <input type="number" id="amount" name="amount" step="0.01" required
               class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-150">
        Save Billing Rate
      </button>
    </form>

    <div class="mt-6 text-center">
      <a href="admin.php" class="text-blue-600 hover:underline font-medium">← Back to Admin Home Page</a>
    </div>
  </div>
</body>
</html>
