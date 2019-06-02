<?php
  $CURRENT_PAGE = "Calendar";
  $PAGE_TITLE = "NWNA Calendar";
?>

<!DOCTYPE html>
<html>
<head>
  <?php include("includes/NWNA_head.php");?>
</head>
<body>
  <?php include("includes/NWNA_nav.php");?>
  <main>
    <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=America%2FLos_Angeles&amp;src=am9xZmZwY3RncXYzdTM1cG5wbWlrMnFybnNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%23E4C441" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
  </main>

  <?php include("includes/NWNA_footer.php");?>
</body>
</html>
