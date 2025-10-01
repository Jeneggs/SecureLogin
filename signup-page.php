<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="./signup-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function enableSubmitBtn() {
            document.getElementById("mySubmitBtn").disabled = false;
        }
    </script>
</head>

<body>
    <?php require_once "heading.html"; ?>

    <?php if (!empty($_SESSION['error_message'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error_message'];
            unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['success_message'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success_message'];
            unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>



    <div class="full-container">
        <div class="signup-container">
            <div class="signup-header">
                <h2>Sign Up</h2>
            </div>
            <div class="registration-form">
                <form action="signup.php" method="POST">

                    <div class="username-field input-group mb-3">
                        <input type="text" class="username-field form-control" id="username" name="username"
                            placeholder="Username" aria-label="username" aria-describedby="basic-addon1" maxlength="20"
                            minlength="5" required>
                    </div>

                    <div class="first-name-field input-group mb-3">
                        <input type="text" class="first-name-field form-control" name="first-name"
                            placeholder="First Name" aria-label="First Name" maxlength="15" minlength="3" required>
                        <span class="input-group-text"> </span>
                        <input type="text" class="first-name-field form-control" name="last-name"
                            placeholder="Last Name" aria-label="Last Name" maxlength="15" minlength="3" required>
                    </div>

                    <div class="email-field input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="email-field form-control" id="email" name="email" placeholder="Email"
                            aria-label="username" aria-describedby="basic-addon1" maxlength="65" minlength="6" required>
                    </div>

                    <div class="phone-number-field input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">+63</span>
                        <input type="tel" class="phone-number-field form-control" id="phone-number" name="phone-number"
                            placeholder="Phone Number" aria-label="Phone Number" aria-describedby="basic-addon1"
                            pattern="\d{10}" maxlength="10" required>
                    </div>

                    <div class="password-field input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">*</span>
                        <input type="password" class="password-field form-control" id="password" name="password"
                            placeholder="Password" aria-label="Password" aria-describedby="basic-addon1"minlength="8" maxlength="25" required>
                    </div>

                    <div class="confirm-password-field input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">*</span>
                        <input type="password" class="confirm-password-field form-control" id="confirm-password"
                            name="confirm-password" placeholder="Confirm password" aria-label="Password"
                            aria-describedby="basic-addon1" minlength="8" maxlength="25" required>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="privacy-policy" id="privacy-policy"
                            required>
                        <label class="form-check-label" for="privacy-policy">
                            I agree to the <a href="privacy-policy.php" target="_blank">Privacy Policy</a>
                        </label>
                    </div>
                    <!-- Google reCAPTCHA -->
                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="6Le8FNsrAAAAAKSPhSMRcohOit1rZb4awy1WsB7o" data-callback="enableSubmitBtn"></div>
                    </div>
                    <div class="submit-button">
                        <button type="submit" class="btn btn-danger">Register</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


</body>

</html>