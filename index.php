<?php
include_once( "utilities.php" );
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>real estate</title>
        <link href="reset.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
      <?php include( "pageHeader.php" ); ?>

        <div id="header"><h1>NKY REAL ESTATE</h1></div>
        <div id="main">
            <div class="row">;

				<form method="GET">
					<div class="row">
						<label>State</label>
						<select id="state" name="state">
							<option value="A">All</option>
							<option value="ky">Kentucky</option>
							<option value="oh">Ohio</option>
						</select>
					</div>
					<div class="row">
						<label>City</label>
						<input name="city" type="text" id="city" />
					</div>
					<div class="row">
						<input type="submit" id="searchBtn" value="Search" />
					</div>
				</form>

            </div>
            <div id="results">
              <?php
              include_once( "pdo.php" );
    					// All variables passed to this file via GET will be in the $_GET array
    					$state = $_GET[ "state" ];
    					$city = $_GET[ "city"];

    					// Whenever you want to run a MySQL query, you need to...
    					// 1. Open a connection to the database
    					// 2. Run your query and store the results if applicable
    					// 3. Close the database connection

    					//$connection = mysqli_connect( "127.0.0.1", "annacan1_real", "realestate", "annacan1_realestate" );


    					$query = "
    					SELECT
    						*
    					FROM
    						user_listings
    					WHERE
    						city LIKE ?
    					AND
    						(state = ?
    					OR
    						? = 'A')
    					";

              if($result = $SQL->query($query,"%$city%",$state,$state)){
  	            // --------------- -----------------------------------
      					// Process results
      					// --------------------------------------------------

      					// If any records/rows were returned
      					if( $SQL->rowCount() > 0 )
      					{
      						// Output the results

      						// Loop through each record/row
      						// mysqli_fetch_assoc() iterates through the rows until there are none left
      						while( $row = $SQL->fetch())
      						{
      							//echo $row[ "user_id" ] . " " . $row[ "name" ] . "<br />";

      							// TODO: Change data to users data from database

      							echo
      							"<div class='home-row'>
      							   <img src='images/" . $row[ "images" ] . "' />
      							   <div class='home-info'>
      								   <div>" . $row ["state"] . "</div>
      								   <div>" . $row ["city"] . "</div>
      							   </div>
      								<button><a href='contact.html'>Schedule a house showing</a></button>
      							</div>";

      						}
      					}
              }
              // If the query did fail
              else
              {
                echo "Error: " . mysqli_error( $connection );
              }

    				?>
            </div>
        </div>
        <script src="script.js"></script>

    </body>
</html>
