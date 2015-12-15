<?php

$ds          = DIRECTORY_SEPARATOR;
$storeFolder = 'uploads';

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
    move_uploaded_file($tempFile,$targetFile); //6

    foreach ($_FILES['file'] as $key => $value) {
      echo $key . ">" . $value . "<br>";
    }

    include 'createThumbs.php';
    createAThumb($targetFile, "uploads/thumbs/",200);

}

?>
