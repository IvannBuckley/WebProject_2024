<?php
include('db.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // check if user is in database
    $sql = "SELECT * FROM `users` WHERE `email` = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If user exists
    if ($user) {
        if (hash('sha256', $password) === $user['password']) {
            // if password is correct, start session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['role'] = $user['role'];

            // Send success response
            echo json_encode(['success' => true]);
            exit;
        } else {
            // Invalid password, send response for JavaScript
            echo json_encode(['error' => 'Invalid password!']);
            exit;
        }
    } else {
        // No user found, send response for JavaScript
        echo json_encode(['error' => 'No user found with that email!']);
        exit;
    }
}
?>
