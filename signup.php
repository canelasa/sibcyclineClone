<?php

// Get all there is to know about your installation of PHP
//phpinfo( );

include_once( "pdo.php" );
include_once( "dataValidation.php" );
include_once("utilities.php");

// If this was a form submission
if( empty( $_POST ) == false )
{
  $email = $_POST["email"];
  $password = $_POST["password"];
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $phoneNumber = $_POST["phoneNumber"];
  $city = $_POST["city"];
  // Data validation:
  // If the email is an invalid email address
  if ( isValidEmail($email) == false) {
    // Invalid
  }
  else if( isEmailTaken( $email, $SQL ) == true )
  {
    // Invalid
  }
  else if (isValidPassword($password) == false) {
    // Invalid
  }
  else if (isValidFirstName($firstName) == false) {
    // Invalid
  }
  else if (isValidLastName($lastName) == false) {
    //Invalid
  }
  else if (isValidPhoneNumber($phoneNumber) == false) {

  }
  else if (isValidCity($city) == false) {

  }
  else
  {
    // Salt: extra characters added to a password before hashing
    $passwordHash = password_hash( $password, PASSWORD_DEFAULT );

    // Insert the data into the user_info table
    $query = "
      INSERT INTO users_info (email, password_hash, first_name, last_name, phone_number, city, signupDate)
      VALUES (?,?,?,?,?,?, NOW())
    ";

    // Run query
    if( $result = $SQL->query($query,$email,$passwordHash,$firstName,$lastName,$phoneNumber,$city)){
        echo "Thanks for signing up!";
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
  <h2>Sign Up</h2>
  <form role="form" method="POST" action="">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?php echo $email; ?>">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php echo $password; ?>">
    </div>
    <div class="form-group">
      <label for="firstName">First Name:</label>
      <input type="firstName" class="form-control" name="firstName" placeholder="Enter first name" value="<?php echo $firstName; ?>">
    </div>
    <div class="form-group">
      <label for="lastName">Last Name:</label>
      <input type="lastName" class="form-control" name="lastName" placeholder="Enter last name" value="<?php echo $lastName; ?>">
    </div>
    <div class="form-group">
      <label for="phoneNumber">Phone Number:</label>
      <input type="phoneNumber" class="form-control" name="phoneNumber" placeholder="Enter phone number" value="<?php echo $phoneNumber; ?>">
    </div>
    <div class="form-group">
      <label for="city">City:</label>
      <input type="city" class="form-control" name="city" placeholder="Enter your city" value="<?= $city ?>">
    </div>
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
