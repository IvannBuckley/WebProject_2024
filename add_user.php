<?php
<<<<<<< .merge_file_pjyNP9
include 'db.php';

session_start();

// Check if the logged-in user is an admin
if ($_SESSION['role'] !== 'Admin') {
    echo "You do not have permission to add new users.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form handling logic as above
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $role = htmlspecialchars(trim($_POST['role']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "User with this email already exists.";
        exit;
    }

    // Password validation using regular expression
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        echo "Password must be at least 8 characters long, contain at least one number, one lowercase letter, and one uppercase letter.";
        exit;
=======
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'dolphin_crm');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Input sanitization
    $first_name = htmlspecialchars(trim($_POST['firstname']));
    $last_name = htmlspecialchars(trim($_POST['lastname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Password validation
    $password_regex = '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/';
    if (!preg_match($password_regex, $password)) {
        die("Password must be at least 8 characters long, contain one uppercase letter, one lowercase letter, and one number.");
>>>>>>> .merge_file_XS3MZ7
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

<<<<<<< .merge_file_pjyNP9
    try {
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, role) VALUES (:firstname, :lastname, :email, :password, :role)");
        $stmt->bindParam(':firstname', $first_name);
        $stmt->bindParam(':lastname', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            // Redirect to dashboard
            header("Location: dashboard.php"); 
            exit;
        } else {
            echo "Failed to add user.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add User</title>
        <link rel="stylesheet" href="user_styles.css"> 
    </head>
    <body>
    <button onclick="window.location.href='dashboard.php'">Dashboard</button>
        <h1>Add a New User</h1>
        <form method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" placeholder="First Name" required><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" placeholder="Last Name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required><br>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="Admin">Admin</option>
                <option value="Member">Member</option>
            </select><br><br>

            <button type="submit">Add User</button>
        </form>
    </body>
    </html>
    <?php
=======
    // Insert user into the database
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        echo "User added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
>>>>>>> .merge_file_XS3MZ7
}
?>
