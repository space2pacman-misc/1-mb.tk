<?php
	include("db.php");

	$file = $_FILES["file"];
	$max_size = 1000000;

	if($file["size"] > $max_size) {
		echo "Файл больше 1 МБ. <span class='anew'>Назад</span>";
	} else {
		loadFile();
	}

	function loadFile() {
			global $file;

			$tmp_dir = $file["tmp_name"];
			$dir = "files/";
			$link = generateRandomString();
			$file_name = $link."_".$file["name"];
			$new_dir = $dir.$file_name;

			move_uploaded_file($tmp_dir, $new_dir);
			mysql_query("INSERT INTO files(file_name, file_url, file_link) VALUES('$file_name','$new_dir','$link')");

			echo "$_SERVER[HTTP_HOST]/$link";
	}

	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
?>