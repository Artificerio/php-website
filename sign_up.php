<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
        <title>Sign_up</title>
    </head>

    <style type="text/css" media="screen">
        .sign_up_page {
            text-align: center;
            background-color: bisque;
        }
        .sign_up_field {
            margin-bottom: 10px;
        }
    </style>

    <body class="sign_up_page">
        <div class="sign_up_field">
            <form action="includes/signup.inc.php" method="POST">
                <h2>Please create your account</h2>
                <label for="f_name">First name: </label><input type="text" name="f_name" placeholder="Enter your first name" class = "sign_up_field"> <br/>
                <label for="l_name">Last name: </label> <input type="text"  name="l_name" placeholder="Enter your last name" class = "sign_up_field"> <br/>
                <label for="email">Email: </label> <input type="text"  name="email" placeholder="Enter your email" class = "sign_up_field"> <br/>
                <label for="psswd">Password: </label> <input type="password" name="psswd" placeholder="Enter your password" class = "sign_up_field"> <br/>
                <label for="psswd_rep">Repeat your password: </label> <input type="password" name="psswd_rep" placeholder="Repeat your password" class = "sign_up_field"> <br/>
                <br />
                <button type="submit" name="register_btn" align="center">Register</button>
            </form>
            <p>Already registered? <a href="login.php"><b>Log in into your account</b></a></p>
        </div>
    </body>
</html>

