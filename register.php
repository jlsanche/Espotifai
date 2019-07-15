<?php
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");
$account = new Account($con);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name)
{

    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>
<html>
<html>

<head>
    <title>Welcome to Espotify</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>

</head>

<body>


    <?php

    if (isset($_POST['registerButton'])) {
        echo '<script>

        $(document).ready(function () {
         
        
            $("#loginForm").hide();
            $("#registerForm").show();
        
        });
            
        </script>';
    } else {

        echo '<script>

        $(document).ready(function () {
         
        
            $("#loginForm").show();
            $("#registerForm").hide();
        
        });
            
        </script>';
    }

    ?>

    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">

                <form id="loginForm" action="register.php" method="POST">

                    <h2>Login to your account</h2>

                    <p>
                        <?php echo $account->getError(Constants::$loginFailed); ?>

                        <label for="loginUsername">Username</label>
                        <input type="text" id="loginUsername" name="loginUsername" placeholder="user name" value="<?php getInputValue('loginUsername') ?>" required>
                    </p>

                    <p>
                        <label for="loginPassword">Password </label>
                        <input type="password" id="loginPassword" name="loginPassword" placeholder="password" required>
                    </p>

                    <button type="submit" name="loginButton">Login</button>

                    <div class="hasAccountText"> <span id="hideLogin"> Dont have an account yet? Sign up here.</span> </div>


                </form>

                <form id="registerForm" method="POST">

                    <h2>Create your free account</h2>

                    <p>
                        <?php echo $account->getError(Constants::$usernameCharacters);
                        echo $account->getError(Constants::$usernameTaken); ?>

                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="username" value="<?php getInputValue('username') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                        <label for="firstName">First name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="first name" value="<?php getInputValue('firstName') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                        <label for="lastName">Last name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="last name" value="<?php getInputValue('lastName') ?>" required>
                    </p>

                    <p>

                        <?php echo $account->getError(Constants::$emailsDontMatch);
                        echo $account->getError(Constants::$emailIsInvalid);
                        echo $account->getError(Constants::$emailTaken);
                        ?>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="email" value="<?php getInputValue('email') ?>" required>
                    </p>

                    <p>
                        <label for="confirmEmail"> Confirm Email</label>
                        <input type="email" id="confirmEmail" name="confirmEmail" placeholder="confirm email" value="<?php getInputValue('confirmEmail') ?>" required>
                    </p>

                    <p>

                        <?php echo $account->getError(Constants::$passwordsDoNotMatch);
                        echo $account->getError(Constants::$passwordNotAlphaNumeric);
                        echo $account->getError(Constants::$passwordCharacters);
                        ?>

                        <label for="password">Password </label>
                        <input type="password" id="password" name="password" placeholder="password" required>
                    </p>

                    <p>
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="confirm password" required>
                    </p>

                    <button type="submit" name="registerButton">Sign Up </button>

                    <div class="hasAccountText"> <span id="hideRegister">Already have an account? Log in here.</span> </div>

                </form>

            </div>

            <div id="loginText">

                <h1>Get Crunchy Tunes</h1>
                <h2>Listen to full length songs free of charge </h2>
                <ul>
                    <li>Discover all of your favorite jams</li>
                    <li>*All songs in Russian language</li>

                </ul>

            </div>

        </div>
    </div>

</body>

</html>