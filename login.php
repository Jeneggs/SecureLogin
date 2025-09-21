<?php
require_once 'db_connect.php';
session_start();


$user_name_input = htmlspecialchars($_POST['username']);
$password_input = htmlspecialchars($_POST['password']);

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindParam(':username', $user_name_input);
$stmt->execute();

?>

