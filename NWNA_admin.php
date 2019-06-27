<?php
  $CURRENT_PAGE = "Admin";
  $PAGE_TITLE = "NWNA Admin";
?>

<!DOCTYPE html>
<html>
<head>
  <?php include("includes/NWNA_head.php");?>
</head>
<body>
  <?php include("includes/NWNA_nav.php");?>
  <main>
    <h2>Newsletter Uploader</h2>
    <p>Note: Uploader only works with Chrome.</p>
    <form enctype="multipart/form-data" action="NWNA_admin.php#upload-newsletter" method="POST">
      <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
      <div>
        <label>Select month and year: <input type="month" name="date" style="margin: 3px;"></label>
      </div>
      <div>
        <input type="file" name="newsletter-upload" style="margin: 3px;">
      </div>
      <div>
        <input type="password" name="password" placeholder="Enter password" style="margin: 3px;">
      </div>
      <div>
          <input type="submit" style="margin: 3px;">
      </div>
    </form>
    <?php
      if (isset($_FILES['newsletter-upload']))
      {
        if ($db === FALSE)
        {
            echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
        }
        else
        {
          $table = "newsletters";

          $SQLstring = "SHOW TABLES LIKE '$table'";
          $QueryResult = mysqli_query($db, $SQLstring);

          if (mysqli_num_rows($QueryResult) == 0)
          {
            $SQLstring = "CREATE TABLE IF NOT EXISTS $table (date BIGINT PRIMARY KEY, file LONGBLOB)";
            $QueryResult = mysqli_query($db, $SQLstring);
            /*
            if ($QueryResult === FALSE)
            {
              echo "<p>Unable to create the table.</p>" . "<p>Error code " . mysqli_errno($db) . ": " . mysqli_error($db) . "</p>";
            }
          */
          }

          $date = implode("", explode("-", $_POST['date']));
          $QueryResult = mysqli_query($db, "INSERT INTO $table (date, file) VALUES ($date, '" . mysqli_real_escape_string($db, file_get_contents($_FILES['newsletter-upload']['tmp_name'])) . "');");
          //$QueryResult = mysqli_query($db, "INSERT INTO $table (date) VALUES ($date);");
          if ($QueryResult === FALSE)
          {
            echo "<p>Unable to upload newsletter.</p>" . "<p>Error code " . mysqli_errno($db) . ": " . mysqli_error($db) . "</p>";
          }
          else
          {
            echo "<p>Your newsletter " . $_FILES['newsletter-upload']['name'] . " has been uploaded successfully.</p>";
          }
        }
      }
    ?>
  </main>

  <?php include("includes/NWNA_sidebar.php");?>
  <?php include("includes/NWNA_footer.php");?>
</body>
</html>
