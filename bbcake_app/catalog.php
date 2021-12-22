<?php include_once $_SERVER["DOCUMENT_ROOT"]."/bbcake_backend/globals.php"; ?>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."/bbcake_backend/render.php"; ?>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."/bbcake_backend/page_builder.php"; ?>


<?php
	$glob = Globalsx::getInstance();

	$products = $glob->getProductMng()->getAllProducts();
	$product;
	
	$product_ufu = $_GET["p"];
		
	foreach($products as $prod)
	{
		if( $prod->ufu == $product_ufu )
		{
			$product = $prod;
			break;
		}
	}
	
	if(!$product)
	{
		echo "404 error!";
	}
	
	
	function getChildsLightboxContent($prod_id, $products, $exclude_prod_id)
	{
		$retval;
		$prod_pid = 0;
	
		foreach($products as $sprod)
		{
			if( $sprod->prod_id == $prod_id && $sprod->prod_pid > 0 )
			{
				$prod_pid = $sprod->prod_pid;
			}
		
			if( $sprod->prod_pid == $prod_id && $sprod->prod_id != $exclude_prod_id )
			{
				$spr = HTML::render('lightbox_item',
					array(	'prod_id' => $prod->prod_id
						, 'prod_ufu' => $sprod->ufu
						, 'photo_num' => 1
						, 'prod_name' => $sprod->prod_name
						, 'prod_descr' => $sprod->prod_descr
						, 'caption_class' => "fh5co-text"
						, 'prod_caption' => $sprod->prod_name
						, 'lightbox_item_class' => ""
						, 'href' => "/catalog/".$sprod->ufu
					)
				);
				$retval = $retval.$spr;
			}
		}
		
		if( $prod_pid > 0 && strlen($retval) == 0 )
		{
			$retval = getChildsLightboxContent($prod_pid, $products, $prod_id);
		}
		
		return $retval;
	}
	
	
	
	$lightbox_childs = PageBuilder::getLightboxWithExtContent(getChildsLightboxContent($product->prod_id, $products, 0), $prod->prod_name." и немного больше:", "");
	$lightbox = PageBuilder::getLightbox($product->prod_id, $products, $product->lightbox_caption, $product->lightbox_descr, "image-popup");
		
	echo PageBuilder::getCatalogPage($lightbox, $lightbox_childs, $product);
?>