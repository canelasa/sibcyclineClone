<?php
include_once("utilities.php");
?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Realtor Search</title>
   </head>
   <body>
     <?php include( "pageHeader.php" ); ?>

       <div id="header"><h1>Search for a Realtor</h1></div>
       <div id="main">
           <div class="row">

             <form class="" method="GET">
               First Name:  <input type="text" name="firstName"><br>
               Last Name: <input type="text" name="lastName"><br>
               City: <input type="text" name="city"><br>
               <input type="submit" value="submit">
             </form>
            <div id="results">
              Results
              <?php
              include_once("pdo.php");
              $firstName = $_GET["firstName"];
              $lastName = $_GET["lastName"];
              $city = $_GET["city"];

              $query = "
                SELECT
                  first_name,
                  last_name
                FROM
                  users_info
                WHERE
                  first_name LIKE '%$firstName%'
                  AND
                  last_name LIKE '%$lastName%'
                  AND
                  city LIKE '%$city%'
              ";

              if( $SQL->query($query) == true ) {
                while( $row = $SQL->fetch() ):

                ?>
                <p><?= $row["first_name"]." ". $row["last_name"].", ". $row["city"] ?></p>
                <?php
                endwhile;
              }
              ?>

            </div>

   </body>
 </html>
