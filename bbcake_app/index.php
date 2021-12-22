<?php include_once $_SERVER["DOCUMENT_ROOT"]."/bbcake_backend/globals.php"; ?>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."/bbcake_backend/page_builder.php"; ?>


<?php
	$glob = Globalsx::getInstance();

	$products = $glob->getProductMng()->getAllProducts();
	
	function getChildsLightboxContent($products)
	{
		$retval;
	
		foreach($products as $sprod)
		{
			if( $sprod->prod_pid == 0 )
			{
				$spr = HTML::render('lightbox_item',
					array(	'prod_ufu' => $sprod->ufu
						, 'prod_id' => $prod->prod_id
						, 'prod_name' => $sprod->prod_name
						, 'prod_descr' => $sprod->prod_descr
						, 'photo_num' => 1
						, 'caption_class' => "fh5co-text"
						, 'prod_caption' => $sprod->prod_name
						, 'lightbox_item_class' => ""
						, 'href' => "/catalog/".$sprod->ufu
					)
				);
				$retval = $retval.$spr;
			}
		}
		
		return $retval;
	}
	
	
	
	$lightbox = PageBuilder::getLightboxWithExtContent(getChildsLightboxContent($products), "Часто спрашивают:", "");
	echo PageBuilder::getMainPage($lightbox);
?>