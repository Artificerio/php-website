<?php
require("includes/connect.php");
session_start();
$user_id = $_SESSION['id'];
$check = pg_query("SELECT EXISTS(SELECT 1 FROM images WHERE user_id='$user_id')");

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
<body id="user_profile_page">
<h2>Hi there! <?php echo $_SESSION['email'];?> </h2>
<h2>Your id is <?php echo $_SESSION['id'];?> </h2>

<form action="includes/upload.php" method="POST" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="file_name" id="file_name">
  <input type="submit" value="Upload Image" name="submit">
</form>
<?php
if ($check) {
    $image_details = pg_query("SELECT * FROM images WHERE user_id = '$user_id'");
    while ($row = pg_fetch_array($image_details)) {
        echo "<div class='image_content'>";
        echo "<img src='img_". $user_id ."/" . $row['_file'] . "' width=='400' height='400'>"; 
        echo "filename : " . $row['_file'];
        echo "</div>";
    }
}
?>
<form action="includes/delete.php" method="POST">
    <input type="text" name="filename" placeholder="Separate each file name with a comma(,)" style="width: 300px;">
    <button type="submit" name="submit">Delelte files</button>
</form>
<p>Click here to <a href="includes/logout.php">logout</a></p>
</body>
</html>