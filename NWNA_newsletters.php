<?php
  $CURRENT_PAGE = "Newsletters";
  $PAGE_TITLE = "NWNA Newsletters";
?>

<!DOCTYPE html>
<html>
<head>
  <?php include("includes/NWNA_head.php");?>
</head>
<body>
  <?php include("includes/NWNA_nav.php");?>
  <main>
    <h2>Current</h2>
    <h2>Recent</h2>
    <h2>Archives</h2>

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
          style="width: 375px; height: 75; resize: vertical; min-height: 60px; margin: 3px;"
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
      if (isset($_POST['newsletter-text']) || isset($_POST['newsletter-upload']))
      {
        echo "<p>Thank you for your submission.</p>";
      }
    ?>

  </main>

  <?php include("includes/NWNA_footer.php");?>
</body>
</html>
