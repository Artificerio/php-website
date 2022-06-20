<?php
session_start();
require("connect.php");
#disable all errors
// error_reporting(0);
// ini_set('display_errors', 0);

$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
$filename = $_FILES["file_name"]["name"];
$filetype = $_FILES["file_name"]["type"];
$filesize = $_FILES["file_name"]["size"];
$user_id = $_SESSION['id'];
$file_desc = $_POST['file_desc'];
$target_dir = "../img_". $user_id . "/";
$qqq = pg_query("SELECT * FROM images WHERE user_id = '$user_id';");
$data = array();
while ($row = pg_fetch_array($qqq)) {
    array_push($data, $row['_id']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    #chek if file was uploaded without errors
    if (isset($_FILES["file_name"]) && $_FILES["file_name"]["error"] == 0) {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    }

    //validate type of the file
    if (in_array($filetype, $allowed)) {
        //create directory for each user
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        } 
        if (file_exists($target_dir . $filename)) {
            echo '<script type="text/JavaScript"> 
            alert("Image already exists!");
            window.location.href = "../user_profile.php"
            </script>';
        } else {
            if (move_uploaded_file($_FILES['file_name']['tmp_name'], $target_dir . $filename)) {
                $query = "INSERT INTO images(_file, _type, _size, user_id, _desc)
                VALUES('$filename','$filetype','$filesize','$user_id', '$file_desc');";
                pg_query($query);
                echo '<script type="text/JavaScript"> 
                alert("Image has been uploaded successfully uploaded sucessfully!");
                window.location.href = "../user_profile.php"
                </script>';
            } else {
                echo 'Can not upload file!';
            }
        }
    }
}
?>
