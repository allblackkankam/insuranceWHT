<?php
	if (session_status() == PHP_SESSION_NONE) {
		$lifetime=86400;session_start();setcookie(session_name(),session_id(),time()+$lifetime,"/","","TRUE","TRUE");
	}
	$key=bin2hex(random_bytes(32));
	$digest=time();
	$_SESSION["csrfToken"]=hash_hmac("sha256","$digest",$key);


?>