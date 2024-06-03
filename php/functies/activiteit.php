
<?php 
include 'database.php';
  
  // Get the image from the database
  $sql = "SELECT Flyer FROM ACTIVITEIT WHERE Activiteit_id = 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageLink = $row['Flyer'];
    echo '<img src="' . $imageLink . '" alt="Image">';
  }

  // Get the Title from the database
  $sql = "SELECT Act_Title FROM ACTIVITEIT WHERE Activiteit_id = 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $Act_title = $row['Act_Title'];
  }

  // Get the Info from the database
  $sql = "SELECT Act_Info FROM ACTIVITEIT WHERE Activiteit_id = 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $ActInfo = $row['Act_Info'];
  }

  // Get the Date from the database
  $sql = "SELECT Datum FROM ACTIVITEIT WHERE Activiteit_id = 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $ActDate = $row['Datum'];
  }

  echo '<div class="info_activiteit">';
  echo '<h4>' . $Act_title . '</h4>';
  echo '<p>' . $ActInfo . '</p>';
  echo '<p>' . $ActDate . '</p>';
  echo '</div>';

  ?>