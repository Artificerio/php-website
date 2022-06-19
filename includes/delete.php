<?php
#error_reporting(0);
#ini_set('display_errors', 0);
require_once("connect.php");
session_start();
// $query =  pg_query("SELECT COLUMN_NAME
//              FROM INFORMATION_SCHEMA.COLUMNS
//              WHERE TABLE_NAME = 'images' ;");
// $column_names = array();
// while ($row = pg_fetch_array($query)) {
//     array_push($column_names, $row['column_name']);
// }

$file_names = $_POST['filename'];
$remove_spaces = str_replace(" ","", $file_names);
$allFileNames = explode(",", $remove_spaces);
$countAllNames = count($allFileNames);
$user_id = $_SESSION['id'];
$target_dir = "../img_". $user_id . "/";

for ($i=0; $i < $countAllNames ; $i++) { 
    if (file_exists($target_dir . $allFileNames[$i]) == false) {
        header("Location: ../user_profile.php?delete_error");
        exit();
    }
}

for ($i=0; $i < $countAllNames; $i++) { 
    $path = $target_dir.$allFileNames[$i];
    if (!unlink($path)) {
        echo "can not delete file!";
        exit();
    }
    pg_query("DELETE FROM images WHERE _file = '$allFileNames[$i]' AND user_id = '$user_id'; ");
}
echo "You have deleted ".$countAllNames." images";
header("Refresh: 3; URL=../user_profile.php");
?>