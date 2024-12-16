<!-- register code goes here -->

<?php
include("../functions/select_role.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Chore Management Systems</title>
    <link rel="stylesheet" href="../layout/styles/adminstyle.css">
    <link rel="stylesheet" href="../layout/styles/parsley.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
</head>

<body>
    <div class="flex container items-center justify-center">
        <div class="flex flex-column items-center justify center auth-box gap-5">

            <h2>Sign Up</h2>

            <form action="../actions/register_user.php" class="w-full flex flex-column gap-4" method="POST" data-parsley-validate>
                <div class="flex items-center gap-4 w-full flex-wrap">
                    <input type="text" placeholder="First name" name="fname" data-parsley-required="true" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-error-message="Invalid first name">
                    <input type="text" placeholder="Last name" name="lname" data-parsley-required="true" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-error-message="Invalid last name">
                </div>
                <select name="gender" id="gender" data-parsley-required="true">
                    <option selected value="">Select gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
                <div class="flex items-center gap-4 w-full">
                    <input type="date" placeholder="Date of birth" name="dob" data-parsley-required="true">
                    <input type="tel" placeholder="Phone number" name="phone" data-parsley-required="true" data-parsley-pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.0-9]*$" data-parsley-error-message="Invalid phone number">
                    </div>
                <div class="flex flex-column w-full">
                    <input type="email" placeholder="Email" name="email" data-parsley-required="true" data-parsley-trigger="keyup" data-parsley-error-message="Invalid email">
                </div>
                <div class="flex flex-column w-full">
                    <input type="password" placeholder="Password" name="password" data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-minlength-message="password must be at least 6 characters" data-parsley-required="true">
                </div>

                <button class="auth-button" name="register" type="submit">Create account</button>
                <span class="text-center text-sm">Already have an account?<a href="login.php"> Sign in!</a></span>

            </form>
        </div>

        <?php if (isset($_GET['msg'])) : ?>
            <div class='flash-data' data-id="<?php echo $_GET['msg']; ?>"></div>
        <?php endif; ?>
    </div>
    <script>
        if ($(".flash-data").data("id") == 'success') {
            Swal.fire({
                icon: 'success',
                type: 'success',
                title: 'Account created',
                text: 'Your account is registered successfully!',

            }).then(function() {
                window.location.href = 'login.php';
            });
        } else if ($(".flash-data").data("id") == 'error') {
            Swal.fire({
                icon: 'error',
                type: 'error',
                title: 'Something went wrong!',
                text: 'Try again!',

            })
        }
    </script>
</body>

</html>