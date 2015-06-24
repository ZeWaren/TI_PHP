<?
  session_start();

  $onti_filename = isset($_SESSION["onti_filename"]) ? $_SESSION["onti_filename"] : 'untitled';
  $onti_comment = isset($_SESSION["onti_comment"]) ? $_SESSION["onti_comment"] : 'Encodé par ti.zewaren.net';

  $onti_image = isset($_SESSION["onti_image"]) ? $_SESSION["onti_image"] : '';  

  $filetype = isset($_GET["type"]) ? $_GET["type"] : "82i";
  if ($filetype == "jpg")
    {
      $final_filename = "$onti_filename".".tizw.jpg";
      header( 'Content-Type: image/jpeg' );
      header('Content-Disposition: attachment; filename="'.$final_filename.'"');
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      $img = imagecreatefrompng($onti_image.'.buffer.png');
      imagejpeg($img, $onti_image.'.buffer.png.jpg');
      imagedestroy($img);
      readfile($onti_image.'.buffer.png.jpg');
    }
  else if ($filetype == "gif")
    {
      $final_filename = "$onti_filename".".tizw.gif";
      header( 'Content-Type: image/jpeg' );
      header('Content-Disposition: attachment; filename="'.$final_filename.'"');
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      $img = imagecreatefrompng($onti_image.'.buffer.png');
      imagegif($img, $onti_image.'.buffer.png.gif');
      imagedestroy($img);
      readfile($onti_image.'.buffer.png.gif');
    }
  else if ($filetype == "png")
    {
      $final_filename = "$onti_filename".".tizw.png";
      header( 'Content-Type: image/png' );
      header('Content-Disposition: attachment; filename="'.$final_filename.'"');
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      readfile($onti_image.'.buffer.png');
    }
  else if ($filetype == "82i")
      {
        //83P/84 Family
         for($i=0; $i<72; $i++)
           {
             $entete[$i] = 0;
           }
         $entete[0] = Ord('*');
         $entete[1] = Ord('*');
         $entete[2] = Ord('T');
         $entete[3] = Ord('I');
         $entete[4] = Ord('8');
         $entete[5] = Ord('2');
         $entete[6] = Ord('*');
         $entete[7] = Ord('*');
         $entete[8] = 26;
         $entete[9] = 10;
         $entete[10] = 0;

        $onti_comment=substr($onti_comment.str_repeat(chr(0), 40), 0, 40);
          for ($i=11; $i<11+40; $i++)
            $entete[$i] = ord($onti_comment[$i-11]);

        $entete[53] = 0x05;
        $entete[54] = 0x03;              
        $entete[55] = 0xB;

        $entete[56] = 0x00;
        $entete[57] = 0xF6;
        $entete[58] = 0x02;
        $entete[59] = 0x7;

        $entete[60] = 0x60;
        $tinumber = substr($onti_filename, 3, 1);
        $tinumber = $tinumber == "0" ? '9' : $tinumber - 1;
        $entete[61] = $tinumber;

        $entete[68] = 0xF6;
        $entete[69] = 0x02;
        $entete[70] = 0xF4;
        $entete[71] = 0x02;

        $handle=fopen(session_id().'.dat', "wb");
        $checksum = 0;

        $entete_length = count($entete);
        for ($i=0; $i<$entete_length; $i++)
          fwrite($handle, chr($entete[$i]));

        $final_filename = "$onti_filename".".tizw.8xi";
        $img = imagecreatefrompng($onti_image.'.buffer.png');

        $width = imagesx($img);
        $widthextension = $width % 8 <> 0 ? $width + (8 - ($width %8)) : $width;
        $height = imagesy($img)-1;

        $contentlength = $widthextension * $height;
        $contentlength8 = $contentlength / 8;
        $readingBytes = $contentlength8 + 5;
        $sum = 0;
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
          $checksum += $resultbyte;
          $towrite[] = $resultbyte & 0xFF;
        }

        $handle=fopen(session_id().'.dat', "wb");
        $entete_length = count($entete);
        for ($i=0; $i<$entete_length; $i++)
          fwrite($handle, chr($entete[$i]));
        foreach ($towrite as $buffer)
          fwrite($handle, chr($buffer));

        for ($i=55; $i<72; $i++)
          $checksum += $entete[$i];
        fwrite($handle, Chr($checksum & 0xFF));
        fwrite($handle, Chr(($checksum >> 8) & 0xFF));

        fclose($handle);

        $final_filename = "$onti_filename".".tizw.82i";
        header( 'Content-Type: application/octet-stream' );
        header('Content-Disposition: attachment; filename="'.$final_filename.'"');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        readfile(session_id().'.dat');
      }
    else if ($filetype == "txt" || $filetype == "txtnoheader")
      {
         if ($filetype != "txtnoheader")
           {
             $str = "Nom de la variable:  ".$onti_filename;
             $str .= "\r\nCommentaire:".$onti_comment;
             $str .= "\r\nStockage: ".$onti_storetype;
             $str .= "\r\n----------\r\n".$text;
           }
         else
           $str = $text;
         $final_filename = "$onti_filename".".tizw.txt";
         header('Content-type: text/plain');
         header('Content-Disposition: attachment; filename="'.$final_filename.'"');
         header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
         echo $str;
      }


?>
