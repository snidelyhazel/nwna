<?php
  $CURRENT_PAGE = "Newsletters";
  $PAGE_TITLE = "NWNA Newsletters";

  function convertDate($dateString)
  {
    $month = null;
    switch($dateString)
    {
      case "01": $month = "January"; break;
      case "02": $month = "February"; break;
      case "03": $month = "March"; break;
      case "04": $month = "April"; break;
      case "05": $month = "May"; break;
      case "06": $month = "June"; break;
      case "07": $month = "July"; break;
      case "08": $month = "August"; break;
      case "09": $month = "September"; break;
      case "10": $month = "October"; break;
      case "11": $month = "November"; break;
      case "12": $month = "December"; break;
      default: throw new Exception;
    }

    return $month;
  }

  $user="zashley";
  include("includes/db_pass.php");

  $host="localhost";

  $db = mysqli_connect($host, $user, $db_password);

  if ($db === FALSE)
  {
      echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
  }
  else
  {
    $dbname = "zashley_project";
    mysqli_select_db($db, $dbname);

    $table = "newsletters";
  }
?>

<!DOCTYPE html>
<html>
<head>
  <?php include("includes/NWNA_head.php");?>
</head>
<body>
  <?php include("includes/NWNA_nav.php");?>
  <main>

    <h2>North Westdale Neighborhood Association Newsletters</h2>

    <div class="newsletter-div">
      <a href="#current"><h2>Current</h2></a>
      <a href="#recent"><h2>Recent</h2></a>
      <a href="#archive"><h2>Archive</h2></a>
    </div>

    <!--Current-->
    <div id="current" class="reveal">
      <?php
        $date = new DateTime('now', new DateTimeZone('America/Los_Angeles'));
        $filename = $date->format("Ym");

        if ($db !== FALSE)
        {
          $SQLstring = "SELECT date from $table WHERE date = $filename";
          $QueryResult = mysqli_query($db, $SQLstring);

          if (mysqli_num_rows($QueryResult) == 0)
          {
            echo "<p>No newsletter exists for this month yet. Displaying most recent newsletter.</p>";
            $SQLstring = "SELECT date from $table ORDER BY date DESC LIMIT 1";
            $QueryResult = mysqli_query($db, $SQLstring);
            $row = mysqli_fetch_array($QueryResult);
            $recent = $row["date"];

            echo "<p><a href='NWNA_viewPDF.php?date=" . $recent . "' target='_blank'>" . convertDate(substr($recent, 4, 2)) . " " . substr($recent, 0, 4) . "</a></p>";
          }
          else
          {
            echo "<p><a href='NWNA_viewPDF.php?date=$filename' target='_blank'>" . convertDate($date->format('m')) . " " .  $date->format('Y') . "</a></p>";
          }
        }

      ?>
    </div>

    <!--Recent-->
    <div id="recent" class="reveal">
      <?php
        if ($db !== FALSE)
        {
          $SQLstring = "SELECT date from $table ORDER BY date DESC LIMIT 6";
          $QueryResult = mysqli_query($db, $SQLstring);

          if (mysqli_num_rows($QueryResult) != 0)
          {
            while ($row = mysqli_fetch_array($QueryResult))
            {
              $recent = $row["date"];

              echo "<p><a href='NWNA_viewPDF.php?date=" . $recent . "' target='_blank'>" . convertDate(substr($recent, 4, 2)) . " " . substr($recent, 0, 4) . "</a></p>";
            }
          }
          else
          {
            echo "<p>No recent newsletters to display. Please check back soon.</p>";
          }
        }
      ?>
    </div>

    <!--Archive-->
    <div id="archive">

    </div>

<hr/>

    <!--Submit-->
    <div id="submit">
      <h3 id="submit-to-newsletter">Submit to the newsletter</h3>
      <p>Newsletter submissions are due by the last Monday of every month.</p>
      <p>You may either type into the form below or upload a file.</p>
      <p>By submitting to this form you hereby grant the North Westdale Neighborhood Association the exclusive right to publish or distribute the information herein.</p>

      <form enctype="multipart/form-data" action="NWNA_newsletters.php#submit-to-newsletter" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
        <div style="display: flex; justify-content: space-between;">
          <div style="margin: 3px;">
            <label>Name: <input type="text" name="name" placeholder="Your Name" required></label></div>
          <div style="margin: 3px;">
            <label>E-mail: <input type="email" name="email" placeholder="you@exampledomain.com" required></label></div>
          <div style="margin: 3px;">
            <label>Affiliation: <select name="affiliation">
              <option selected disabled>How are you connected?</option>
              <option value="live">I live here.</option>
              <option value="work">I work here.</option>
              <option value="property">I own property here.</option>
              <option value="other">I have another interest here.</option>
            </select></label>
          </div>
        </div>
        <div style="display: flex; justify-content: space-between;">
          <textarea
            name="submission-text"
            placeholder="Your newsletter submission goes here."
            style="width: 375px; height: 75px; resize: vertical; min-height: 60px; margin: 3px;"
            maxlength="2000"></textarea>
          <div style="display: flex; flex-direction: column; justify-content: space-between">
            <input type="file" name="submission-upload"
              accept="txt/plain, application/msword, application/rtf, application/vnd.oasis.opendocument.text, .txt, .doc, .docx, .rtf, .odt, .wpd"
              style="margin: 3px;">
            <div style="display: flex; justify-content: flex-end;">
              <input type="reset" style="margin: 3px"><input type="submit" style="margin: 3px;">
            </div>
          </div>
        </div>
      </form>

      <?php
        if (isset($_POST['submission-text']) || isset($_FILES['submission-upload']))
        {
          $name = mysqli_real_escape_string($db, $_POST['name']);
          $email = mysqli_real_escape_string($db, trim($_POST['email']));
          $affiliation = mysqli_real_escape_string($db, $_POST['affiliation']);

          $submission_text = mysqli_real_escape_string($db, $_POST['submission-text']);

          $hasupload = isset($_FILES['submission-upload']) && $_FILES['submission-upload']['size'] > 0;
          if ($hasupload)
          {
            $filename = mysqli_real_escape_string($db, $_FILES['submission-upload']['name']);
            $submission_upload = mysqli_real_escape_string($db, file_get_contents($_FILES['submission-upload']['tmp_name']));
          }

          $table = "submissions";

          $SQLstring = "SHOW TABLES LIKE '$table'";
          $QueryResult = mysqli_query($db, $SQLstring);

          if (mysqli_num_rows($QueryResult) == 0)
          {
            $SQLstring = "CREATE TABLE IF NOT EXISTS $table (id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(40), email VARCHAR(40), affiliation VARCHAR(40), submission_text VARCHAR(2000), submission_upload LONGBLOB)";
            $QueryResult = mysqli_query($db, $SQLstring);
            if ($QueryResult === FALSE)
            {
              echo "<p>Unable to process your submission. </p>" . "<p>Error code " . mysqli_errno($db) . ": " . mysqli_error($db) . "</p>";
            }


          }

          $email = filter_var(stripslashes($email), FILTER_SANITIZE_EMAIL);
          if (filter_var($email, FILTER_VALIDATE_EMAIL))
          {
            $sender = "$name <$email>";
            $headers = "From: noreply@northwestdale.com \nBCC: ashley.zeldin@gmail.com\n";
            $result = mail($sender, "Newsletter submission confirmation", $submission_text, $headers);

            if ($hasupload)
            {
              $QueryResult = mysqli_query($db, "INSERT INTO $table (name, email, affiliation, submission_text, submission_upload) VALUES ('$name', '$email', '$affiliation', '$submission_text', '$submission_upload');");
            }
            else
            {
              $QueryResult = mysqli_query($db, "INSERT INTO $table (name, email, affiliation, submission_text) VALUES ('$name', '$email', '$affiliation', '$submission_text');");
            }
            if ($QueryResult === FALSE)
            {
              echo "<p>Unable to process your submission. </p>" . "<p>Error code " . mysqli_errno($db) . ": " . mysqli_error($db) . "</p>";
            }
            else
            {
              echo "<p>Your submission has been processed successfully. Thank you.</p>";
            }
          }
          else
          {
            echo "<p>Unable to process your submission. Please enter a valid email address.</p>";
          }
        }
      ?>
    </div>

  </main>

  <?php include("includes/NWNA_footer.php");?>
</body>
</html>
