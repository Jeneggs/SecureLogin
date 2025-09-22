<?php
require_once 'db_connect.php';
session_start();

$error_message = "";
$success_message = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    
    $username_input   = htmlspecialchars($_POST['username']);
    $first_name_input = htmlspecialchars($_POST['first-name']);
    $last_name_input  = htmlspecialchars($_POST['last-name']);
    $email_input      = htmlspecialchars($_POST['email']);
    $password_input   = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm-password']);

    
    if ($password_input !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        
        $stmt = $pdo->prepare("SELECT ID FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username_input);
        $stmt->bindParam(':email', $email_input);
        $stmt->execute();

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $error_message = "Username or Email already exists.";
        } else {
            
            $hashed_password = password_hash($password_input, PASSWORD_DEFAULT);

            
            $stmt = $pdo->prepare("INSERT INTO users (username, password, first_name, last_name, email) 
                                    VALUES (:username, :password, :first_name, :last_name, :email)");
            $stmt->bindParam(':username', $username_input);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':first_name', $first_name_input);
            $stmt->bindParam(':last_name', $last_name_input);
            $stmt->bindParam(':email', $email_input);

            if ($stmt->execute()) {
                $success_message = "Registration successful! You can now log in.";
            } else {
                $error_message = "Something went wrong. Please try again.";
            }
        }
    }
}


include 'signup-page.php';
?>
