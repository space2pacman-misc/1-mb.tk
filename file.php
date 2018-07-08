<!DOCTYPE html>
<html>
<head>
	<title>1 MB file-sharing service</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initale-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
<?php
	include("db.php");

	$link = $_GET["link"];

	$query = mysql_query("SELECT * FROM files WHERE file_link = '$link'");
	$result = mysql_fetch_array($query, MYSQL_ASSOC);
	if($result) {
		echo "<div class='file-block'>
				<a class='file-link' href='".$result["file_url"]."' download>Скачать</a>
			</div>";
	} else {
		echo "<div class='file-block'>Файл не найден</div>";
	}
?>
</body>
</html>