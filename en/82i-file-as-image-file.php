<?
   session_start();
   if (!file_exists("./pictureconverted/".session_id().'.gif')) die();
   $filetype = isset($_GET["type"]) ? $_GET["type"] : '';
   $im = imagecreatefromgif("./pictureconverted/".session_id().'.gif');
   $final_filename = isset($_SESSION["name"]) ? $_SESSION["name"] : "untitled";
     switch ($filetype)
     {
       case 'jpeg' :
         {
//           header('Last-Modified: '.gmdate('D, d M Y H:i:s', $timestamp).' GMT');
           header("Content-type: image/jpeg");
           header('Content-Disposition: attachment; filename="'.$final_filename.'.jpg"');
           header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
           imagejpeg($im);
           break;
         }
       case 'gif' :
         {
//           header('Last-Modified: '.gmdate('D, d M Y H:i:s', $timestamp).' GMT');
           header("Content-type: image/gif");
           header('Content-Disposition: attachment; filename="'.$final_filename.'.gif"');
           header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
           imagegif($im);
           break;
         }
       default :
         {
//        header('Last-Modified: '.gmdate('D, d M Y H:i:s', $timestamp).' GMT');
           header("Content-type: image/png");
           header('Content-Disposition: attachment; filename="'.$final_filename.'.png"');
           header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
           imagepng($im);
           break;
         }
     }

   imagedestroy($im);
?>