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

    <h3>Submit to the newsletter</h3>
    <p>Newsletter submissions are due by the last Monday of every month.</p>
    <p>You may either type into the form below or upload a file.</p>

    <form action="NWNA_newsletters.php" method="POST">
      <div style="display: flex; justify-content: space-between">
        <textarea
          name="newsletter-text"
          placeholder="Your newsletter submission goes here."
          style="width: 375px; height: 75; resize: vertical; min-height: 60px;"
          maxlength="2000"></textarea>
        <div style="display: flex; flex-direction: column; justify-content: space-between">
          <input type="file" name="newsletter-upload">

          <div style="display: flex; justify-content: flex-end">
            <input type="reset" style="margin: 3px"><input type="submit" style="margin: 3px">
          </div>
        </div>
      </div>

    </form>
  </main>

  <?php include("includes/NWNA_footer.php");?>
</body>
</html>
