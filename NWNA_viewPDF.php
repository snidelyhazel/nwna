<?php
  include("includes/NWNA_connection.php");


  if ($db === FALSE)
  {
      echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
  }
  else
  {

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
