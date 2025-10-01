<?php
require_once 'db_connect.php';
session_start();

// clear any old messages
$_SESSION['error_message'] = "";
$_SESSION['success_message'] = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username_input   = htmlspecialchars(trim($_POST['username'] ?? ''));
    $first_name_input = htmlspecialchars(trim($_POST['first-name'] ?? ''));
    $last_name_input  = htmlspecialchars(trim($_POST['last-name'] ?? ''));
    $email_input      = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);

    $password_input   = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';
    $privacy_policy   = isset($_POST['privacy-policy']);

    // Blocked usernames
    $blocked = ["admin", "administrator", "root"];

    // ✅ CAPTCHA CHECK
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $secretKey = '6Le8FNsrAAAAAN8m39JF-6rGXd9NKfXCPhhP6ZUP';
        $verifyResponse = file_get_contents(
            'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $_POST['g-recaptcha-response']
        );
        $response = json_decode($verifyResponse);

        // ✅ If Google reCAPTCHA API returned success
        if ($response && $response->success) {

            // 🔐 Validation checks
            if (!$privacy_policy) {
                $_SESSION['error_message'] = "You must agree to the Privacy Policy before signing up.";
            } elseif (empty($username_input) || empty($first_name_input) || empty($last_name_input) || empty($email_input) || empty($password_input) || empty($confirm_password)) {
                $_SESSION['error_message'] = "All fields are required.";
            } elseif (!filter_var($email_input, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_message'] = "Invalid email address.";
            } elseif (in_array(strtolower($username_input), $blocked)) {
                $_SESSION['error_message'] = "Unable to use this username. Please choose a different username.";
            } elseif (
                strlen($password_input) < 8 ||
                !strpbrk($password_input, "ABCDEFGHIJKLMNOPQRSTUVWXYZ") ||
                !strpbrk($password_input, "abcdefghijklmnopqrstuvwxyz") ||
                !strpbrk($password_input, "0123456789") ||
                !strpbrk($password_input, "!@#$%^&*()-_=+[]{};:'\",.<>?/|\\`~")
            ) {
                $_SESSION['error_message'] = "Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.";
            } elseif ($password_input !== $confirm_password) {
                $_SESSION['error_message'] = "Passwords do not match.";
            } else {
                // ✅ DB check & insert
                try {
                    $stmt = $pdo->prepare("SELECT ID FROM users WHERE username = :username OR email = :email");
                    $stmt->execute([':username' => $username_input, ':email' => $email_input]);

                    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                        $_SESSION['error_message'] = "Username or Email already exists.";
                    } else {
                        $hashed_password = password_hash($password_input, PASSWORD_DEFAULT);

                        $insert = $pdo->prepare(
                            "INSERT INTO users (username, password, first_name, last_name, email)
                            VALUES (:username, :password, :first_name, :last_name, :email)"
                        );

                        $insert->execute([
                            ':username'   => $username_input,
                            ':password'   => $hashed_password,
                            ':first_name' => $first_name_input,
                            ':last_name'  => $last_name_input,
                            ':email'      => $email_input
                        ]);

                        $_SESSION['success_message'] = "Registration successful! You can now log in.";
                    }
                } catch (PDOException $e) {
                    $_SESSION['error_message'] = "Database error: " . $e->getMessage();
                }
            }

        } else {
            // error if API returned failure
            $_SESSION['error_message'] = "reCAPTCHA verification failed. Please try again.";
        }

    } else {
        //  error if CAPTCHA not filled in
        $_SESSION['error_message'] = "Please complete the reCAPTCHA before submitting.";
    }
}

// Always load signup page
include 'signup-page.php';
