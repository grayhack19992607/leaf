<?php
include 'includes/session.php';

if (isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    // Validation
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($repassword)) {
        $_SESSION['error'] = 'All fields are required.';
    } elseif ($password != $repassword) {
        $_SESSION['error'] = 'Passwords did not match.';
    } else {
        $conn = $pdo->open();

        // Check if the email is already taken
        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        if ($row['numrows'] > 0) {
            $_SESSION['error'] = 'Email already taken.';
        } else {
            // Hash the password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user into the database
            $now = date('Y-m-d');
            try {
                $stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, created_on) VALUES (:email, :password, :firstname, :lastname, :now)");
                $stmt->execute(['email' => $email, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'now' => $now]);

                // Get the last inserted ID
                $userid = $conn->lastInsertId();

                $_SESSION['success'] = 'Account created successfully.';
                header('location: login.php'); // Redirect to the login page
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'An error occurred while creating your account: ' . $e->getMessage();
            }
        }
    }

    header('location: signup.php'); // Redirect back to the signup page in case of errors
}
?>
