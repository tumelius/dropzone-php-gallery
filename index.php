<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Lataa tiedostoja palvelimelle</title>
<link rel="stylesheet" href="./dropzone.css">
<style>
	.galleria div {

	}
	.galleria img {
		padding: 20px;
		width: 250px;
		height: 250px;
	}
	.thumb {
		float: left;
		padding: 20px;
		margin: 20px;
		border: 1px solid #666;
		width: 290px;
		height: 290px;
	}

</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container-fluid">
	<h1>Lataa tiedostoja projekti-palvelimelle</h1>
	<p>
	Lataa tiedostot palvelimelle raahaamalla ne tänne alla näkyvään laatikkoon. Voit raahata monta kuvaa kerralla. Jos selain ei tue raahaamista, voit ladata kuvan kerrallaan klikkaamalla aluetta ja valitsemalla kuvan
	</p>

	<!-- Change /upload-target to your upload address -->
	<form action="upload.php" class="dropzone">
	<div class="dz-message" data-dz-message><span>Pudota tiedostot tähän</span></div>
	</form>
</div>
<div class="galleria">
<?php
	define("UPLOAD_PATH",dirname(realpath(__FILE__)) . '/uploads/');
	$ext = array('jpg','png','jpeg');

	if (!file_exists(UPLOAD_PATH)) {
		mkdir(UPLOAD_PATH, 0777, true);
	}
	$handle = opendir(UPLOAD_PATH);
	while ($file = readdir($handle)){
		//if ($file !== "." && $file !== ".."){
		$fileInfo = pathinfo($file);
		if (array_key_exists('extension',$fileInfo) && in_array($fileInfo['extension'],$ext)){
			echo '<div class="thumb"><img src="uploads/thumbs/' . $file . '" alt="'.$file.'" title="'.$file.'"></div>&nbsp;';
		}
	}
?>
</div>
</body>
<script src="./dropzone.js"></script>
</html>
