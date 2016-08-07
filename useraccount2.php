<?php
include_once( "utilities.php" );
include_once("pdo.php");

// Simulate a user logout
//unset( $_SESSION[ "userID" ] );

// If the user is not logged in
//if( isset($_SESSION["userID"]) == false )
if(LOGGED_IN ==false)
{
  // Redirect to another page
  header( "Location: http://marcc.club/realestate/index.php" );
  exit( );
}

$userID = $_SESSION[ "userID" ];


//$connection = mysqli_connect( "127.0.0.1", "annacan1_real", "realestate", "annacan1_realestate" );
$query = "
SELECT
  first_name,
  last_name,
  email,
  phone_number
FROM
  users_info
WHERE
 userid = ?
";


if($result = $SQL->query($query,$userID)){
   //valid
   if($row = $SQL->fetch($result)){
     $firstName = $row["first_name"];
     $lastName = $row["last_name"];
     $email = $row["email"];
     $phoneNumber = $row["phone_number"];
   }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User Profile</title>
    <link href="useraccount.css" rel="stylesheet">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
  <body>
    <?php include( "pageHeader.php" ); ?>
    <nav>
  <ul>
    <li tabindex="0">
      <b>Profile</b>
      <span>&rarr;</span>
      <div>
        <h1>Name: <?php echo $firstName . " " . $lastName; ?></h1>
        <h1>Email Address: <?php echo $email; ?></h1>
        <h1>Phone Number: <?php echo $phoneNumber; ?></h1>
      </div>
    </li>
    <li tabindex="0">
      <b>About</b>
      <span>&rarr;</span>
      <div>
        <h1>About Me</h1>
        <p>about the user</p>
      </div>
    </li>
    <li tabindex="0">
      <b>Listings</b>
      <span>&rarr;</span>
      <div>
        <?php include( "personalListings.php" ); ?>
      </div>
    </li>
    <li tabindex="0">
      <b>Buyers</b>
      <span>&rarr;</span>
      <div>
        <h1>Services for Buyers</h1>
        <p>free home showings (schedule now)</p>
        <p>Get prequalified (click here)</p>
      </div>
    </li>
    <li tabindex="0">
      <b>Manage listings</b>
      <span>&rarr;</span>
      <div>
        <h1>Current Listings</h1>
        <p>123 newman ave (Edit post)</p>
      </div>
    </li>
  </ul>
  <div>
    <h1>User Profile</h1>
    <p><?php echo $firstName . " " . $lastName; ?></p>
    <img src="https://www.sibcycline.com/agentphotos/AgentID/6671.jpg" alt="">
  </div>
</nav>
