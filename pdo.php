<?php

// PDO class
class CPDO
{
	protected $SQL = null;
	protected $Statement = null;
	protected $aRow = null;

	public function CPDO( $strHost, $strUser, $strPassword, $strDatabase )
	{
		try
		{
			$this->SQL = new PDO( "mysql:dbname=" . $strDatabase . ";host=" . $strHost, $strUser, $strPassword );
			$this->SQL->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
			$this->SQL->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch( PDOException $e )
		{
			error_log( "Error in " . __FILE__ . ".php: " . $e->getMessage( ) . "\n" );
			die( );
		}
	}

	public function query( $strQuery )
	{
		$blnResult = false;

		try
		{
			$aParameters = func_get_args( );

			// If the query parameters were passed in via an array
			if( isset( $aParameters[ 1 ] ) == true &&
				is_array( $aParameters[ 1 ] ) == true )
			{
				$aParameters = $aParameters[ 1 ];
			}
			else
			{
				// Create an array from the query parameters
				$aParameters = array_slice( func_get_args( ), 1 );
			}

			$intParameterCount = count( $aParameters );

			if( $this->Statement != null )
			{
				$this->Statement->closeCursor( );
			}

			// If there are query parameters
			if( $intParameterCount > 0 )
			{
				$this->Statement = $this->SQL->prepare( $strQuery );

				if( $this->Statement == false )
				{
					error_log( "Error in " . __FILE__ . ".php: Failed to prepare statement.\n\n" );
					error_log( "Query: " . $strQuery . "\n\n" );
				}
				else
        {
  				for( $intIndex = 0; $intIndex < $intParameterCount; $intIndex += 1 )
  				{
  					$this->Statement->bindParam( $intIndex + 1, $aParameters[ $intIndex ] );
  				}

  				//print_r( $this->Statement->errorInfo( ) );

  				$blnResult = $this->Statement->execute( );
        }
			}
			else
			{
				$this->Statement = $this->SQL->query( $strQuery );

				$blnResult = true;
			}
		}
		catch( PDOException $e )
		{
			error_log( "Error in " . __FILE__ . ".php: " . $e->getMessage( ) . "\n\n" );
			error_log( "Query: " . $strQuery . "\n\n" );
			exit( );
		}

		return $blnResult;
	}

	public function fetch( )
	{
		try
		{
			$this->aRow = $this->Statement->fetch( PDO::FETCH_BOTH );
		}
		catch( PDOException $e )
		{
			error_log( "Error in " . __FILE__ . ".php: " . $e->getMessage( ) . "\n\n" );
			die( );
		}

		return $this->aRow;
	}


	public function GetRow( )
	{
		return $this->aRow;
	}

	public function rowCount( )
	{
		return $this->Statement->rowCount( );
	}

	public function LastInsertID( )
	{
		return $this->SQL->lastInsertId( );
	}

	public function __destruct(  )
	{
		if( $this->Statement != null ) $this->Statement->closeCursor( );
	}
}

$SQL = new CPDO( "127.0.0.1", "annacan1_real", "realestate", "annacan1_realestate" );


?>
