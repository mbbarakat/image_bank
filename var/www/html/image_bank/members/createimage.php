<?php

function resizeImage($dir, $img, $ext, $size, $label)
{
    $imageSize = $size;
    $arr_image_details = getimagesize("$dir" . "$img" . "$ext");
    $original_width = $arr_image_details[0];
    $original_height = $arr_image_details[1];
    if ($original_width > $original_height) {
      $sourcey = 0;
      $sourcex = ($original_width - $original_height) / 2;
      $smallestSide = $original_height;
    } else {
      $sourcex = 0;
      $sourcey = ($original_height - $original_width) / 2;
      $smallestSide = $original_width;
    }
    if ($arr_image_details[2] == 1) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    }
    if ($arr_image_details[2] == 2) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($arr_image_details[2] == 3) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }
    if ($imgt) {
        $old_image = $imgcreatefrom("$dir" . "$img" . "$ext");
        $image = imagecreatetruecolor($imageSize, $imageSize);
        imagecopyresampled($image, $old_image, 0, 0, $sourcex, $sourcey, $imageSize, $imageSize, $smallestSide, $smallestSide);
        $imgt($image, "$dir". "$img" . $label . "$ext");
    }
}

?>