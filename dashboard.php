<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="#">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <button onclick="window.location.href='logout.php'">Logout</button>

    <main>
        <?php
        // load content based on 'page' query parameter
        if (isset($_GET['page'])) {
            if ($_GET['page'] === 'add_user') {
                include 'add_user.php'; // Add User form
            } elseif ($_GET['page'] === 'view_users') {
                include 'view_users.php'; // View User page
            }
        } else {
            echo "<p>Dashboard!</p>";
            echo '<button onclick="window.location.href=\'?page=add_user\'">Add User</button>';
            echo '<button onclick="window.location.href=\'?page=view_users\'">View User</button>';
        }
        ?>
    </main>
</body>
</html>
