<?php
  $CURRENT_PAGE = "Join";
  $PAGE_TITLE = "NWNA Join";
?>

<!DOCTYPE html>
<html>
<head>
  <?php include("includes/NWNA_head.php");?>
</head>
<body>
  <?php include("includes/NWNA_nav.php");?>
  <main>
    <h2>Join the North Westdale Neighborhood Association</h2>

    <p>While all North Westdale residents, homeowners and renters, are NWNA members, we appreciate your support.<br/> Suggested annual dues are $15 per household.</p>
    <p>These voluntary dues pay our basic operating costs, including our meeting venue, website hosting, and newsletter printing.</p>
    <p>You may pay your annual dues online, in-person or by mail.</p>
    <p>We gladly accept donations above and beyond suggested annual dues.</p>

    <h3>Online</h3>
    <p>The NWNA accepts dues and donations online through PayPal.

    <div style="margin-left: 20px;">
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
        <input name="cmd" value="_s-xclick" type="hidden">
        <input name="hosted_button_id" value="MZQ9PY9ADLPWW" type="hidden">
        <input src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal" type="image" border="0">
      </form>
    </div>

    <h3>In-Person</h3>
    <p>You may pay dues and make donations in-person with your block captain or at the next NWNA general meeting.</p>

    <h3>Mail</h3>
    <p>To pay dues and make donations by mail, please send a check to</p>
      <address style="margin-left: 20px;">NWNA<br/>P.O. Box 642522<br/>Los Angeles, CA 90064</address>
    <p>with your address and current year on the memo line.</p>

  </main>
  
  <?php include("includes/NWNA_sidebar.php");?>
  <?php include("includes/NWNA_footer.php");?>
</body>
</html>
