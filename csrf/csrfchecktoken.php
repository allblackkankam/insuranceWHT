<?php
	if (session_status() == PHP_SESSION_NONE) 
	{
		$lifetime=86400;session_start();setcookie(session_name(),session_id(),time()+$lifetime,"/","","TRUE","TRUE");
	}
	
	if(isset($_SESSION["csrfToken"]) && isset($_POST["token"]))
	{
		
		if(hash_equals($_SESSION["csrfToken"],$_POST["token"])){
			
			
		}else{
			
			$WhatAction="CSRF";
		}
	}

	


?>