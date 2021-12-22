<?php include_once $_SERVER["DOCUMENT_ROOT"]."/bbcake_backend/db.php"; ?>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."/bbcake_backend/subscribe.php"; ?>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."/bbcake_backend/messanger.php"; ?>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."/bbcake_backend/product_mng.php"; ?>

<?php

class GlobalsX
{
	private $_subscr;
	private $_messanger;
	private $_mysqli;
	private $_product_mng;

	private static $_instance;

	private function __construct() 
	{
		$db = Database::getInstance();

		$this->_mysqli = $db->getConnection();
		$this->_subscr = new Subscriber($this->_mysqli);
		$this->_messanger = new Messanger($this->_mysqli);
		$this->_product_mng = new Product_mng($this->_mysqli);
	}

	public static function getInstance() 
	{
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __clone() { }

	public function getMysqli() 
	{
		return $this->_mysqli;
	}

	public function getSubscriber() 
	{
		return $this->_subscr;
	}

	public function getMessanger() 
	{
		return $this->_messanger;
	}
	
	public function getProductMng()
	{
		return $this->_product_mng;
	}

}

?>