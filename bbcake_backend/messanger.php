<?php

class Messanger
{
	private $_db;

	public function __construct($db) 
	{
		$this->_db = $db;
	}

	public function saveMessage($name, $email, $message)
	{
		$rows_affected = 0;

		if( $stmt = $this->_db->prepare("insert into messages(name, email, message) values(?, ?, ?);") )
		{
			$stmt->bind_param("sss", $name, $email, $message);
			$stmt->execute();

			$rows_affected = $stmt->affected_rows;
			$stmt->close();
		}else{
			echo $this->_db->error;
		}

		return $rows_affected;
	}
}
?>