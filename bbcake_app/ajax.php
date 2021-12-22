<?php

	include_once $_SERVER["DOCUMENT_ROOT"]."/bbcake_backend/globals.php";

	$glob = Globalsx::getInstance();

	$response = array();

	if( !empty($_POST["msg_send"]) )
	{
		if( empty($_POST["email"]) || empty($_POST["name"]) || empty($_POST["message"]) )
		{
			$response["success"] = false;
			$response["errors"] = "Не вск поля заполнены";
			$response["error_code"] = "EMPT";
		}else{

			try
			{
				$email = $_POST["email"];
				$name = $_POST["name"];
				$message = $_POST["message"];
				
				if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
				{
					$response["success"] = false;
					$response["errors"] = "Не корректный email";
					$response["error_code"] = "WRNG";
				}else
				if( $glob->getMessanger()->saveMessage($name, $email, $message) > 0 )
				{
					$response["success"] = true;
					$response["errors"] = "Спасибо за обращение!";
					$response["error_code"] = "ADDD";
				}

			}catch(Exception $e)
			{
				echo $e->getMessage();
			}
		}
	}else
	if( !empty($_POST["subscr_email"]) )
	{
		if( empty($_POST["email"]) )
		{
			$response["success"] = false;
			$response["errors"] = "Не указан email";
			$response["error_code"] = "EMPT";
		}else{

			try
			{
				$email = $_POST["email"];

				if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
				{
					$response["success"] = false;
					$response["errors"] = "Не корректный email";
					$response["error_code"] = "WRNG";
				}else{
					if( $glob->getSubscriber()->tryAddEmail($email) > 0 )
					{
						$response["success"] = true;
						$response["errors"] = "Спасибо. Вы подписаны";
						$response["error_code"] = "ADDD";
					}else{
						$response["success"] = false;
						$response["errors"] = "Спасибо! Вы подписались ранее";
						$response["error_code"] = "EXST";
					}
				}

			}catch(Exception $e)
			{
				echo $e->getMessage();
			}
		}
	}

/*
ob_start();
var_dump($_POST);
$response["debug"] = ob_get_clean();
*/


	echo json_encode($response);

?>