<?php
require_once 'db_connect.php';
session_start();


//Sanitize user input to prevent XSS
$username_input = htmlspecialchars($_POST['username']);
$password_input = htmlspecialchars($_POST['password']);
$error_message = "";

//Prepared statement to prevent SQL injection
$stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
$stmt->bindParam(':username', $username_input);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

//Checks if username is in the database and verifies the password


if ($user){
    if(password_verify($password_input, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo "Login successful. Welcome, " .
        htmlspecialchars($user['username']) . "!";
    }
    else {
        $_SESSION['error_message'] = "Incorrect password, try again.";
    }
}
else {
    $_SESSION['error_message'] = "Incorrect username, try again";
}
include 'login-page.php';
?>
