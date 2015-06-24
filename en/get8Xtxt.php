<?
   session_start();
   $text = $_SESSION["text"];
   $TIName = $_SESSION["name"];
   $TIComment = $_SESSION["comment"];
   $TIStoreType = $_SESSION["storetype"];

   $str = "Variable Name: ".$TIName;
   $str .= "\r\nComment: ".$TIComment;
   $str .= "\r\nStore Type: ".$TIStoreType;
   $str .= "\r\n----------\r\n".$text;

   $final_filename = "$TIName".".tizw.txt";
   header('Content-type: text/plain');
   header('Content-Disposition: attachment; filename="'.$final_filename.'"');
   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
   echo $str;
?>
