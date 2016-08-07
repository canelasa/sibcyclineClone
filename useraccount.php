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

    <div>
     <h1>User Profile</h1>
     <p><?php echo $firstName . " " . $lastName; ?></p>
     <img src="https://www.sibcycline.com/agentphotos/AgentID/6671.jpg" alt="">
   </div>

<div class="userProfileBox">
    <button class="accordion">Profile</button>
    <div class="panel">
      <h1>Name: <?php echo $firstName . " " . $lastName; ?></h1>
      <h1>Email Address: <?php echo $email; ?></h1>
      <h1>Phone Number: <?php echo $phoneNumber; ?></h1>
    </div>

    <button class="accordion">About</button>
    <div class="panel">
      <p>Lorem ipsum...</p>
    </div>

    <button class="accordion">Listings</button>
    <div class="panel">
        <?php include( "personalListings.php" ); ?>
    </div>
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
    }
}
</script>
</body>

<!DOCTYPE html>
<html>
<head>
<style>
button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #ddd;
}

div.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: 0.6s ease-in-out;
    opacity: 0;
}

div.panel.show {
    opacity: 1;
    max-height: 500px;
}

button.accordion:after {
    content: '\02795'; /* Unicode character for "plus" sign (+) */
    font-size: 13px;
    color: #777;
    float: right;
    margin-left: 5px;
}

button.accordion.active:after {
    content: "\2796"; /* Unicode character for "minus" sign (-) */
}

</style>
</head>
<body>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}
</script>

</body>
</html>
