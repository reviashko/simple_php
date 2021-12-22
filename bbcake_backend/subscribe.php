<?php

class Subscriber
{
	private $_db;

	// Constructor
	public function __construct($db) 
	{
		$this->_db = $db;
	}

	public function tryAddEmail($email)
	{
		$rows_affected = 0;

		if( $stmt = $this->_db->prepare("insert into subscribs(email, email_hash) select ?, ? from dual where not exists(select 1 from subscribs where email=?)") )
		{

			$hash = md5($email, true);
			$email_hash = ord($hash[0])*16777216+ ord($hash[1])*65536+ ord($hash[2])*256+ ord($hash[3]);

			$stmt->bind_param("sds", $email, $email_hash, $email);
			$stmt->execute();

			$rows_affected = $stmt->affected_rows;
			$stmt->close();
		}else{
			echo $this->_db->error;
		}

		return $rows_affected;
	}

	public function checkEmail($email)
	{
		$retval = false;

		//password_hash("123123", PASSWORD_DEFAULT);

		if( $stmt = $this->_db->prepare("select email from subscribs where email=? limit 1") )
		{
			$stmt->bind_param("s", $email);
			$stmt->execute();

			$stmt->bind_result($email_column);
			while($stmt->fetch())
			{
				//echo $email_column;
				$retval = true;
			}

			$stmt->close();
		}

		return $retval;
	}
}

?>