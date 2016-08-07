<?php
include_once("pdo.php");

$query = "
  SELECT

    homeid,
    address,
    city,
    state,
    images
  FROM user_listings
";

if($result = $SQL->query($query))
{
  while($row = $SQL->fetch($result)){
    // Fetch successful
    ?>
    <div>
      <img src="userHomeImages/<?= $row["images"] ?>">
    <div>
    <div>
      <a href="/realestate/listing.php?homeid=<?= $row["homeid"] ?>">
        <h3><?= $row["address"] ?></h3>
        <?= $row["city"] ?>, <?= $row["state"] ?>
      </a>
      <hr />
    </div>
    <?php
  }
}
?>
