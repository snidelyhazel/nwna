<header>
  <!--<img src="logo.svg" class="nav-logo" alt="North Westdale Neighborhood Association"/>-->
  <?php include("includes/NWNA_logo.php");?>
  <nav>
    <div class="topnav" id="NWNA-nav">
      <a href="NWNA_home.php" <?php if($CURRENT_PAGE=="Home") echo "class='active'"; ?>>Home</a>
      <a href="NWNA_about.php" <?php if($CURRENT_PAGE=="About") echo "class='active'"; ?>>About</a>
      <a href="NWNA_newsletters.php" <?php if($CURRENT_PAGE=="Newsletters") echo "class='active'"; ?>>Newsletters</a>
      <a href="NWNA_resources.php" <?php if($CURRENT_PAGE=="Resources") echo "class='active'"; ?>>Resources</a>
      <a href="javascript:void(0);" class="icon" onclick="toggleNav()">
        <i class="material-icons">menu</i>
      </a>
    </div>

<!--
About
  Join
  Connect
Newsletters
  Current
  Recent
  Archives
    By year
Meetings
  Agendas
  Minutes
Events
  Upcoming
  Past
Resources
  NWNA
    Map
    Issues
      Airport
        Media
      Development
        Presentations
  MVCC

  LA
    Police
  Partners

-->
  </nav>
</header>

<!-- Responsive navigation -->
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
