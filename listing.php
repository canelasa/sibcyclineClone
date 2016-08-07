<?php
include_once("pdo.php");


if( isset( $_GET["homeid"] ) == false ){
  header("Location:http://www.marcc.club/realestate");
  exit();
}

$homeID = $_GET["homeid"];


$query = "
  SELECT

    homeid,
    address,
    city,
    state,
    images
  FROM user_listings
  WHERE
    homeid = ?
";

// If the query failed
if($result = $SQL->query($query,$homeID)){

  if ( $row = $SQL->fetch( $result ) ){
    // Fetch successful
  }else{
    header("Location: http://www.marcc.club/realestate");
    exit();
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Listing page</title>
  </head>
  <body>

    <div>
      <img src="userHomeImages/<?= $row["images"] ?>" />

        <h3><?= $row["address"] ?></h3>
        <?= $row["city"] ?>, <?= $row["state"] ?>
      </p>
      <hr />
    </div>

    <!--
    <div class="homepic">
    </div>
    <div class="homeinfo">
      <h3>Listing Details</h3>
    </div>
  -->
  </body>
</html>
