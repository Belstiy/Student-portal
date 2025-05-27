<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html>
<head><title>All Users</title>
<style>
  body {
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
    background-color: #f4f4f4;
  }

  table {
    width: 80%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  th, td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
  }

  th {
    background-color: #007bff;
    color: white;
  }

  td {
    background-color: #f9f9f9;
  }

  a {
    display: inline-block;
    padding: 10px 15px;
    margin-top: 15px;
    text-decoration: none;
    background-color: #28a745;
    color: white;
    border-radius: 4px;
    font-weight: bold;
  }

  a:hover {
    background-color: #218838;
  }
</style>
</head>
<body>
<h2>All Users</h2>

<table border="1" cellpadding="5">
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Username</th>
  <th>Sex</th>
  <th>Role</th>
  <th>Status</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM users");

while ($row = $result->fetch_assoc()) {
  echo "<tr>
    <td>{$row['user_id']}</td>
    <td>{$row['first_name']} {$row['last_name']}</td>
    <td>{$row['username']}</td>
    <td>{$row['sex']}</td>
    <td>{$row['role']}</td>
    <td>{$row['status']}</td>
  </tr>";
}
$conn->close();
?>
</table>
</div>
        <a href="manage_user_account.php">Close Page</a>
    </div>
</body>
</html>
