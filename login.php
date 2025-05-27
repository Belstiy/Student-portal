<?php
// Database connection and login processing
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    include 'db_connection.php';

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if ($user['password'] === $password) {
            if ($user['status'] === 'active') {
                // Redirect based on role without using sessions
                $role = strtolower($user['role']);
                
                // Map role names to correct PHP files
                $role_mapping = [
                    'registral' => 'registeral',
                    'admin' => 'admin',
                    'teacher' => 'teacher',
                    'student' => 'student'
                ];
                
                // Get the base filename or use the role name if not in mapping
                $base_filename = $role_mapping[$role] ?? $role;
                $redirect_page = $base_filename . '.php';
                
                if (file_exists($redirect_page)) {
                    header("Location: $redirect_page");
                    exit();
                } else {
                    $error = "Role page not found: $redirect_page";
                }
            } else {
                $error = "Your account is " . $user['status'] . ". Contact admin.";
            }
        } else {
            $error = "Incorrect password for " . htmlspecialchars($username);
        }
    } else {
        $error = "Username not found: " . htmlspecialchars($username);
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Hailemariam Mamo SMS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
      min-height: 100vh;
    }
    .gradient-text {
      background: linear-gradient(90deg, #0ea5e9 0%, #22c55e 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
  </style>
</head>
<body class="flex flex-col">

<!-- Navigation -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 py-3">
    <div class="flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center space-x-3">
        <img src="uploads/logo.png" alt="Logo" class="h-12 w-12 rounded-full border-2 border-blue-600 shadow-lg">
        <span class="font-bold text-xl sm:text-2xl gradient-text tracking-wide">HAILEMARIAM MAMO</span>
      </div>

      <!-- Desktop Links -->
      <div class="hidden lg:flex items-center space-x-8">
        <a href="index.php" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium text-lg">Home</a>
        <a href="about_us.php" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium text-lg">About Us</a>
        <a href="contactus.php" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium text-lg">Contact Us</a>
        <a href="feedback.php" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium text-lg">Feedback</a>
        <a href="login.php" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-green-500 text-white rounded-full font-semibold shadow-lg hover:shadow-xl transition duration-300">Login</a>
      </div>

      <!-- Mobile Toggle -->
      <div class="lg:hidden">
        <button id="menu-btn" class="focus:outline-none text-gray-700 hover:text-blue-600 transition">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden py-4 space-y-4">
      <a href="index.php" class="block py-2 px-4 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition font-medium">Home</a>
      <a href="about_us.php" class="block py-2 px-4 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition font-medium">About Us</a>
      <a href="contactus.php" class="block py-2 px-4 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition font-medium">Contact Us</a>
      <a href="feedback.php" class="block py-2 px-4 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition font-medium">Feedback</a>
      <a href="login.php" class="block py-2 px-4 rounded-lg bg-blue-600 text-white font-semibold text-center">Login</a>
    </div>
  </div>
</nav>

<!-- Main Content -->
<main class="flex-grow flex items-center justify-center p-4">
  <div class="max-w-md w-full">
    <!-- Login Card -->
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
      <!-- Card Header -->
      <div class="bg-gradient-to-r from-blue-600 to-green-500 p-6 text-center">
        <h2 class="text-3xl font-bold text-white">Welcome Back</h2>
        <p class="text-blue-100 mt-2">Login to access your account</p>
      </div>
      
      <!-- Card Body -->
      <div class="p-8">
        <?php if (isset($error)): ?>
          <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
            <p><?php echo $error; ?></p>
          </div>
        <?php endif; ?>
        
        <form method="POST" class="space-y-6">
          <div class="space-y-1">
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-user text-gray-400"></i>
              </div>
              <input type="text" name="username" id="username" required
                     class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                     placeholder="Enter your username"
                     value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>
          </div>
          
          <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-gray-400"></i>
              </div>
              <input type="password" name="password" id="password" required
                     class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                     placeholder="Enter your password">
              <button type="button" id="togglePassword" class="absolute right-3 top-3 text-gray-500 hover:text-blue-600 transition">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>
          
          <div>
            <button type="submit" name="login" class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<footer class="bg-white border-t border-gray-200">
  <div class="max-w-7xl mx-auto px-6 py-6 text-center">
    <p class="text-gray-600">&copy; 2025 Hailemariam Mamo Preparatory School. All rights reserved.</p>
  </div>
</footer>

<script>
  // Mobile menu toggle
  document.getElementById("menu-btn").addEventListener("click", function() {
    const menu = document.getElementById("mobile-menu");
    menu.classList.toggle("hidden");
  });

  // Password visibility toggle
  const togglePassword = document.getElementById("togglePassword");
  const password = document.getElementById("password");
  
  togglePassword.addEventListener("click", function() {
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    this.innerHTML = type === "password" ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
  });
</script>
</body>
</html>