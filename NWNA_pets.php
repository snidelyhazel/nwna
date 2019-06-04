<?php
  $CURRENT_PAGE = "Pets";
  $PAGE_TITLE = "NWNA Pets";
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
          <input type="radio" name="lost-found" id="lost" required>
        </div>
        <div>
          <label for="found">Found</label>
          <input type="radio" name="lost-found" id="found">
        </div>
      </div>

      <h3>Pet information</h3>

      <div class="form-div-center">
        What type of animal?
        <div>
          <label for="dog">Dog</label>
          <input type="radio" name="species" id="dog" required>
        </div>
        <div>
          <label for="cat">Cat</label>
          <input type="radio" name="species" id="cat">
        </div>
        <div>
          <label for="other-species">Other</label>
          <input type="radio" name="species" id="other-species" onchange="toggleElement('other', this.checked)">
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
        <input type="radio" name="male-female" id="male" required>
        <label for="cat">Female</label>
        <input type="radio" name="male-female" id="female">
        <label for="cat">Unsure</label>
        <input type="radio" name="male-female" id="unsure">
      </div>
      <div class="form-div-center">
        <label for="spayed">Spayed</label>
        <input type="radio" name="fixed" id="spayed">
        <label for="neutered">Neutered</label>
        <input type="radio" name="fixed" id="neutered">
      </div>
      <div class="form-div-center">
        Does the animal have identification?
        <div>
          <label for="collar">Collar</label>
          <input type="checkbox" name="collar" id="collar">
          <label for="microchip">Microchip</label>
          <input type="checkbox" name="microchip" id="collar">
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
  </main>

  <script>
  /*  function toggleElement(elementID, display)
    {
      var element = document.getElementById(elementID);

      if (display)
      {
        element.style.display = "";
      }
      else
      {
        element.style.display = "none";
      }
    }*/
  </script>
  
  <?php include("includes/NWNA_sidebar.php");?>
  <?php include("includes/NWNA_footer.php");?>
</body>
</html>
