<?php
//  $user="zashley";
//  include("includes/NWNA_connection.php");
//  $host="localhost";
//  $db = mysqli_connect($host, $user, $NWNA_connection);
//in else:
//$dbname = "zashley_project";
//mysqli_select_db($db, $dbname);

  $url = parse_url(getenv("CLEAR_DATABASE_URL"));

  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $database = substr($url["path"], 1);

  $db = new mysqli($server, $username, $password, $database);

?>
