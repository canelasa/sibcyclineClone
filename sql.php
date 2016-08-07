<?php
// TODO:
// Prevent sql injection with PDO
// Class: a collection of variables and functions

// A class that automatically handles some mysql work
class SQL
{
  // Properties and methods
  // Variables and functions
  public $connection = null;

  // Constructor: a method that is called when you instanciate the class
  //              *it must have the same name as the class*
  public function SQL( ){
    $this->connection = mysqli_connect( "127.0.0.1", "annacan1_real", "realestate", "annacan1_realestate" );
  }

  public function query( $query ){
    $result = mysqli_query( $this->connection, $query );

    // If the query failed
    if( $result == false ) {
      echo "Error in " . __FILE__ . "<br />";
      echo "Query: $query <br />";
      echo "Error: " . mysqli_error( $this->connection );
    }

    return $result;
  }


  public function fetch( $result ){

    return mysqli_fetch_assoc( $result );
  }

  // Destructor: a method that is called when an instance is destroyed
  //            *normally when the script/page ends*
  public function __destruct( ){
    mysqli_close( $this->connection );
  }
}

// Make an instance of the class
//$Instance = new SQL( );

?>
