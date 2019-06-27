<?php
  $CURRENT_PAGE = "Pets";
  $PAGE_TITLE = "NWNA Pets";

  include("includes/NWNA_connection.php");

  if ($db === FALSE)
  {
      echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
  }
  else
  {
    $table = "pets";
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
    <h2>Lost & Found Pets</h2>
    <form enctype="multipart/form-data" action="NWNA_pets.php#lost-and-found" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
      <h3>Your information</h3>

      <div class="form-div">
        <label for="name">Your Name:</label>
        <input type="text" name="name" id="name" required>
      </div>
      <div class="form-div">
        <label for="email">Your E-mail:</label>
        <input type="email" name="email" id="email" required>
      </div>
      <div class="form-div-center">
        Have you lost or found an animal?
        <div>
          <label for="lost">Lost</label>
          <input type="radio" name="lost-found" value="lost" id="lost" required>
        </div>
        <div>
          <label for="found">Found</label>
          <input type="radio" name="lost-found" value="found" id="found">
        </div>
      </div>

      <h3>Pet information</h3>

      <div class="form-div-center">
        What type of animal?
        <div>
          <label for="dog">Dog</label>
          <input type="radio" name="species" value="dog" id="dog" required>
        </div>
        <div>
          <label for="cat">Cat</label>
          <input type="radio" name="species" value="cat" id="cat">
        </div>
        <div>
          <label for="other-species">Other</label>
          <input type="radio" name="species" value="other" id="other-species" onchange="toggleElement('other', this.checked)">
            <span class="reveal-if-active">
              <input type="text" name="other-desc" id="other-desc" class="require-if-active" data-require-pair="#other-species">
            </span>
        </div>
      </div>
      <div class="form-div">
        <label for="pet-name">Name: </label>
        <input type="text" name="pet-name" id="pet-name">
      </div>
      <div class="form-div">
        <label for="pet-breed">Breed: </label>
        <input type="text" name="pet-breed" id="pet-breed">
      </div>
      <div class="form-div">
        <label for="pet-color">Color: </label>
        <input type="text" name="pet-color" id="pet-color" required>
      </div>
      <div class="form-div-center">
        <label for="male">Male</label>
        <input type="radio" name="male-female" value="male" id="male" required>
        <label for="cat">Female</label>
        <input type="radio" name="male-female" value="female" id="female">
        <label for="cat">Unsure</label>
        <input type="radio" name="male-female" value="unsure" id="unsure">
      </div>
      <div class="form-div-center">
        <label for="fixed">Is the animal spayed or neutered?</label>
        <input type="checkbox" name="fixed" value="fixed" id="fixed">
      </div>
      <div class="form-div-center">
        Does the animal have identification?
        <div>
          <label for="collar">Collar</label>
          <input type="checkbox" name="collar" value="collar" id="collar">
          <label for="microchip">Microchip</label>
          <input type="checkbox" name="microchip" value="microchip" id="collar">
        </div>
      </div>
      <div>

      <h3>Report details</h3>

      <div class="form-div">
        <label for="date-lf">Date lost or found:</label>
        <input type="date" name="date-lf" id="date-lf" required>
      </div>
      <div class="form-div">
        <label for="loc-lf">Location lost or found:</label>
        <div>
          <textarea name="loc-lf" id="loc-lf" style="height: 31px; resize: none;"
          maxlength="2000" required></textarea>
        </div>
      </div>

      <h3>Upload photo or poster</h3>

      <div class="form-div">
        <input type="file" name="pet-upload"
          accept="image/*, .png, .jpg, .jpeg">
      </div>
      <div class="form-div">
        <input type="submit">
      </div>
    </form>

    <?php
      if (isset($_POST['lost-found']))
      {
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $email = mysqli_real_escape_string($db, trim($_POST['email']));
        $lostfound = mysqli_real_escape_string($db, $_POST['lost-found']);
        $species = mysqli_real_escape_string($db, $_POST['species']);
        $otherdesc = mysqli_real_escape_string($db, $_POST['other-desc']);
        $petname = mysqli_real_escape_string($db, $_POST['pet-name']);
        $petbreed = mysqli_real_escape_string($db, $_POST['pet-breed']);
        $petcolor = mysqli_real_escape_string($db, $_POST['pet-color']);
        $malefemale = mysqli_real_escape_string($db, $_POST['male-female']);
        $fixed = isset($_POST['fixed']);
        $collar = isset($_POST['collar']);
        $microchip = isset($_POST['microchip']);
        $datelf = mysqli_real_escape_string($db, $_POST['date-lf']);
        $loclf = mysqli_real_escape_string($db, $_POST['loc-lf']);

        $hasupload = isset($_FILES['pet-upload']) && $_FILES['pet-upload']['size'] > 0;
        if ($hasupload)
        {
          $filename = mysqli_real_escape_string($db, $_FILES['pet-upload']['name']);
          $pet_upload = mysqli_real_escape_string($db, file_get_contents($_FILES['pet-upload']['tmp_name']));
        }

        $table = "pets";

        $SQLstring = "SHOW TABLES LIKE '$table'";
        $QueryResult = mysqli_query($db, $SQLstring);

        if (mysqli_num_rows($QueryResult) == 0)
        {
          $SQLstring = "CREATE TABLE IF NOT EXISTS $table (id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(40), email VARCHAR(40), lostfound VARCHAR(40), petname VARCHAR(40), petbreed VARCHAR(40), petcolor VARCHAR(40), malefemale VARCHAR(40), fixed BOOLEAN, collar BOOLEAN, microchip BOOLEAN, datelf VARCHAR(40), loclf VARCHAR(40), pet_upload LONGBLOB)";
          $QueryResult = mysqli_query($db, $SQLstring);
          if ($QueryResult === FALSE)
          {
            echo "<p>Unable to process your submission. </p>" . "<p>Error code " . mysqli_errno($db) . ": " . mysqli_error($db) . "</p>";
          }
        }

        if ($hasupload)
        {
          $QueryResult = mysqli_query($db, "INSERT INTO $table (name, email, lostfound, petname, petbreed, petcolor, malefemale, fixed, collar, microchip, datelf, loclf, pet_upload) VALUES ('$name', '$email', '$lostfound', '$petname', '$petbreed', '$petcolor', '$malefemale', '$fixed', '$collar', '$microchip', '$datelf', '$loclf', '$pet_upload');");
        }
        else
        {
          $QueryResult = mysqli_query($db, "INSERT INTO $table (name, email, lostfound, petname, petbreed, petcolor, malefemale, fixed, collar, microchip, datelf, loclf) VALUES ('$name', '$email', '$lostfound', '$petname', '$petbreed', '$petcolor', '$malefemale', '$fixed', '$collar', '$microchip', '$datelf', '$loclf');");
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
    ?>

  </main>

  <?php include("includes/NWNA_sidebar.php");?>
  <?php include("includes/NWNA_footer.php");?>
</body>
</html>
