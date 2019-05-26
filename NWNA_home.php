<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="NWNA_style.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
  <header>
    <nav>
      <div class="topnav" id="NWNA-nav">
        <a href="#home" class="active">Home</a>
        <a href="#about">About</a>
        <a href="#newsletters">Newsletters</a>
        <a href="#resources">Resources</a>
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
