<?php
#TODO: 1. create sign_up page
      #2. create database_scheme 
      #3. implement scheme in website

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
<body class="user_profile_page">

<div class="user_welocome">
<p>Hi there! <?php echo $_SESSION['email'];?> <p>
<p>Your id is <?php echo $_SESSION['id'];?> <p>
<p><b>Click here to <a href="includes/logout.php">logout</a></p></b>
</div>

<div class="submit_data">
<form action="includes/upload.php" method="POST" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="file_name" id="file_name"> 
  <input type="text" name="file_desc" id="" placeholder="Image description"> 
  <input type="submit" value="Upload Data" name="submit">
</form>
</div>

<style type="text/css" media="screen">
.grid-container{
    display: grid;
    grid-template-columns: repeat(2, 400px);
    grid-template-rows: 400px, 400px;
    grid-row-gap: 20px;
    grid-column-gap: 20px;
}
.grid-item2 {
    padding: 100px;
    color: royalblue;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

</style>

<?php
if ($check) {
    $image_details = pg_query("SELECT * FROM images WHERE user_id = '$user_id'");
    while ($row = pg_fetch_array($image_details)) {
    echo '<div class="grid-container">';

        echo '<div class="grid-item grid-item1">';
            echo "<img src='img_". $user_id ."/" . $row['_file'] . "' width='400' height='400' >";
        echo '</div>';

        echo '<div class="grid-item grid-item2">';
                echo "filename : " . $row['_file'];  echo '<br/>';
        echo 'image description : ' .$row['_desc'];  echo '<br/>';
                echo 'filesize :'. $row['_size'];  echo '<br/>';
                echo 'type : '. $row['_type']; echo '<br/>';
        echo '</div>';

    echo '</div>';
    }
}
?>
<div class="delete_data">
<form action="includes/delete.php" method="POST">
    <input type="text" name="filename" placeholder="Separate each file name with a comma(,)" style="width: 300px;">
    <button type="submit" name="submit">Delelte files</button>
</form>
</div>

</body>
</html>
