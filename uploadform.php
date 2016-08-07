<?php
include_once( "pdo.php" );
include_once( "utilities.php" );
include_once( "dataValidation.php" );
// If the user is not logged in
//if( isset( $_SESSION[ "userID" ] ) == false )
if(LOGGED_IN == false)
{
  // Redirect to homepage
  header( "Location: http://marcc.club/realestate/index.php" );
  exit( );
}

// If this was a form submission
if( empty( $_POST ) == false)
{
  //$SQL = new SQL( );

  $email = $_POST["email"];
  $phoneNumber = $_POST["phoneNumber"];
  //$firstName = $_POST["firstName"];
  //$lastName = $_POST["lastName"];
  $bedrooms = $_POST["bedrooms"];
  $bathrooms = $_POST["bathrooms"];
  $basementType = $_POST["basement"];
  $address = $_POST["address"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $price = $_POST["price"];

  $imageDirectory = "userHomeImages/";

  // Get the type/extension of the file
  $imageFileType = pathinfo( $_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION );
  // Create a new file name with the total file count
  $imageFileName = getFileCount( $imageDirectory ) . "." . $imageFileType;

  $targetFile = $imageDirectory . $imageFileName;

  $basementTypeID = getBasementTypeID($SQL, $basementType);

  // Foreign keys
  // User ID
  $userID = $_SESSION[ "userID" ];

  // Data validation
  if( isValidImage( $imageDirectory, $imageFileName ) == false ){
    // Invalid
  }
  else if( move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile) == false ){
    // Invalid
    echo "Sorry, there was an error uploading your file.";
  }
  //Data validation email
  else if ( isValidEmail($email) == false) {
    // Invalid
  }
  else if (isValidPhoneNumber($phoneNumber) == false) {
  }
  else if (isValidAddress($address) == false) {
  }
  else if (isValidCity($city) == false) {
  }
  else if (isValidState($state) == false) {
  }
  else if (isValidPrice($price) == false) {
  }
  else if (isValidBedrooms($bedrooms)==false){
  }
  else if (isValidBathrooms($bathrooms)==false){
  }
  else if (isValidBasementTypeID($basementTypeID)==false) {
  }
  else
  {
    // Insert the house listing
    $query = "
      INSERT INTO user_listings ( email, phone_number, address, city, state, price, bedrooms,
                         bathrooms, basement_type_id, images, listingDate, user_id )
      VALUES
      ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), " . USER_ID . " )
    ";
    //Valid
    // Run query
    if( $result = $SQL->query( $query, $email, $phoneNumber,
      $address, $city, $state, $price, $bedrooms,
      $bathrooms, $basementTypeID, $imageFileName ) ) {
      echo "Thanks for your listing.";
    }

  }
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include( "pageHeader.php" ); ?>
<div class="container">
  <h2>Create a listing post</h2>
  <form role="form" method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" name="email" placeholder="Enter email" value="<?php echo $email; ?>">
    </div>
    <div class="form-group">
      <label for="phoneNumber">Phone Number:</label>
      <input type="phoneNumber" class="form-control" name="phoneNumber" placeholder="Enter phone number" value="<?php echo $phoneNumber; ?>">
    </div>
    <div class="form-group">
      <label for="address">address:</label>
      <input type="text" class="form-control" name="address" placeholder="Enter address" value="<?php echo $address; ?>">
    </div>
    <div class="form-group">
      <label for="city">City:</label>
      <input type="text" class="form-control" name="city" placeholder="Enter city" value="<?php echo $city; ?>">
    </div>
    <div class="form-group">
      <label for="state">state:</label>
      <input type="text" class="form-control" name="state" placeholder="Enter state" value="<?php echo $state; ?>">
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="text" class="form-control" name="price" placeholder="Enter price" value="<?php echo $price; ?>">
    </div>
    <div class="form-group">
      <label for="image">Upload image file</label>
      <input type="file" name="fileToUpload" id="image">
    </div>

    <!-- <div class="form-group">
      <label for="firstName">First Name:</label>
      <input type="firstName" class="form-control" name="firstName" placeholder="Enter first name" value="<?php echo $firstName; ?>">
    </div>
    <div class="form-group">
      <label for="lastName">Last Name:</label>
      <input type="lastName" class="form-control" name="lastName" placeholder="Enter last name" value="<?php echo $lastName; ?>">
    </div> -->

    <div class="form-group">
      <label for="sel1">bedrooms</label>
      <select class="form-control" id="sel1" name="bedrooms">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </select>
      <div class="form-group">
        <label for="sel1">bathrooms</label>
        <select class="form-control" id="sel1" name="bathrooms">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
        <div class="radio">
          <label>
            <input type="radio" name="basement" value="noBasement"
            <?php saveChecked( "basement", "noBasement", true ) ?>> No Basement
          </label>
          <label>
            <input type="radio" name="basement" value="finished"
            <?php saveChecked( "basement", "finished", false ) ?>> Finished Basement
          </label>
          <label>
            <input type="radio" name="basement" value="unfinished"
            <?php saveChecked( "basement", "unfinished", false ) ?>> UnFinished Basement
          </label>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
