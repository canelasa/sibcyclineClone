<?php

include_once("pdo.php");
session_start( );

define( "PASSWORD_PEPPER", "5[}5%fes0" );
define( "LOGGED_IN", isset( $_SESSION[ "userID" ] ) );

if( LOGGED_IN == true )
{
  define( "USER_ID", $_SESSION[ "userID" ] );
}
else {
  define( "USER_ID", 0 );
}
/*
if( isset( $_SESSION[ "userID" ] ) == true ) echo "userID IS SET";
else echo "userID IS NOT SET";
echo "<br>";
if( defined("LOGGED_IN") == true ) echo "LOGGED_IN IS SET";
else echo "LOGGED_IN IS NOT SET";
echo "<br>";
if( LOGGED_IN == true ) echo "LOGGED_IN IS TRUE";
else echo "LOGGED_IN IS FALSE";
*/

// Get the basement type ID given the basement type
function getBasementTypeID( $SQL, $basementType )
{
  $basementTypeID = 0;

  // Basement type ID
  // Select the basement type where the basement type = $basementType
  $query = "
    SELECT basement_type_id
    FROM basement_types
    WHERE
    basement_type = '$basementType'
  ";

  // Run query
  $result = $SQL->query($query);

  if( $row = $SQL->fetch() ) {
    $basementTypeID = $row[ "basement_type_id" ];
  }else {
    echo "error: No basement type id";
  }

  return $basementTypeID;
}

// Get the number of files in the specified directory
function getFileCount ($directory){

  $iterator = new FilesystemIterator($directory, FilesystemIterator::SKIP_DOTS );
  return iterator_count( $iterator );

}

// Echo the checked attribute if the specified input element was checked
function saveChecked( $name, $value, $default )
{
  // If the user did not select an option last time
  if( $default == true && isset( $_POST[ $name ] ) == false ){
    echo "checked=checked";
  }
  else if( $_POST[ $name ] == $value ){
    echo "checked=checked";
  }
}

// Return the class name for an active link if this is the specified page
function activePage( $page )
{
  if( basename( $_SERVER[ "PHP_SELF" ] ) == $page )
  {
    return "active";
  }
  else
  {
    return "";
  }
}

?>
