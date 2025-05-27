<?php ?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Course Home Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#eef2f5] min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full text-center">
        <h1 class="text-2xl font-bold text-[#009dc4] mb-6">Manage Course Home Page</h1>
        <div class="space-y-4">
            <span class="block text-[#009dc4] font-medium hover:underline cursor-pointer" onclick="window.location.href='add_course.php'">➕ Add Courses</span>
            <span class="block text-[#009dc4] font-medium hover:underline cursor-pointer" onclick="window.location.href='update_course.php'">✏️ Update Courses</span>
            <span class="block text-[#009dc4] font-medium hover:underline cursor-pointer" onclick="window.location.href='view_course.php'">📄 View Courses</span>
            <span class="block text-[#009dc4] font-medium hover:underline cursor-pointer" onclick="window.location.href='view_all_course.php'">📚 View All Courses</span>
            <span class="block text-[#009dc4] font-medium hover:underline cursor-pointer" onclick="window.location.href='delete_course.php'">🗑️ Delete Courses</span>
            <span class="block bg-[#009dc4] text-white rounded-md py-2 px-4 font-medium hover:bg-[#007fa3] cursor-pointer mt-6" onclick="window.location.href='Department_Head.php'">🔙 Back to Department Head</span>
        </div>
    </div>

</body>
</html>
