<?php
  if (is_string(getenv("CLEARDB_DATABASE_URL")))
  {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $database = substr($url["path"], 1);
  }
  else
  {
    // Access to test locally
    include("includes/NWNA_admininfo.php");
  }

  $db = new mysqli($server, $username, $password, $database);
?>
