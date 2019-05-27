<?php
  $CURRENT_PAGE = "Home";
  $PAGE_TITLE = "NWNA Home";
?>

<!DOCTYPE html>
<html>
<head>
  <?php include("includes/NWNA_head.php");?>
</head>
<body>
  <?php include("includes/NWNA_nav.php");?>
  <main>

    <p>Hello World!</p>


    <script>
      function toggleNav()
      {
        var item = document.getElementById("NWNA-nav");
        if (item.className === "topnav")
        {
          item.className += " responsive";
        }
        else
        {
          item.className = "topnav";
        }
      }
    </script>
  </main>

  <?php include("includes/NWNA_footer.php");?>
</body>
</html>
