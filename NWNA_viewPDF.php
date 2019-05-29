<?php
  $user="zashley";
  include("includes/db_pass.php");

  $host="localhost";

  $db = mysqli_connect($host, $user, $db_password);

  if ($db === FALSE)
  {
      echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
  }
  else {

    $dbname = "zashley_project";
    mysqli_select_db($db, $dbname);

    $table = "newsletters";
    $date = $_GET['date'];

    $SQLstring = "SELECT file FROM $table WHERE date = $date";
    $QueryResult = mysqli_query($db, $SQLstring);
    $row = mysqli_fetch_array($QueryResult);

    $newsletter = $row['file'];
    header('Content-type: application/pdf');

header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Content-Disposition: inline;filename='$date.pdf'");
header("Content-Length: ".strlen($newsletter));
    echo $newsletter;
  }
?>
