<?php
    include("connect.php");
    if (isset($_POST['register_btn'])) {
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $u_email = $_POST['email'];
        $u_psswd = $_POST['psswd'];
        $u_psswd_rep = $_POST['psswd_rep'];
        if (empty($u_email) || empty($u_psswd)) {
            echo '<script type="text/JavaScript"> 
            alert("Fill in all the fields!");
            window.location.href = "../sign_up.php"
            </script>';
        } elseif ($u_psswd != $u_psswd_rep) {
            echo '<script type="text/JavaScript"> 
            alert("Passwords no not match!");
            window.location.href = "../sign_up.php"
            </script>';
        } else {
            $query = "INSERT INTO custom(f_name, l_name, email, psswd)
            VALUES('$f_name', '$l_name', '$u_email', '$u_psswd');";
            pg_query($query);
            echo '<script type="text/JavaScript"> 
            alert("Successfully created account!");
            window.location.href = "../login.php"
            </script>';
        } 
    }
?>
