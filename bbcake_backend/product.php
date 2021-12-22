<?php

class Product
{
	public $prod_id;
	public $prod_pid;
	public $prod_name;
	public $prod_descr;
	public $prod_sort;
	public $prod_active;
	public $photos_count;
	public $ufu;
	public $page_title;
	public $page_descr;
	public $page_keywords;
	public $lightbox_caption;
	public $lightbox_descr;
	public $self_background;
	public $price;

	// Constructor
	public function __construct($prod_id, $prod_pid, $prod_name, $prod_descr, $photos_count, $is_active, $prod_sort, $ufu, $page_title, $page_descr, $page_keywords, $lightbox_caption, $lightbox_descr, $self_background, $price)
	{
		$this->prod_id = $prod_id;
		$this->prod_pid = $prod_pid;
		$this->prod_name = $prod_name;
		$this->prod_descr = $prod_descr;
		$this->prod_sort = $prod_sort;
		$this->prod_active = $is_active;
		$this->photos_count = $photos_count;
		$this->ufu = $ufu;
		$this->page_title = $page_title;
		$this->page_descr = $page_descr;
		$this->page_keywords = $page_keywords;
		$this->lightbox_caption = $lightbox_caption;
		$this->lightbox_descr = $lightbox_descr;
		$this->self_background = $self_background;
		$this->price = $price;
	}

}

?>