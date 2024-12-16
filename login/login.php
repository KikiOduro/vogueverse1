<!-- login form and validation regex -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Chore Management Systems</title>
    <link rel="stylesheet" href="../layout/styles/adminstyle.css">
    <link rel="stylesheet" href="../layout/styles/parsley.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
</head>

<body>
    <div class="flex container items-center justify-center">
        <div class="flex flex-column items-center justify center auth-box gap-5">

            <h2>Sign In</h2>

            <?php if (isset($_GET['msg'])) : ?>
                <div class='error' style="display: <?php echo $_GET['msg'] != NULL? "block" : "none"; ?> "> <p style="color: red"> Invalid credentials. Try again!</p></div>
            <?php endif; ?>

            <form action="../actions/login_user.php" class="w-full flex flex-column gap-4" method="POST" data-parsley-validate>
                <div class="flex flex-column w-full">
                    <input type="email" placeholder="Email" name="email" data-parsley-required="true" data-parsley-trigger="keyup" data-parsley-error-message="Invalid email">
                </div>
                <div class="flex flex-column w-full">
                    <input type="password" placeholder="Password" name="password" data-parsley-minlength="6" data-parsley-minlength-message="password must be at least 6 characters" data-parsley-required="true">
                </div>

                <span class="text-right text-sm"><a href="">Forgot password?</a></span>

                <button type="submit" class="auth-button" name="login">Sign In</button>
                <span class="text-center text-sm">Don't have an account?<a href="register.php"> Sign up!</a></span>

            </form>
        </div>
    </div>
</body>

</html>