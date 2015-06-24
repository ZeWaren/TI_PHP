<?
  session_start();

  $onti_filename = isset($_SESSION["onti_filename"]) ? $_SESSION["onti_filename"] : 'untitled';
  $onti_folder = isset($_SESSION["onti_folder"]) ? $_SESSION["onti_folder"] : 'main';
  $onti_comment = isset($_SESSION["onti_comment"]) ? $_SESSION["onti_comment"] : 'Created on ti.zewaren.net';
  $onti_calctype = isset($_SESSION["onti_calctype"]) ? $_SESSION["onti_calctype"] : '89';
  $onti_text = isset($_SESSION["onti_text"]) ? $_SESSION["onti_text"] : "";
  $onti_storetype = isset($_SESSION["onti_storetype"]) ? $_SESSION["onti_storetype"] : 'RAM';

  $encode_type = isset($_GET["type"]) ? $_GET["type"] : "txt";
  if ($encode_type == "txt" || $encode_type == "txtnoheader")
    {
       $str="";
         if ($encode_type != "txtnoheader")
           {
             $CaltocheName = "Unknown";
             $CaltocheName = $onti_calctype == "89" ? 'TI-89' : $CaltocheName;
             $CaltocheName = $onti_calctype == "92" ? 'TI-92' : $CaltocheName;
             $CaltocheName = $onti_calctype == "92P" ? 'TI-92 Plus' : $CaltocheName;
             $str .= "Calculator Type: ".$CaltocheName;
             $str .= "\r\nVariable Name: ".$onti_filename;
             $str .= "\r\nFolder: ".$onti_folder;
             $str .= "\r\nComment: ".$onti_comment;
             $StoreType = "Unknown";
             $StoreType = $onti_storetype == "RAM" ? 'RAM' : $StoreType;
             $StoreType = $onti_storetype == "RAML" ? 'RAM Locked' : $StoreType;
             $StoreType = $onti_storetype == "ARCHIVE" ? 'Archive' : $StoreType;
             $str .= "\r\nStore Type: ".$StoreType;
             $str .= "\r\n------\r\n";
           }
       $str .= $onti_text;
       $final_filename = "$onti_folder"."-"."$onti_filename".".tizw.txt";
       header('Content-type: text/plain');
       header('Content-Disposition: attachment; filename="'.$final_filename.'"');
       header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");              
       echo $str;
    }
  else if ($encode_type == "89t")
    {
      $final_filename = "$onti_folder"."-"."$onti_filename".".tizw.89t";
      $text = $onti_text;
//  if copy(text, 1, 1) <> Chr(12) then
//    text := ' '+text;
      $text = str_replace("\n", ' ', $text);
      if (substr($text, 1, 1) != Chr(12)) 
        $text = ' '.$text;

      $file_89_length = strlen($text)+4;
      $file_length = $file_89_length + 90;

      if ($onti_storetype == "89")
        $calc = '**TI89**';
      else if ($onti_storetype == "92")
        $calc = '**TI92**';
      else
        $calc = '**TI92P*';

      for ($i=0; $i<90 ; $i++)
        $entete[$i]=0;

      for ($i=0; $i<8 ; $i++)
        $entete[$i]=ord($calc[$i]);
      $entete[8]=1;

      $onti_folder=substr($onti_folder.str_repeat(chr(0), 8), 0, 8);
      for ($i=11; $i<11+8; $i++)
        $entete[$i-1] = ord($onti_folder[$i-11]);

      $onti_comment=substr($onti_comment.str_repeat(chr(0), 40), 0, 40);
      for ($i=19; $i<19+40; $i++)
        $entete[$i-1] = ord($onti_comment[$i-19]);

      $entete[58]=1;
      $entete[60]=hexdec("52");      

      $onti_filename=substr($onti_filename.str_repeat(chr(0), 8), 0, 8);
      for ($i=65; $i<65+8; $i++)
        $entete[$i-1] = ord($onti_filename[$i-65]);

      $entete[72]=hexdec("B");      

      $storetype_index = 0;
      $storetype_index = $onti_storetype == 'RAML' ? 1 : $storetype_index;
      $storetype_index = $onti_storetype == 'ARCHIVE' ? 2 : $storetype_index;

      $entete[73]=$storetype_index;

      for ($i=0; $i<4; $i++)
        $entete[76+$i] = floor( $file_length / pow(256, $i) ) % 256;

      $entete[80] = hexdec("A5");
      $entete[81] = hexdec("5A");

      $entete[86] = floor($file_length / 256);
      $a = floor($file_length / 256);
      $entete[87] = floor($file_89_length % 256);
      $a += floor($file_89_length % 256);

      $entete[89] = 1;

      for ($i=0; $i<4 ; $i++)
        $terminaison[$i]=0;

      $terminaison[1] = hexdec("E0");

      $checksum=0;
      for ($i=0; $i<strlen($text); $i++)
        $checksum += ord($text[$i]) % 65536;
      $checksum = ($checksum + $a +225) % 65536;

      $terminaison[2] = $checksum % 256;
      $terminaison[3] = floor($checksum / 256);

      $handle=fopen(session_id().'.dat', "wb");
      $entete_length = count($entete);
      for ($i=0; $i<$entete_length; $i++)
        fwrite($handle, chr($entete[$i]));
      for ($i=0; $i<strlen($text); $i++)
        fwrite($handle, $text[$i]);
      for ($i=0; $i<count($terminaison); $i++)
        fwrite($handle, chr($terminaison[$i]));
      fclose($handle);
      header( 'Content-Type: application/octet-stream' );
      header('Content-Disposition: attachment; filename="'.$final_filename.'"');
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      readfile(session_id().'.dat');
/*      $handle = fopen(session_id().'.dat', "rb");
      echo '<h1>File Hexa</h1><br>';
      fseek($handle,0);
      $count=0;
      echo '<hr><table style="font-size:small;"><tr>';
        while (!feof($handle))
        {
          $contents = fread($handle, 1);
          $contents=strtoupper(dechex(ord($contents)));
            if (strlen($contents)==1)
              $contents='0'.$contents;
          echo '<td>'.$contents.'<font color="gray">('.chr(hexdec($contents)).')</font></td>';
          $count++;
            if ($count==8 || $count==16 || $count==24)
              {
                echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>';
              }
            else if ($count==32)
              {
                echo '</tr><tr>';
                $count=0;
              }
        }
      echo '</tr></table>';   */

    }
  else
    {
      echo 'Nothing has been done';
    }
?>