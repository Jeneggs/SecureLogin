<?php require_once 'db_connect.php' ;

$username_input = "";
$password_input = "";


$error_message = "";
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
    session_write_close();
}


// Only assign values if form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username_input = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : "";
    $password_input = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : "";
}
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="login-style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body>
        <?php require_once "heading.html"; ?>
        <div class="full-container">
            <div class="welcome-screen">
                <h1>Welcome</h1>
                <h1>Back</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi, architecto.</p>
            </div>
            <div class="login-form">
                <h1>Sign in</h1>
                <form action="login.php" method="POST">
                    <div class="username-field input-group mb-3">
                        <input type="text" class="username-field form-control" id="username" name="username"
                            placeholder="Username" aria-label="username" aria-describedby="basic-addon1" maxlength="25" minlength="5" required>
                    </div>

                    <div class="password-field input-group mb-3">
                        <input type="password" class="password-field form-control" id="password" name="password"
                            placeholder="Password" aria-label="Password" aria-describedby="basic-addon1"  minlength="8" maxlength="25" required>
                    </div>

                    <div class="login-button-container">
                        <?php if (!empty($error_message)): ?>
                            <div role="alert">
                                <p class="text-danger"><?php echo htmlspecialchars($error_message); ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="login-button-container d-flex gap-2">
                            <button type="submit" class="login-button btn btn-danger">Login</button>
                            <a href="signup-page.php" class="login-button btn btn-danger">Sign Up</a>
                        </div>
                    </div>
                    <?php  ?>
                </form>
            </div>

        </div>
        </div>

    </body>

    </html>