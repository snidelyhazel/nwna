<?php
  $CURRENT_PAGE = "Home";
  $PAGE_TITLE = "NWNA Home";
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="NWNA_style.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
  <?php include("includes/NWNA_nav.php");?>

  <img src="logo.svg" class="nav-logo" alt="North Westdale Neighborhood Association"/>
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

  <footer>
    <address>
      North Westdale Neighborhood Association
      P.O.&nbsp;Box&nbsp;642522
      Los Angeles,&nbsp;CA&nbsp;90064
    </address>
  </footer>
</body>
</html>
