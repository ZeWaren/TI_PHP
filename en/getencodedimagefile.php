<?
  session_start();

  $onti_filename = isset($_SESSION["onti_filename"]) ? $_SESSION["onti_filename"] : 'untitled';
  $onti_folder = isset($_SESSION["onti_folder"]) ? $_SESSION["onti_folder"] : 'main';
  $onti_comment = isset($_SESSION["onti_comment"]) ? $_SESSION["onti_comment"] : 'Created on ti.zewaren.net';
  $onti_calctype = isset($_SESSION["onti_calctype"]) ? $_SESSION["onti_calctype"] : '89';
  $onti_image = isset($_SESSION["onti_image"]) ? $_SESSION["onti_image"] : "";
  $onti_storetype = isset($_SESSION["onti_storetype"]) ? $_SESSION["onti_storetype"] : 'RAM';
  $encode_type = isset($_GET["type"]) ? $_GET["type"] : "89i";

  if ($onti_image == "")
    {
      echo "Pas d'image!";
      die();
    }
  if ($encode_type == "jpg")
    {
      $final_filename = "$onti_folder"."-"."$onti_filename".".tizw.jpg";
      header( 'Content-Type: image/jpeg' );
      header('Content-Disposition: attachment; filename="'.$final_filename.'"');
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      $img = imagecreatefrompng($onti_image.'.buffer.png');
      imagejpeg($img, $onti_image.'.buffer.png.jpg');
      imagedestroy($img);
      readfile($onti_image.'.buffer.png.jpg');
    }
  else if ($encode_type == "gif")
    {
      $final_filename = "$onti_folder"."-"."$onti_filename".".tizw.gif";
      header( 'Content-Type: image/jpeg' );
      header('Content-Disposition: attachment; filename="'.$final_filename.'"');
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      $img = imagecreatefrompng($onti_image.'.buffer.png');
      imagegif($img, $onti_image.'.buffer.png.gif');
      imagedestroy($img);
      readfile($onti_image.'.buffer.png.gif');
    }
  else if ($encode_type == "png")
    {
      $final_filename = "$onti_folder"."-"."$onti_filename".".tizw.png";
      header( 'Content-Type: image/png' );
      header('Content-Disposition: attachment; filename="'.$final_filename.'"');
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      readfile($onti_image.'.buffer.png');
    }
  else if ($encode_type == "89i")
    {
      $final_filename = "$onti_folder"."-"."$onti_filename".".tizw.89i";
      $img = imagecreatefrompng($onti_image.'.buffer.png');

      $width = imagesx($img);
      $widthextension = $width % 8 <> 0 ? $width + (8 - ($width %8)) : $width;
      $height = imagesy($img);

      if ($onti_storetype == "89")
        $calc = '**TI89**';
      else if ($onti_storetype == "92")
        $calc = '**TI92**';
      else
        $calc = '**TI92P*';

      for ($i=0; $i<86 ; $i++)
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
      $entete[60]=0x52;

      $onti_filename=substr($onti_filename.str_repeat(chr(0), 8), 0, 8);
      for ($i=65; $i<65+8; $i++)
        $entete[$i-1] = ord($onti_filename[$i-65]);

      $entete[72]=0x10;

      $storetype_index = 0;
      $storetype_index = $onti_storetype == 'RAML' ? 1 : $storetype_index;
      $storetype_index = $onti_storetype == 'ARCHIVE' ? 2 : $storetype_index;

      $entete[73]=$storetype_index;
      $entete[74]=0xFF;
      $entete[75]=0x00;
      $filesize = 76 + 0x13 + (($widthextension * $height) / 8);
      $entete[76]=$filesize & 0xFF;
      $entete[77]=($filesize >> 8) & 0xFF;
      $entete[78]=($filesize >> 24) & 0xFF;
      $entete[79]=($filesize >> 16) & 0xFF;
      $entete[80] = 0xA5;
      $entete[81] = 0x5A;
      $entete[82] = 0x00;
      $entete[83] = 0x00;

      $contentlength = $widthextension * $height;
      $contentlength8 = $contentlength / 8;
      $readingBytes = $contentlength8 + 5;
//      $height++;
      $sum = 0xDF + ($width & 0xFF) + (($width >> 8) & 0xFF) + ($height & 0xFF) + (($height >> 8) & 0xFF);
      $sum += ($readingBytes & 0xFF) + (($readingBytes >> 8) & 0xFF);
      $towrite[] = (($readingBytes >> 8) & 0xFF);
      $towrite[] = ($readingBytes & 0xFF);
      $towrite[] = ($height >> 8) & 0xFF;
      $towrite[] = $height & 0xFF;
      $towrite[] = ($width >> 8) & 0xFF;
      $towrite[] = $width & 0xFF;
//      $height--;
      for ($i=0; $i<($widthextension * $height); $i++)
        {
          $bitmaponerow[$i]=0;
        }
      $i=0;
      for ($j=0; $j<$height; $j++)
        {
          for ($k=0; $k<$width; $k++)
            {
              $bitmaponerow[$i] = imagecolorat($img, $k, $j);
              $r = ($bitmaponerow[$i] >> 16) & 0xFF;
              $g = ($bitmaponerow[$i] >> 8) & 0xFF;
              $b = $bitmaponerow[$i] & 0xFF;
              $bitmaponerow[$i] = ($r + $g + $b) / 3 > 50 ? 1 : 0;
              $i++;
            }
          if ($widthextension > $width)
            for ($k=0; $k<$widthextension-$width; $k++)
              {
                $bitmaponerow[$i] = 0;
                $i++;
              }
        }
      $i=0;
      while ($i < $contentlength)
      {
        $resultbyte = $bitmaponerow[$i] == 0x00000000 ? 0x80 : 0x0;
        $resultbyte = $resultbyte | ( $bitmaponerow[$i+1] == 0x00000000 ? 0x40 : 0 );
        $resultbyte = $resultbyte | ( $bitmaponerow[$i+2] == 0x00000000 ? 0x20 : 0 );
        $resultbyte = $resultbyte | ( $bitmaponerow[$i+3] == 0x00000000 ? 0x10 : 0 );
        $resultbyte = $resultbyte | ( $bitmaponerow[$i+4] == 0x00000000 ? 0x08 : 0 );
        $resultbyte = $resultbyte | ( $bitmaponerow[$i+5] == 0x00000000 ? 0x04 : 0 );
        $resultbyte = $resultbyte | ( $bitmaponerow[$i+6] == 0x00000000 ? 0x02 : 0 );
        $resultbyte = $resultbyte | ( $bitmaponerow[$i+7] == 0x00000000 ? 0x01 : 0 );
        $i += 8;
        $sum += $resultbyte;
        $towrite[] = $resultbyte & 0xFF;
      }
      $towrite[] = 0xDF;
      $towrite[] = $sum & 0xFF;
      $towrite[] = ($sum >> 8) & 0xFF;

      $handle=fopen(session_id().'.dat', "wb");
      $entete_length = count($entete);
      for ($i=0; $i<$entete_length; $i++)
        fwrite($handle, chr($entete[$i]));
      foreach ($towrite as $buffer)
        fwrite($handle, chr($buffer));
/*      for ($i=0; $i<strlen($text); $i++)
        fwrite($handle, $text[$i]);
      for ($i=0; $i<count($terminaison); $i++)
        fwrite($handle, chr($terminaison[$i]));*/
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
      echo '</tr></table>';*/

    }
  else
    {
      echo 'Nothing has been done';
    }
?>