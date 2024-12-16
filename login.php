<?php
include('db.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user is in database
    $sql = "SELECT * FROM `users` WHERE `email` = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if user exists
    if ($user) {
<<<<<<< .merge_file_bu9KTJ
        // If the user is the special admin account
        if ($email === 'admin@project2.com') {
            // Verify using SHA256
            if (hash('sha256', $password) === $user['password']) {
                // Successful login for admin
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['role'] = $user['role'];
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'Invalid admin password!']);
            }
=======
        if (hash('sha256', $password) === $user['password']) {
            // if password is correct start session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['role'] = $user['role'];
            header('Location: add_user.html');
            echo json_encode(['success' => true]);

>>>>>>> .merge_file_f7iMD9
        } else {
            // For all other users, verify with password_hash
            if (password_verify($password, $user['password'])) {
                // Successful login for regular users
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['role'] = $user['role'];
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'Invalid password!']);
            }
        }
    } else {
        echo json_encode(['error' => 'No user found with that email!']);
    }
}
   
