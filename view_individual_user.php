<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Individual User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e',
            }
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

  <header class="bg-primary-700 text-white py-6 shadow-md text-center">
    <h1 class="text-3xl font-bold">User Management System</h1>
  </header>

  <div class="flex flex-1">
    <!-- Sidebar with buttons -->
    <div class="w-64 bg-primary-800 text-white p-4 flex flex-col">
      <button onclick="window.location.href='manage_user_account.php'" 
              class="w-full bg-primary-600 hover:bg-primary-500 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 shadow text-left mb-4">
        🔙 Back to User Management
      </button>
      
      <div class="mt-auto p-4 bg-primary-900 rounded-lg">
        <h3 class="font-semibold mb-2">Quick Actions</h3>
        <button onclick="document.forms[0].submit()" 
                class="w-full bg-green-600 hover:bg-green-500 text-white font-semibold py-2 px-4 rounded transition duration-300 text-left text-sm">
          🔍 Search Again
        </button>
      </div>
    </div>

    <!-- Main content area -->
    <div class="flex-1 p-8 bg-white">
      <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-primary-700 mb-6">View User by ID</h2>
        
        <form method="GET" action="" class="bg-primary-50 rounded-xl p-6 mb-8 border border-primary-200">
          <div class="flex items-end gap-4">
            <div class="flex-1">
              <label class="block text-primary-800 font-medium mb-2">Enter User ID</label>
              <input type="text" name="user_id" required 
                     class="w-full border border-primary-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500">
            </div>
            <button type="submit" 
                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300 shadow">
              Search
            </button>
          </div>
        </form>

        <?php if (isset($_GET['user_id'])): ?>
          <?php
          $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
          $stmt->bind_param("i", $_GET['user_id']);
          $stmt->execute();
          $result = $stmt->get_result();
          ?>

          <?php if ($result->num_rows == 1): ?>
            <?php $user = $result->fetch_assoc(); ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-primary-200">
              <div class="bg-primary-700 text-white px-6 py-4">
                <h3 class="text-xl font-bold">User Details</h3>
              </div>
              
              <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                  <div>
                    <span class="block text-sm font-medium text-primary-700">User ID</span>
                    <span class="text-lg font-semibold"><?= $user['user_id'] ?></span>
                  </div>
                  
                  <div>
                    <span class="block text-sm font-medium text-primary-700">Full Name</span>
                    <span class="text-lg font-semibold"><?= $user['first_name'] ?> <?= $user['last_name'] ?></span>
                  </div>
                  
                  <div>
                    <span class="block text-sm font-medium text-primary-700">Gender</span>
                    <span class="text-lg font-semibold"><?= $user['sex'] ?></span>
                  </div>
                </div>
                
                <div class="space-y-4">
                  <div>
                    <span class="block text-sm font-medium text-primary-700">Username</span>
                    <span class="text-lg font-semibold"><?= $user['username'] ?></span>
                  </div>
                  
                  <div>
                    <span class="block text-sm font-medium text-primary-700">Role</span>
                    <span class="text-lg font-semibold capitalize"><?= $user['role'] ?></span>
                  </div>
                  
                  <div>
                    <span class="block text-sm font-medium text-primary-700">Status</span>
                    <span class="text-lg font-semibold capitalize <?= $user['status'] == 'active' ? 'text-green-600' : 'text-red-600' ?>">
                      <?= $user['status'] ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          <?php else: ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 text-red-700">
              <p>❌ User not found with ID: <?= htmlspecialchars($_GET['user_id']) ?></p>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php $conn->close(); ?>
</body>
</html>