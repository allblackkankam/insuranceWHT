<?php
	$target_dir = "/app-assets/images/cars";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);

	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
	   $status = 1;
}