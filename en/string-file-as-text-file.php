<?
  session_start();
  $addheader = isset($_GET["addheader"]) ? $_GET["addheader"] : false;

  $onti_filename = isset($_SESSION["onti_filename"]) ? $_SESSION["onti_filename"] : 'untitled';
  $onti_folder = isset($_SESSION["onti_folder"]) ? $_SESSION["onti_folder"] : 'main';
  $onti_comment = isset($_SESSION["onti_comment"]) ? $_SESSION["onti_comment"] : 'Created on ti.zewaren.net';
  $onti_calctype = isset($_SESSION["onti_calctype"]) ? $_SESSION["onti_calctype"] : '89';
  $onti_text = isset($_SESSION["onti_text"]) ? $_SESSION["onti_text"] : "";
  $onti_storetype = isset($_SESSION["onti_storetype"]) ? $_SESSION["onti_storetype"] : 'RAM';

          if ($addheader == "true")
            {
              $str  = "Calculator Type: ".$onti_calctype;
              $str .= "\r\nVariable Name: ".$onti_filename;
              $str .= "\r\nFolder: ".$onti_folder;
              $str .= "\r\nComment: ".$onti_comment;
              $str .= "\r\nStore Type: ".$onti_storetype;
              $str .= "\r\n----------\r\n".$onti_text;
            }
          else
            {
              $str = $onti_text;
            }

        $final_filename = "$onti_folder.$onti_filename".".tizw.txt";

        header("HTTP/1.0 200 OK");
        header('Content-type: text/plain');
        header('Content-Disposition: attachment; filename="'.$final_filename.'"');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        echo $str;
?>
