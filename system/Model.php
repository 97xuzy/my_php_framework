<?php
class Model
{
	protected $mysqli;
	protected function ConnectDB()
	{
		$this->mysqli = new mysqli("localhost", "root", "", "blog");
		
		if ($this->mysqli->connect_errno)
		{
			die("Connect failed: ".$this->mysqli->connect_error);
		}
		
	}
	
	protected function CloseDBConnection()
	{
		$this->mysqli->close();
	
	}
	protected function DB_Query($SQL_Command)
	{
		$result = $this->mysqli->query ( $SQL_Command );
		
		if( $result->num_rows > 1 )
		{
			/*
			echo "<p>-----Query From DB-----</p>";
			for($i = 0; $i < $result->num_rows; $i++)
			{
				$row = $result->fetch_array(MYSQLI_ASSOC);
				foreach ($row as &$item)
				{
					echo "<p>".$item."</p>";
				}
				
			}
			echo "<p>--------------------</p>";
			*/
			
			//$result->free();
			return $result;
		}
		else if( $result->num_rows == 1 )
			return $result;
		else
		{
			echo "<p>Query Result is NOT a Array.</p>";
			$result->free();
			return 0;
		}
		
	}
	
	
}
