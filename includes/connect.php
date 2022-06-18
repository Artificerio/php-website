<?php 
$host = "localhost";
$dbname = "postgres";
$user = "postgres";
$password = "0305";
$db_conn = pg_connect("host=$host dbname=$dbname user=$user password=$password") or die ("Could not connect to the database" . pg_last_error());
?>