<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
    <style>
        .sign {
            padding-top: 40px;
            color: #8C55AA;
            font-family: 'Ubuntu', sans-serif;
            font-weight: bold;
            font-size: 23px;
            text-align: center;
        }

        .un,
        .pass {
            width: 76%;
            color: rgb(38, 50, 56);
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1px;
            background: rgba(136, 126, 126, 0.04);
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            outline: none;
            box-sizing: border-box;
            border: 2px solid rgba(0, 0, 0, 0.02);
            margin-bottom: 27px;
            text-align: center;
            font-family: 'Ubuntu', sans-serif;
        }

        .un:focus,
        .pass:focus {
            border: 2px solid rgba(0, 0, 0, 0.18) !important;
        }

        .submit {
            cursor: pointer;
            border-radius: 5em;
            color: #fff;
            background: linear-gradient(to right, #9C27B0, #E040FB);
            border: 0;
            padding-left: 40px;
            padding-right: 40px;
            padding-bottom: 10px;
            padding-top: 10px;
            font-family: 'Ubuntu', sans-serif;
            margin-left: 35%;
            font-size: 13px;
            box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
        }

        .forgot {
            text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
            color: #E1BEE7;
            padding-top: 15px;
            text-align: center;
        }

        .alert {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <p class="sign">Sign Up</p>
    <img src="https://img.icons8.com/clouds/150/000000/user.png" style="display: block; margin: 0 auto;">
    <form id="signup_form" method="post" action="register.php" class="login100-form">
        <input class="un" type="text" name="f_name" placeholder="First Name" required>
        <input class="un" type="text" name="l_name" placeholder="Last Name" required>
        <input class="un" type="email" name="email" placeholder="Email" required>
        <input class="pass" type="password" name="password" placeholder="Password" required>
        <input class="pass" type="password" name="repassword" placeholder="Confirm Password" required>
        <input class="un" type="text" name="mobile" placeholder="Mobile" required>
        <input class="un" type="text" name="address1" placeholder="Address" required>
        <input class="un" type="text" name="address2" placeholder="City" required>
        <input class="submit" type="submit" value="Sign Up">
    </form>
    <p class="forgot"><a href="#">Forgot Password?</a></p>
</body>

</html>