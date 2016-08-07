 <?php
include_once( "pdo.php" );
include( "dataValidation.php" );
include_once( "utilities.php" );

// If the user is logged in
//if( isset( $_SESSION[ "userID" ] ) == true )
if( LOGGED_IN == true )
{
  // Redirect to homepage
  header( "Location: http://marcc.club/realestate/index.php" );
  exit( );
}

function login($email, $password, $SQL) {

  if( isValidEmail( $email ) == false )
  {
    // Invalid
  }
  else if( isValidPassword( $password ) == false ) {
    // Invalid
  }
  else {
    // Select the record that matches the specified email and password
    $query = "
        SELECT
        *
        FROM
        users_info
        WHERE
        email = ?
    ";

    // ' OR 1=1 #ffttfg!

    // If the query was successful
    if( $result = $SQL->query($query,$email) )
    {

      // If the query returned any records
      if( $row = $SQL->fetch( $result ) ) {

        // If the password matches the hash
        if( password_verify( $password, $row[ "password_hash" ] ) == true )
        {
          $_SESSION[ "userID" ] = $row[ "userid" ];

          // Redirect to homepage
          header( "Location: http://marcc.club/realestate/index.php" );
          exit( );
        }
        else{
          echo "Incorrect email/password.";
        }
      }
      else {
        echo "Incorrect email/password.";
      }
    }
  }
}

// If this was a form submission
if( empty( $_POST ) == false)
{
  $email = $_POST["email"];
  $password = $_POST["password"];


  login($email,$password,$SQL);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include( "pageHeader.php" ); ?>
<div class="container">
  <h2>Login</h2>
  <form role="form" action="" method="POST">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password">
    </div>
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
