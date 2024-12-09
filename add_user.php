<?php
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
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

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
}
?>
