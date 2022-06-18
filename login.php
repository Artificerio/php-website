<?php 
require('includes/connect.php');
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/static.css">
    <title>Document</title>
</head>
<body id="login_page">
   <div class="login_div">
   <h2>Please Login</h2> 
    <form action="" method="POST">
        <input type="email" name=email placeholder="Enter email" class="field"> <br/>
        <input type="password" name=password placeholder="Enter password " class="field"> <br/>
        <input type="submit" value="Submit" name="submit_btn" class="field">
    </form>
   </div>
<?php
    if (isset($_POST['submit_btn'])) {
        $u_email = $_POST['email'];
        $u_pass = $_POST['password'];

        $select = pg_query("SELECT * FROM custom WHERE email = '$u_email' AND psswd = '$u_pass' ");
        $row = pg_fetch_array($select);

        if (is_array($row)) {
            #Logging the user in
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['psswd'] = $row['psswd'];
        } elseif (empty($u_email) || empty($u_pass)) {
            echo '<h1 class="login_error">Please, fill in the gaps!</h1>';
        } else {
            echo '<h1 class="login_error">Invalid email or password!</h1>';
        }
    }
    if (isset($_SESSION['email'])) {
        header("Location: user_profile.php");
    }
?>
</body>
</html>