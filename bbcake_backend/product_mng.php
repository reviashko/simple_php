<?php include_once $_SERVER["DOCUMENT_ROOT"]."/bbcake_backend/product.php"; ?>

<?php

class Product_mng
{
	private $_db;

	public function __construct($db) 
	{
		$this->_db = $db;
	}

	public function getTopProducts222($count)
	{
	
		$retval = array();

		if( $stmt = $this->_db->prepare("SELECT prod_id, prod_pid, prod_name, prod_descr, photo_count, is_active, prod_sort, ufu_name, page_title, page_descr, page_keywords, lightbox_caption, lightbox_descr, self_background, price FROM products where prod_pid=0 LIMIT ?") )
		{
			$stmt->bind_param("d", $count);
			$stmt->execute();
			
			//$prod = new Product();
			$prod_id;
			$prod_pid;
			$prod_name;
			$prod_descr;
			$photos_count;
			$is_active;
			$prod_sort;
			$ufu;
			$page_title;
			$page_descr;
			$page_keywords;
			$lightbox_caption;
			$lightbox_descr;
			$self_background;
			$price;
			
			$stmt->bind_result($prod_id, $prod_pid, $prod_name, $prod_descr, $photos_count, $is_active, $prod_sort, $ufu, $page_title, $page_descr, $page_keywords, $lightbox_caption, $lightbox_descr, $self_background, $price);
			while($stmt->fetch())
			{
				array_push($retval, new Product($prod_id, $prod_pid, $prod_name, $prod_descr, $photos_count, $is_active, $prod_sort, $ufu, $page_title, $page_descr, $page_keywords, $lightbox_caption, $lightbox_descr, $self_background, $price));
			}
			
			
			$stmt->close();
		}else{
			echo $this->_db->error;
		}

		return $retval;
	}
	
	public function getParentProducts222($parent_id)
	{
	
		$retval = array();

		if( $stmt = $this->_db->prepare("SELECT prod_id, prod_pid, prod_name, prod_descr, photo_count, is_active, prod_sort, ufu_name, page_title, page_descr, page_keywords, lightbox_caption, lightbox_descr, self_background, price FROM products where prod_pid=? or prod_id=?") )
		{
			$stmt->bind_param("dd", $parent_id, $parent_id);
			$stmt->execute();
			
			//$prod = new Product();
			$prod_id;
			$prod_pid;
			$prod_name;
			$prod_descr;
			$photos_count;
			$is_active;
			$prod_sort;
			$ufu;
			$page_title;
			$page_descr;
			$page_keywords;
			$lightbox_caption;
			$lightbox_descr;
			$self_background;
			$price;
			
			$stmt->bind_result($prod_id, $prod_pid, $prod_name, $prod_descr, $photos_count, $is_active, $prod_sort, $ufu, $page_title, $page_descr, $page_keywords, $lightbox_caption, $lightbox_descr, $self_background, $price);
			while($stmt->fetch())
			{
				array_push($retval, new Product($prod_id, $prod_pid, $prod_name, $prod_descr, $photos_count, $is_active, $prod_sort, $ufu, $page_title, $page_descr, $page_keywords, $lightbox_caption, $lightbox_descr, $self_background, $price));
			}
			
			
			$stmt->close();
		}else{
			echo $this->_db->error;
		}

		return $retval;
	}
	
	public function getAllProducts()
	{
	
		$retval = array();

		if( $stmt = $this->_db->prepare("SELECT prod_id, prod_pid, prod_name, prod_descr, photo_count, is_active, prod_sort, ufu_name, page_title, page_descr, page_keywords, lightbox_caption, lightbox_descr, self_background, price FROM products") )
		{
			$stmt->execute();
			
			//$prod = new Product();
			$prod_id;
			$prod_pid;
			$prod_name;
			$prod_descr;
			$photos_count;
			$is_active;
			$prod_sort;
			$ufu;
			$page_title;
			$page_descr;
			$page_keywords;
			$lightbox_caption;
			$lightbox_descr;
			$self_background;
			$price;
			
			$stmt->bind_result($prod_id, $prod_pid, $prod_name, $prod_descr, $photos_count, $is_active, $prod_sort, $ufu, $page_title, $page_descr, $page_keywords, $lightbox_caption, $lightbox_descr, $self_background, $price);
			while($stmt->fetch())
			{
				array_push($retval, new Product($prod_id, $prod_pid, $prod_name, $prod_descr, $photos_count, $is_active, $prod_sort, $ufu, $page_title, $page_descr, $page_keywords, $lightbox_caption, $lightbox_descr, $self_background, $price));
			}
			
			
			$stmt->close();
		}else{
			echo $this->_db->error;
		}

		return $retval;
	}
}
?>