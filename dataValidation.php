<?php

function isValidEmail($email) {

  $isValid = true;

  // If the email address is invalid
  if ( preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email) == 0) {
    echo "Type in a valid email address";
    $isValid = false;
  }

  return $isValid;
}

// If the email exists in the database
function isEmailTaken( $email, $SQL ) {
  $isTaken = false;

  // If the email address has been used
  // If any user record has this email address
  // Select user records with this email address
  $query = "
      SELECT
      *
      FROM
      users_info
      WHERE
      email = ?
  ";

  $result = $SQL->query( $query, $email );

  // If the query returned any records
  if( $SQL->rowCount( ) > 0 ) {
    $isTaken = true;
    echo "That email address is already taken.";

  }

  return $isTaken;
}

function isValidPassword ($password) {
  $isValid = true;

  if (strlen($password)<7) {
    echo "Password must be at least 7 characters";
    $isValid = false;
  }
  // TODO: Use regex to ensure the password has at least one letter, number, and special character
  else if (strlen($password)>50) {
      echo "Password is too long";
      $isValid = false;
  }
  else if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%=\' ]{7,50}$/', $password)) {
      echo 'the password does not meet the requirements!';
      $isValid = false;
  }
  // else if ( preg_match("/^(?=.*\d)$", $password) == 0) {
  //   echo "Password Must include a number";
  //   $isValid = false;
  // }
  // else if ( preg_match("/^(?=.*[A-Za-z])$", $password) == 0) {
  //   echo "Must include letters";
  //   $isValid = false;
  // }
  // else if ( preg_match("/^(?=.*[A-Za-z])$", $password) == 0) {
  //   echo "Must include letters";
  //   $isValid = false;
  // }
  // else if ( preg_match("/^[0-9A-Za-z!@#$%]$", $password) == 0) {
  //   echo "Must include at least one special character";
  //   $isValid = false;
  // }

  return $isValid;
}


function isValidFirstName ($firstName) {
  $isValid = true;
  if ($firstName == "") {
    echo "Type in your first name";
    $isValid = false;
  }

  return $isValid;

}

function isValidLastName ($lastName) {
  $isValid = true;
  if ($lastName == "") {
    echo "Type in your last name";
    $isValid = false;
  }

  return $isValid;

}

function isValidPhoneNumber ($phoneNumber) {
  $isValid = true;

  if ($phoneNumber == "") {
    echo "Type in your phone number";
    $isValid = false;
  }
  else if (strlen($phoneNumber) != 10){
    echo "phone number must be 10 digits long";
    $isValid = false;
  }
  else if (preg_match("/^[0-9]*$/", $password) == false) {
    echo "phone number must be digits only";
    $isValid = false;
  }

  return $isValid;

}




function isValidImage($directory, $imageFileName){

  $directory = "userHomeImages/";
  $targetFile = $directory . $imageFileName;
  $uploadOk = true;
  $imageFileType = pathinfo( $targetFile, PATHINFO_EXTENSION );

  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

  if($check !== false) {
      //echo "File is an image - " . $check["mime"] . ".<br/>";
      $uploadOk = true;
  } else {
      echo "File is not an image.<br/>";
      $uploadOk = false;
  }

  // Check if file already exists
  if (file_exists($targetFile)) {
      echo "Sorry, file already exists.<br/>";
      $uploadOk = false;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.<br/>";
      $uploadOk = false;
  }

  // Allow certain file formats
  if($imageFileType != "jpg"
  && $imageFileType != "jpeg"
  && $imageFileType != "png"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br/>";
      $uploadOk = false;
  }

  return $uploadOk;
}

function isValidAddress ($address) {
  $isValid = true;
  if ($address == "") {
    echo "Type in the address";
    $isValid = false;
  }

  return $isValid;

}

function isValidCity ($city) {
  $isValid = true;
  if ($city == "") {
    echo "Type in the city";
    $isValid = false;
  }

  return $isValid;

}

function isValidState ($state) {
  $isValid = true;
  if ($state == "") {
    echo "Type in the state";
    $isValid = false;
  }

  return $isValid;

}

function isValidPrice ($price) {
  $isValid = true;

  if ($price == "") {
    echo "Type in a price";
    $isValid = false;
  }
  else if (preg_match("/^[0-9]*$/", $password) == false) {
    echo "price must be digits only";
    $isValid = false;
  }

  return $isValid;

}
function isValidBedrooms($bedrooms) {

  $isValid = false;

  if( $bedrooms == 1 ||
      $bedrooms == 2 ||
      $bedrooms == 3 ||
      $bedrooms == 4 ) {
    $isValid = true;
  }
  else {
    echo "An Error occured (Error 1001)";
  }

  return $isValid;
}

function isValidBathrooms($bathrooms) {
  $isValid = false;

  if( $bathrooms <= 3 && $bathrooms >= 1 ){
    $isValid = true;
  }
  else {
    echo "An Error occured (Error 1002)";
  }

  return $isValid;
}

function isValidBasementTypeID($basementTypeID) {
  $isValid = false;

  if($basementTypeID != 0) {
     $isValid = true;
  }
  else {
    echo "An Error occured (Error 1003)";
  }
  return $isValid;
}

?>
