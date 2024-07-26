<!DOCTYPE html>
<html>
<style type="text/css">
    .sign {
        padding-top: 40px;
        color: #8C55AA;
        font-family: 'Ubuntu', sans-serif;
        font-weight: bold;
        font-size: 23px;
    }

    .un {
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
        margin-bottom: 50px;
        margin-left: 46px;
        text-align: center;
        margin-bottom: 27px;
        font-family: 'Ubuntu', sans-serif;
    }

    form.form1 {
        padding-top: 40px;
    }

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
        margin-bottom: 50px;
        margin-left: 46px;
        text-align: center;
        margin-bottom: 27px;
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
    }
</style>

<head>
    <title>Sign in</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <p class="sign" align="center">Sign in</p>
    <img src="https://img.icons8.com/clouds/150/000000/user.png" style="margin-left: 190px;">

    <form class="form1" id="loginForm">
        <input class="un" type="text" align="center" placeholder="Username" name="email">
        <input class="pass" type="password" align="center" placeholder="Password" name="password">
        <input class="submit" type="button" Value="Login" id="loginButton">
    </form>

    <div id="loginResponse" align="center"></div>

    <script>
        $(document).ready(function() {
            $('#loginButton').click(function() {
                var formData = $('#loginForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: 'login.php', // Make sure this points to your PHP login script
                    data: formData,
                    success: function(response) {
                        $('#loginResponse').html(response);
                        if (response.includes('login_success')) {
                            window.location.href = 'index.php'; // Redirect on success
                        }
                    },
                    error: function() {
                        $('#loginResponse').html('<span style="color:red;">An error occurred.</span>');
                    }
                });
            });
        });
    </script>
</body>

</html>