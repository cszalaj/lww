<?php
$imgPath = "./images/ecards/2_thumb.jpg";

  $font = 'fonts/mesmerize.ttf';

  $img = imagecreatefromjpeg($imgPath);
  imagejpeg($img,'ecards/2555555.jpg');
  header("Content-type: image/jpeg");
  imagejpeg($img);

  imagedestroy($img);
?>