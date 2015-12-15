<?php
/**
 * Created by PhpStorm.
 * User: Tumppi
 * Date: 30.11.2015
 * Time: 18.47
 */

function createAThumb( $originalImagePath, $pathToThumbs, $thumbWidth ){
    $fileInfo = pathinfo($originalImagePath);
    $ext = array('jpg','png');

    if (array_key_exists('extension', $fileInfo) && in_array($fileInfo["extension"], $ext)) {
        if ($fileInfo['extension'] == 'jpg') {
            $img = imagecreatefromjpeg($originalImagePath);
            $width = imagesx($img);
            $height = imagesy($img);

            $newWidth = $thumbWidth;
            $newHeight = floor($height * ($thumbWidth / $width));
            $tmp_img = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagejpeg($tmp_img, "{$pathToThumbs}{$fileInfo['basename']}");
        }
        if ($fileInfo['extension'] == 'png') {
            $img = imagecreatefrompng("{$fileInfo['dirname']}/{$fileInfo['basename']}");
            $width = imagesx($img);
            $height = imagesy($img);

            $newWidth = $thumbWidth;
            $newHeight = floor($height * ($thumbWidth / $width));
            $tmp_img = imagecreatetruecolor($newWidth, $newHeight);

            imagealphablending($tmp_img, false);
            imagesavealpha($tmp_img, true);

            imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagepng($tmp_img, "{$pathToThumbs}{$file}");


        }
    }
}


function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth )
{
    // open the directory
    $dir = opendir($pathToImages);
    $ext = array('jpg', 'png');




    while (false !== ($file = readdir($dir))) {
        if ($file != "." && $file != "..") {
            $fileInfo = pathinfo($file);

            if (array_key_exists('extension', $fileInfo) && in_array($fileInfo["extension"], $ext)) {
                if ($fileInfo['extension'] == 'jpg') {
                    $img = imagecreatefromjpeg("{$pathToImages}{$file}");
                    $width = imagesx($img);
                    $height = imagesy($img);

                    $newWidth = $thumbWidth;
                    $newHeight = floor($height * ($thumbWidth / $width));
                    $tmp_img = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($tmp_img, "{$pathToThumbs}{$file}");
                }
                if ($fileInfo['extension'] == 'png') {
                    $img = imagecreatefrompng("{$pathToImages}{$file}");
                    $width = imagesx($img);
                    $height = imagesy($img);

                    $newWidth = $thumbWidth;
                    $newHeight = floor($height * ($thumbWidth / $width));
                    $tmp_img = imagecreatetruecolor($newWidth, $newHeight);

                    imagealphablending($tmp_img, false);
                    imagesavealpha($tmp_img, true);

                    imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagepng($tmp_img, "{$pathToThumbs}{$file}");


                }
            }

        }
    }
    closedir($dir);
}
//createThumbs("uploads/","uploads/thumbs/",100);
//createAThumb("uploads/220.jpg","uploads/thumbs/",200);
?>