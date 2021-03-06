<?
  session_start();

  $onti_filename = isset($_SESSION["onti_filename"]) ? $_SESSION["onti_filename"] : 'untitled';
  $onti_comment = isset($_SESSION["onti_comment"]) ? $_SESSION["onti_comment"] : 'Encod� par ti.zewaren.net';
  $onti_calctype = isset($_SESSION["onti_calctype"]) ? $_SESSION["onti_calctype"] : '83';

  $onti_numbersign = isset($_SESSION["onti_numbersign"]) ? $_SESSION["onti_numbersign"] : 'positive';
  $onti_mantissa = isset($_SESSION["onti_mantissa"]) ? $_SESSION["onti_mantissa"] : '1';
  $onti_expsign = isset($_SESSION["onti_expsign"]) ? $_SESSION["onti_expsign"] : 'positive';
  $onti_exposant = isset($_SESSION["onti_exposant"]) ? $_SESSION["onti_exposant"] : '0';

  $onti_numbersign2 = isset($_SESSION["onti_numbersign2"]) ? $_SESSION["onti_numbersign2"] : 'positive';
  $onti_mantissa2 = isset($_SESSION["onti_mantissa2"]) ? $_SESSION["onti_mantissa2"] : '1';
  $onti_expsign2 = isset($_SESSION["onti_expsign2"]) ? $_SESSION["onti_expsign2"] : 'positive';
  $onti_exposant2 = isset($_SESSION["onti_exposant2"]) ? $_SESSION["onti_exposant2"] : '0';

  $text = ($onti_numbersign == "positive" ? '' : '-').($onti_mantissa).('e').($onti_expsign == "positive" ? '' : '-').abs($onti_exposant);
  $text .= ' '.($onti_numbersign2 == "positive" ? '+' : '-').' '.($onti_mantissa2).('e').($onti_expsign2 == "positive" ? '' : '-').abs($onti_exposant2).' i';

  $filetype = isset($_GET["type"]) ? $_GET["type"] : "85n";
    if ($filetype == "85c")
      {
        //85
        if ($onti_calctype == '85')
          {
               for($i=0; $i<59; $i++)
                 {
                   $entete[$i] = 0;
                 }
               $entete[0] = Ord('*');
               $entete[1] = Ord('*');
               $entete[2] = Ord('T');
               $entete[3] = Ord('I');
               $entete[4] = Ord('8');
               $entete[5] = Ord('5');
               $entete[6] = Ord('*');
               $entete[7] = Ord('*');
               $entete[8] = 26;
               $entete[9] = 0x0C;
               $entete[10] = 0;

              $onti_comment=substr($onti_comment.str_repeat(chr(0), 40), 0, 40);
                for ($i=11; $i<11+40; $i++)
                  $entete[$i] = ord($onti_comment[$i-11]);

              $entete[53] = 0x22;
//              $entete[55] = 0xC;
              $entete[55] = 0x04 + strlen($onti_filename);
              $entete[56] = 0x00;
              $entete[57] = 0x12;
              $entete[58] = 0x00;
//              $entete[59] = 0x01;

              $handle=fopen(session_id().'.dat', "wb");
              $checksum = 0;

              $entete_length = count($entete);
              for ($i=0; $i<$entete_length; $i++)
                fwrite($handle, chr($entete[$i]));

              fwrite($handle, chr(0x01));
              fwrite($handle, chr(strlen($onti_filename)));
              fwrite($handle, $onti_filename);

              fwrite($handle, chr(0x12));
              fwrite($handle, chr(0x00));              

              fwrite($handle, chr($onti_expsign == "positive" ? 0x81 : 0x01));
              $checksum += $onti_expsign == "positive" ? 0x81 : 0x01;

              $exposant = $onti_exposant;
              $exposant += 0xFC00;

              fwrite($handle, chr($exposant & 0xFF));
              fwrite($handle, chr($exposant >> 8 & 0xFF));
              $checksum += $exposant & 0xFF;
              $checksum += $exposant >> 8 & 0xFF;

              $onti_mantissa = str_replace('.', '', $onti_mantissa);
              $onti_mantissa = substr($onti_mantissa.str_repeat('0', 14), 0, 14);
              for ($i=0; $i<strlen($onti_mantissa); $i+=2)
                {
                  $towrite = hexdec($onti_mantissa[$i].$onti_mantissa[$i+1]);
                  fwrite($handle, chr($towrite));
                  $checksum += $towrite;
                }

              fwrite($handle, chr($onti_numbersign2 == "positive" ? 0x01 : 0x81));
              $checksum += $onti_numbersign2 == "positive" ? 0x01 : 0x81;

              $exposant = $onti_exposant2;
              $exposant += 0xFC00;

              fwrite($handle, chr($exposant & 0xFF));
              fwrite($handle, chr($exposant >> 8 & 0xFF));
              $checksum += $exposant & 0xFF;
              $checksum += $exposant >> 8 & 0xFF;

              $onti_mantissa2 = str_replace('.', '', $onti_mantissa2);
              $onti_mantissa2 = substr($onti_mantissa2.str_repeat('0', 14), 0, 14);
              for ($i=0; $i<strlen($onti_mantissa2); $i+=2)
                {
                  $towrite = hexdec($onti_mantissa2[$i].$onti_mantissa2[$i+1]);
                  fwrite($handle, chr($towrite));
                  $checksum += $towrite;
                }

              for ($i=55; $i<59; $i++)
                $checksum += $entete[$i];
//               echo $checksum;
              fwrite($handle, Chr($checksum & 0xFF));
              fwrite($handle, Chr(($checksum >> 8) & 0xFF));

              fclose($handle);

              $final_filename = "$onti_filename".".tizw.85c";
              header( 'Content-Type: application/octet-stream' );
              header('Content-Disposition: attachment; filename="'.$final_filename.'"');
              header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
              readfile(session_id().'.dat');
          }
        //86 Family
        else if ($onti_calctype == '86')
          {
               for($i=0; $i<70; $i++)
                 {
                   $entete[$i] = 0;
                 }
               $entete[0] = Ord('*');
               $entete[1] = Ord('*');
               $entete[2] = Ord('T');
               $entete[3] = Ord('I');
               $entete[4] = Ord('8');
               $entete[5] = Ord('6');
               $entete[6] = Ord('*');
               $entete[7] = Ord('*');
               $entete[8] = 26;
               $entete[9] = 10;
               $entete[10] = 0;

              $onti_comment=substr($onti_comment.str_repeat(chr(0), 40), 0, 40);
                for ($i=11; $i<11+40; $i++)
                  $entete[$i] = ord($onti_comment[$i-11]);

              $entete[53] = 0x22;
              $entete[55] = 0xC;
              $entete[57] = 0x12;
              $entete[59] = 0x01;

              $onti_filename2=substr($onti_filename.str_repeat(chr(0x20), 8), 0, 8);
              $entete[60] = strlen($onti_filename);
              for ($i=61; $i<61+8; $i++)
                $entete[$i] = ord($onti_filename2[$i-61]);

              $entete[69] = 0x12;
              $entete[70] = 0;

              $handle=fopen(session_id().'.dat', "wb");
              $checksum = 0;

              $entete_length = count($entete);
              for ($i=0; $i<$entete_length; $i++)
                fwrite($handle, chr($entete[$i]));

              fwrite($handle, chr($onti_expsign == "positive" ? 0x81 : 0x01));
              $checksum += $onti_expsign == "positive" ? 0x81 : 0x01;

              $exposant = $onti_exposant;
              $exposant += 0xFC00;

              fwrite($handle, chr($exposant & 0xFF));
              fwrite($handle, chr($exposant >> 8 & 0xFF));
              $checksum += $exposant & 0xFF;
              $checksum += $exposant >> 8 & 0xFF;

              $onti_mantissa = str_replace('.', '', $onti_mantissa);
              $onti_mantissa = substr($onti_mantissa.str_repeat('0', 14), 0, 14);
              for ($i=0; $i<strlen($onti_mantissa); $i+=2)
                {
                  $towrite = hexdec($onti_mantissa[$i].$onti_mantissa[$i+1]);
                  fwrite($handle, chr($towrite));
                  $checksum += $towrite;
                }

              fwrite($handle, chr($onti_numbersign2 == "positive" ? 0x01 : 0x81));
              $checksum += $onti_numbersign2 == "positive" ? 0x01 : 0x81;

              $exposant = $onti_exposant2;
              $exposant += 0xFC00;

              fwrite($handle, chr($exposant & 0xFF));
              fwrite($handle, chr($exposant >> 8 & 0xFF));
              $checksum += $exposant & 0xFF;
              $checksum += $exposant >> 8 & 0xFF;

              $onti_mantissa2 = str_replace('.', '', $onti_mantissa2);
              $onti_mantissa2 = substr($onti_mantissa2.str_repeat('0', 14), 0, 14);
              for ($i=0; $i<strlen($onti_mantissa2); $i+=2)
                {
                  $towrite = hexdec($onti_mantissa2[$i].$onti_mantissa2[$i+1]);
                  fwrite($handle, chr($towrite));
                  $checksum += $towrite;
                }

              for ($i=55; $i<70; $i++)
                $checksum += $entete[$i];
//               echo $checksum;
//              fwrite($handle, Chr($checksum & 0xFF));
//              fwrite($handle, Chr(($checksum >> 8) & 0xFF));

              fclose($handle);

              $final_filename = "$onti_filename".".tizw.86c";
              header( 'Content-Type: application/octet-stream' );
              header('Content-Disposition: attachment; filename="'.$final_filename.'"');
              header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
              readfile(session_id().'.dat');
          }
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
