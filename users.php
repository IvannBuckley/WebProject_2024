<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'dolphin_crm');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users
$result = $conn->query("SELECT firstname, lastname, email, role, created_at FROM users ORDER BY created_at DESC");

echo "<h1>User List</h1>";
echo "<table border='1'>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['firstname']} {$row['lastname']}</td>
            <td>{$row['email']}</td>
            <td>{$row['role']}</td>
            <td>{$row['created_at']}</td>
          </tr>";
}

echo "</table>";

$conn->close();
?>
