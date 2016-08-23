<?php
include_once("pdo.php");
include_once("utilities.php");

$query = "
  SELECT
    userid,
    first_name,
    last_name,
    phone_number,
    city,
    email
  FROM users_info
";

if($result = $SQL->query( $query ))
{
  while($row = $SQL->fetch($result)){
    // Fetch successful
    ?>
    <div>
      <a href="/realestate/realtorPersonalPage.php?userid=<?= $row["userid"] ?>">
        <h3><?= $row["first_name"] ?></h3>
        <?= $row["last_name"] ?>
      </a>
      <hr />
    </div>
    <?php
  }
}

?>
