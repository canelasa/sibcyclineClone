<?php
include_once("utilities.php");
include_once("pdo.php");


$query = "
  SELECT

    homeid,
    address,
    city,
    state
  FROM user_listings
  WHERE
    user_id = " . USER_ID;



if($result = $SQL->query($query))
{
  while($row = $SQL->fetch($result)){
    // Fetch successful
    ?>
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
