<?
  $files1 = scandir('8xpkeys');
  foreach ($files1 as $fn)
    {
      $imgi = imagecreatefromjpeg('8xpkeys/'.$fn);
      $img = imagecreate(imagesx($imgi), imagesy($imgi));
      $background = imagecolorallocate($img, 255, 255, 255);
      imagecopy ( $img, $imgi, 0, 0, 0, 0, imagesx($imgi), imagesy($imgi) );
      imagecolortransparent($img, $background);
      imagegif($img, '8xpkeys/gifs/'.(substr($fn, 0, -4)).'.gif');
      imagedestroy($img);
    }


?>