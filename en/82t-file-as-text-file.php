<?
   session_start();
   $noheader = isset($_GET["noheader"]) ? $_GET["noheader"] : false;
   $text = $_SESSION["text"];
   $TIComment = $_SESSION["comment"];

   if (!$noheader)
     {
       $str  = "Comment: ".$TIComment;
       $str .= "\r\n----------\r\n".$text;
     }
   else
     $str = $text;
   $final_filename = "TableSetup".".tizw.txt";
   header('Content-type: text/plain');
   header('Content-Disposition: attachment; filename="'.$final_filename.'"');
   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
   echo $str;
?>
