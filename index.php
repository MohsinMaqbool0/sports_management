<?php
ob_start();
session_start();
if (isset($_SESSION['valid-user'])) {
    header("location:dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            background: radial-gradient(ellipse at center, rgba(255, 254, 234, 1)) 0%, rgba(255, 254, 234, 1) 35%, #B7E8EB 100%;
            overflow: hidden;
        }

        .ocean {
            height: 5%;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            background: #015871;
        }

        .wave {
            background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/85486/wave.svg) repeat-x;
            position: absolute;
            top: -198px;
            width: 6400px;
            height: 198px;
            animation: wave 5s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
            transform: translate3d(0, 0, 0);
        }

        .wave:nth-of-type(2) {
            top: -175px;
            animation: wave 7s cubic-bezier(0.36, 0.45, 0.63, 0.53) -.125s infinite, swell 7s ease -1.25s infinite;
            opacity: 1;
        }

        @keyframes wave {
            0% {
                margin-left: 0;
            }

            100% {
                margin-left: -1600px;
            }
        }

        @keyframes swell {

            0%,
            100% {
                transform: translate3d(0, -25px, 0);
            }

            50% {
                transform: translate3d(0, 5px, 0);
            }
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: -20px 0 50px;
            margin-top: 20px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #0e263d;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        .container {
            background: #fff;
            border-radius: 90px;
            box-shadow: 30px 14px 28px rgba(0, 0, 5, 0.2), 0 10px 10px rgba(0, 0, 5, 0.2);
            position: relative;
            overflow: hidden;
            opacity: 85%;
            width: 650px;
            max-width: 100%;
            min-height: 480px;
            transition: 333ms;
        }

        .form-container form {
            background: #fff;
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .form-container input {
            background: #eee;
            border: none;
            border-radius: 50px;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .form-container input:hover {
            transform: scale(101%);
        }

        .form-container label {
            width: 60%;
        }

        .warning-message {
            text-align: center;
            color: red;
            font-weight: bold;
        }

        button {
            border-radius: 50px;
            box-shadow: 0 1px 1px;
            border: 1px solid #17a2b8;
            background-color: #17a2b8;
            color: #fff;
            font-size: 12px;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background: transparent;
            border-color: #fff;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 100%;
            z-index: 2;
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .overlay {
            background: #008ecf;
            background: linear-gradient(to-right, #008ecf, #008ecf) no-repeat 0 0 / cover;
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateY(0);
            transition: transform .6s ease-in-out;
        }

        .overlay-panel {
            position: absolute;
            top: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 40px;
            height: 100%;
            width: 50%;
            text-align: center;
            transform: translateY(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-right {
            right: 0;
            transform: translateY(0);
        }

        .overlay-left {
            transform: translateY(-20%);
        }

        .container.right-panel-active .sign-in-container {
            transform: translateY(100%);
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateY(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateY(20%);
        }

/* i{
    position: fixed;
    top: 54%;
    right: 39%;
}
@media (max-width:600px)
{
    i{
        top:50%;
        right:25%
    }
} */
label {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    input[type="password"] {
        width: calc(100% - 30px); /* Adjust to accommodate the icon */
        width: 100%;
    }
    .fas {
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    } 
    </style>

</head>

<body>

    <div class="ocean">
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <section>
        <div class="container" id="container">
            <div class="form-container sign-in-container">

                <form action="./database-files/verify-login.php" method="post">
                    <h1 class="pb-3">Sign In</h1>
                    <label>
                        <input type="text" placeholder="Username" name="username" required>
                    </label>
                    <!-- <label>
                        <input type="password" placeholder="Password" name="password" required>
                    </label> -->
                    <label>
        <input type="password" placeholder="Password" name="password" id="passwordInput" required> <i class="fas fa-eye-slash" id="togglePassword"></i>
       
    </label>
                    <a href="forget_password.php">Forgot password?</a>
                    <?php

                    // Check if there is a login error message in the session
                    if (isset($_SESSION['login-error'])) {
                        echo '<p class="warning-message alert alert-danger">' . $_SESSION['login-error'] . '</p>';
                        // Clear the error message from the session
                        unset($_SESSION['login-error']);
                    }
                    ?>
                    <button>Sign In</button>
                </form>
            </div>
        </div>
    </section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle eye icon
        if (type === 'password') {
            togglePassword.classList.remove('fa-eye');
            togglePassword.classList.add('fa-eye-slash');
        } else {
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
        }
    });
});

</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script src="script.js"></script>

</body>

</html>