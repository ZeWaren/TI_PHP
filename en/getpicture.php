<?
   session_start();
   if (!file_exists("./pictureconverted/".session_id().'.gif')) die();
   $filetype = isset($_GET["type"]) ? $_GET["type"] : '';
   $im = imagecreatefromgif("./pictureconverted/".session_id().'.gif');
     switch ($filetype)
     {
       case 'jpeg' :
         {
//           header('Last-Modified: '.gmdate('D, d M Y H:i:s', $timestamp).' GMT');
           header("Content-type: image/jpeg");
           imagejpeg($im);
           break;
         }
       case 'gif' :
         {
//           header('Last-Modified: '.gmdate('D, d M Y H:i:s', $timestamp).' GMT');
           header("Content-type: image/gif");
           imagegif($im);
           break;
         }
       default :
         {
//        header('Last-Modified: '.gmdate('D, d M Y H:i:s', $timestamp).' GMT');
           header("Content-type: image/png");
           imagepng($im);
           break;
         }
     }

   imagedestroy($im);
?>