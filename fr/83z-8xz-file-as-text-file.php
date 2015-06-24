<?
   session_start();
   $noheader = isset($_GET["noheader"]) ? $_GET["noheader"] : false;
   $text = $_SESSION["text"];
   $TIComment = $_SESSION["comment"];
   $TIStoreType = $_SESSION["storetype"];

   if (!$noheader)
     {
       $str = "Commentaire:".$TIComment;
       $str .= "\r\nStockage: ".$TIStoreType;
       $str .= "\r\n----------\r\n".$text;
     }
   else
     $str = $text;
   $final_filename = "WindowRange.tizw.txt";
   header('Content-type: text/plain');
   header('Content-Disposition: attachment; filename="'.$final_filename.'"');
   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
   echo $str;
?>
