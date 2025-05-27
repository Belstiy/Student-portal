<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage User Account</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function navigateTo(page) {
      window.location.href = page;
    }
  </script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

  <header class="bg-blue-700 text-white py-6 shadow-md text-center">
    <h1 class="text-3xl font-bold">User Account Management</h1>
  </header>

  <div class="flex flex-1">
    <!-- Sidebar with buttons -->
    <div class="w-64 bg-blue-800 text-white p-4 flex flex-col space-y-4">
      <button onclick="navigateTo('user_registration.php')" 
              class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 shadow text-left">
        Add Account
      </button>
      <button onclick="navigateTo('update_account.php')" 
              class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 shadow text-left">
        Update User Account
      </button>
      <button onclick="navigateTo('view_individual_user.php')" 
              class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 shadow text-left">
        View Individual User
      </button>
      <button onclick="navigateTo('view_all_users.php')" 
              class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 shadow text-left">
        View All Users
      </button>
      <button onclick="navigateTo('delete_account.php')" 
              class="w-full bg-red-600 hover:bg-red-500 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 shadow text-left">
        Delete User Account
      </button>
      <div class="mt-auto">
        <a href="admin.php" 
           class="w-full block bg-gray-600 hover:bg-gray-500 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 shadow text-left">
          ← Back to Admin
        </a>
      </div>
    </div>

    <!-- Main content area with descriptions -->
    <div class="flex-1 p-8 bg-white">
      <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-semibold text-blue-800 mb-6">User Account Management Functions</h2>
        
        <div class="space-y-8">
          <div class="p-4 bg-blue-50 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-700 mb-2">Add Account</h3>
            <p class="text-gray-700">Create new user accounts for students, teachers, or administrators. Specify user roles, permissions, and initial login credentials.</p>
          </div>
          
          <div class="p-4 bg-blue-50 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-700 mb-2">Update User Account</h3>
            <p class="text-gray-700">Modify existing user information including personal details, contact information, account status, and access privileges.</p>
          </div>
          
          <div class="p-4 bg-blue-50 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-700 mb-2">View Individual User</h3>
            <p class="text-gray-700">Access complete profile information for a specific user, including account activity, login history, and associated records.</p>
          </div>
          
          <div class="p-4 bg-blue-50 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-700 mb-2">View All Users</h3>
            <p class="text-gray-700">Browse and search through all registered users with filtering options by role, status, or other criteria.</p>
          </div>
          
          <div class="p-4 bg-red-50 rounded-lg border-l-4 border-red-400">
            <h3 class="text-lg font-semibold text-red-700 mb-2">Delete User Account</h3>
            <p class="text-gray-700">Permanently remove user accounts from the system. This action is irreversible and should be used with caution.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg-gray-200 text-center py-4 text-sm">
    <p>&copy; 2025 Hailemariam Mamo School. All rights reserved.</p>
  </footer>

</body>
</html>