<?php include_once $_SERVER["DOCUMENT_ROOT"]."/event_backend/render.php"; ?>

<?php

class PageBuilder
{

	public function __construct()
	{
		//
	}
	
	
	static private function getLightboxContent($prod_id, $products, $caption_class, $item_class)
	{
		$retval;
	
		foreach($products as $sprod)
		{
			if( $sprod->prod_id == $prod_id )
			{
				$looper = $sprod->photos_count;
				while($looper > 0)
				{
					$spr = HTML::render('lightbox_item',
						array(	'prod_ufu' => $sprod->ufu
							, 'prod_id' => $prod->prod_id
							, 'prod_name' => $sprod->prod_name
							, 'prod_descr' => $sprod->prod_descr
							, 'photo_num' => $looper
							, 'lightbox_item_class' => $item_class
							, 'href' => "/images/products/".$sprod->ufu."-".$looper.".jpg"
							//, 'prod_caption' => $sprod->prod_name
							//, 'caption_class' => $caption_class
						)
					);
					$retval = $retval.$spr;
				
					$looper--;
				}
			}
		}
		
		return $retval;
	}
	
	static public function getLightbox($prod_id, $products, $caption, $descr, $item_class)
	{
		$lightboxContent = self::getLightboxContent($prod_id, $products, "fh5co-text", $item_class);
	
		return self::getLightboxWithExtContent($lightboxContent, $caption, $descr);
	}
	
	static public function getLightboxWithExtContent($lightboxContent, $caption, $descr)
	{
		if( strlen($lightboxContent) == 0 )
		{
			return "";
		}
		
		return HTML::render('lightbox_list',
				array(	'lightbox_items' => $lightboxContent
					, 'lightbox_caption' => $caption
					, 'lightbox_descr' => $descr
				)
			);
	}
	
	/*
	static private function getMenuItem($product, $name_prefix)
	{
		return HTML::render('main_menu_item',
					array(	'item_url' => $product->ufu
						, 'item_name' => $name_prefix.$product->prod_name
					)
				);
	}
	
	static private function getMenuItemChilds($prod_id, $products)
	{
		$retval;
		
		foreach($products as $sprod)
		{
			if($sprod->prod_pid == $prod_id)
			{
				$retval = $retval.self::getMenuItem($sprod, "");
			}
		}
		
		return $retval;
	}
	*/
	
	static private function getMainMenu()
	{
		/*
		$menuContent;
		foreach ($products as $sprod) 
		{
		
			if( $sprod->prod_pid == 0 )
			{
				$menuContent = $menuContent.self::getMenuItem($sprod, "");
			}
		
			$menuContent = $menuContent.self::getMenuItemChilds($sprod->prod_id, $products);
		}
		*/
		
		$retval = HTML::render('main_menu',
					array()
				);

		return $retval;
	}
	
	static public function getCatalogPage($lightbox, $lightbox_childs, $product)
	{
	
		$catalog_content = HTML::render('catalog_page_content',
					array(	 'lightbox_content' => $lightbox
						, 'lightbox_childs_content' => $lightbox_childs
						, 'prod_name' => $product->prod_name
						, 'prod_descr' => $product->prod_descr
						, 'product_bg' => $product->self_background ? $product->ufu : "default"
						, 'price' => $product->price
					)
				);
	
		$retval = HTML::render('main_template',
				array(	'page_title' => $product->page_title
					, 'page_descr' => $product->page_descr
					, 'page_keywords' => $product->page_keywords
					, 'main_menu' => self::getMainMenu()
					, 'product_bg' => $product->self_background ? $product->ufu : "default"
					, 'page_content' => $catalog_content
				)
			);
			
		return $retval;
	}
	
	static public function getContactPage()
	{
	
		$contact_content = HTML::render('contact_page_content',
					array(	 'page_bg' => "default"
					)
				);


		$retval = HTML::render('main_template',
				array(	'page_title' => "Контакты"
					, 'page_descr' => "Контакты"
					, 'page_keywords' => "Контакты"
					, 'main_menu' => self::getMainMenu()
					, 'product_bg' => "default"
					, 'page_content' => $contact_content
				)
			);
			
		echo $retval;
	}
	
	static public function getMainPage()
	{
	
		$retval = HTML::render('index',
				array(	'page_title' => "Десерты на заказ в Москве и МО - торты, пирожные, сладости"
					, 'page_descr' => "Частная кондитерская предлагает качественные торты и десерты на заказ с доставкой по Москве и МО"
					, 'page_keywords' => "детский торт макаронс свадебный торт зефир мусовый торт мужской торт капкейк"
					, 'main_menu' => self::getMainMenu()
					, 'product_bg' => "default"
					, 'page_content' => $main_content
				)
			);
			
		echo $retval;
	}
}
?>