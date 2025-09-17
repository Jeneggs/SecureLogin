<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="Username">Username:</label>
        <input type="text" id="Username" name="Username" required>
        <br>

        <label for="Password">Password:</label>
        <input type="password" id="Password" name="Password" required>
        <br>

        <button type="submit">Login</button>
        <button type="submit">Sign Up</button>
    </form>

</body>
</html>