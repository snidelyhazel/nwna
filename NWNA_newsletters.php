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
        $date = new DateTime();
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

      <form action="NWNA_newsletters.php#submit-to-newsletter" method="POST">
        <div style="display: flex; justify-content: space-between;">
          <div style="margin: 3px;">
            <label>Name: <input type="text" name="author" placeholder="Your Name" required></label></div>
          <div style="margin: 3px;">
            <label>E-mail: <input type="email" name="contact" placeholder="you@exampledomain.com" required></label></div>
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
            name="newsletter-text"
            placeholder="Your newsletter submission goes here."
            style="width: 375px; height: 75px; resize: vertical; min-height: 60px; margin: 3px;"
            maxlength="2000"></textarea>
          <div style="display: flex; flex-direction: column; justify-content: space-between">
            <input type="file" name="newsletter-upload" style="margin: 3px;">

            <div style="display: flex; justify-content: flex-end;">
              <input type="reset" style="margin: 3px"><input type="submit" style="margin: 3px;">
            </div>
          </div>
        </div>
      </form>
      <?php
        if (isset($_POST['newsletter-text']) || isset($_FILES['newsletter-upload']))
        {
          echo "<p>Thank you for your submission.</p>";
        }
      ?>
    </div>

  </main>

  <?php include("includes/NWNA_footer.php");?>
</body>
</html>
