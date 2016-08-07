
<?php
include_once( "utilities.php" );
?>

<ul class="nav nav-tabs">
  <li class="<?= activePage( "index.php" ) ?>"> <a href="http://marcc.club/realestate/index.php">Home</a></li>

  <?php

  // If the user is not logged in
  if(LOGGED_IN == false )
  {
    ?>
    <li class="<?= activePage( "login.php" ) ?>"> <a href="http://marcc.club/realestate/login.php">Log in</a></li>
    <li class="<?= activePage( "signup.php" ) ?>"> <a href="http://marcc.club/realestate/signup.php">Sign Up</a></li>

    <?php
  }
  ?>

  <?php
  //if(isset($_SESSION["userID"]) == true )
  if( LOGGED_IN == true )
  {
    ?>

    <li class="<?= activePage( "useraccount.php" ) ?>"> <a href="http://marcc.club/realestate/useraccount.php">Account Profile</a></li>
    <li class="<?= activePage( "logout.php" ) ?>"> <a href="http://marcc.club/realestate/logout.php">Log Out</a></li>
    <li class="<?= activePage( "uploadform.php" ) ?>"> <a href="http://marcc.club/realestate/uploadform.php">Post A Listing</a></li>
    <?php
  }
  ?>
    <li class="<?= activePage( "listings.php" ) ?>"> <a href="http://marcc.club/realestate/listings.php">View Listings</a></li>
</ul>
