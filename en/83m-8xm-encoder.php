<?
  session_start();

  $onti_filename = isset($_SESSION["onti_filename"]) ? $_SESSION["onti_filename"] : 'untitled';
  $onti_comment = isset($_SESSION["onti_comment"]) ? $_SESSION["onti_comment"] : 'Created on ti.zewaren.net';
  $onti_storetype = isset($_SESSION["onti_storetype"]) ? $_SESSION["onti_storetype"] : 'RAM';
  $onti_calctype = isset($_SESSION["onti_calctype"]) ? $_SESSION["onti_calctype"] : '83';

  $listcount = isset($_SESSION["listcount"]) ? $_SESSION["listcount"] : 1;
  $listcount2 = isset($_SESSION["listcount2"]) ? $_SESSION["listcount2"] : 1;  

  $onti_numbersign = isset($_SESSION["onti_numbersigns"]) ? $_SESSION["onti_numbersigns"] : array('positive');
  $onti_mantissa = isset($_SESSION["onti_mantissas"]) ? $_SESSION["onti_mantissas"] : array('1');
  $onti_expsign = isset($_SESSION["onti_expsigns"]) ? $_SESSION["onti_expsigns"] : array('positive');
  $onti_exposant = isset($_SESSION["onti_exposants"]) ? $_SESSION["onti_exposants"] : array('0');

  $filetype = isset($_GET["type"]) ? $_GET["type"] : "8xm";
    if ($filetype == "8xm")
      {
        //83P/84 Family
        if ($onti_calctype == '83P')
          {
               for($i=0; $i<72; $i++)
                 {
                   $entete[$i] = 0;
                 }
               $entete[0] = Ord('*');
               $entete[1] = Ord('*');
               $entete[2] = Ord('T');
               $entete[3] = Ord('I');
               $entete[4] = Ord('8');
               $entete[5] = Ord('3');
               $entete[6] = Ord('F');
               $entete[7] = Ord('*');
               $entete[8] = 26;
               $entete[9] = 10;
               $entete[10] = 0;

              $onti_comment=substr($onti_comment.str_repeat(chr(0), 40), 0, 40);
                for ($i=11; $i<11+40; $i++)
                  $entete[$i] = ord($onti_comment[$i-11]);

              $entete[53] = ($listcount2 * $listcount * 9 + 19) & 0xFF;
              $entete[54] = (($listcount2 * $listcount * 9 + 19) >> 8) & 0xFF;
              $entete[55] = 0xD;
              $entete[57] = ($listcount2 * $listcount * 9 + 2) & 0xFF;
              $entete[58] = (($listcount2 * $listcount * 9 + 2) >> 8) & 0xFF;
              $entete[59] = 0x2;

              $entete[60] = 0x5C;
              $tinumber = substr($onti_filename, 1, 1);
              $tinumber = ord($tinumber)-0x41;
              $entete[61] = $tinumber;

              $entete[69] = $onti_storetype == 'RAM' ? 0 : 128;

              $entete[70] = $entete[57];
              $entete[71] = $entete[58];

              $entete[72] = $listcount2 & 0xFF;
              $entete[73] = $listcount  & 0xFF;

              $handle=fopen(session_id().'.dat', "wb");
              $checksum = 0;

              $entete_length = count($entete);
              for ($i=0; $i<$entete_length; $i++)
                fwrite($handle, chr($entete[$i]));

              for ($k=0; $k<$listcount; $k++)
                {
                  for ($i=0; $i<$listcount2; $i++)
                    {
                      fwrite($handle, chr($onti_numbersign[$k][$i] == "positive" ? 0x00 : 0x80));
                      $checksum += $onti_numbersign[$k][$i] == "positive" ? 0x00 : 0x80;

                      if ($onti_exposant[$k][$i] >= 0)
                        $exposant = 0x80 + $onti_exposant[$k][$i];
                      else
                        $exposant = 0x80 + $onti_exposant[$k][$i];

                      fwrite($handle, chr($exposant));
                      $checksum += $exposant;

                      $onti_mantissa[$k][$i] = str_replace('.', '', $onti_mantissa[$k][$i]);
                      $onti_mantissa[$k][$i] = substr($onti_mantissa[$k][$i].str_repeat('0', 14), 0, 14);
                      for ($j=0; $j<strlen($onti_mantissa[$k][$i]); $j+=2)
                        {
                          $towrite = hexdec($onti_mantissa[$k][$i][$j].$onti_mantissa[$k][$i][$j+1]);
                          fwrite($handle, chr($towrite));
                          $checksum += $towrite;
                        }

                    }
                }

              for ($i=55; $i<74; $i++)
                $checksum += $entete[$i];
              fwrite($handle, Chr($checksum & 0xFF));
              fwrite($handle, Chr(($checksum >> 8) & 0xFF));

              fclose($handle);

              $final_filename = "$onti_filename".".tizw.8xm";
              header( 'Content-Type: application/octet-stream' );
              header('Content-Disposition: attachment; filename="'.$final_filename.'"');
              header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
              readfile(session_id().'.dat');
          }
        //83 Family
        else if ($onti_calctype == '83')
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
               $entete[5] = Ord('3');
               $entete[6] = Ord('*');
               $entete[7] = Ord('*');
               $entete[8] = 26;
               $entete[9] = 10;
               $entete[10] = 0;

              $onti_comment=substr($onti_comment.str_repeat(chr(0), 40), 0, 40);
                for ($i=11; $i<11+40; $i++)
                  $entete[$i] = ord($onti_comment[$i-11]);

              $entete[53] = ($listcount2 * $listcount * 9 + 17) & 0xFF;
              $entete[54] = (($listcount2 * $listcount * 9 + 17) >> 8) & 0xFF;
              $entete[55] = 0xB;
              $entete[57] = ($listcount2 * $listcount * 9 + 2) & 0xFF;
              $entete[58] = (($listcount2 * $listcount * 9 + 2) >> 8) & 0xFF;
              $entete[59] = 0x2;

              $entete[60] = 0x5C;
              $tinumber = substr($onti_filename, 1, 1);
              $tinumber = ord($tinumber)-0x41;
              $entete[61] = $tinumber;

              $entete[68] = $entete[57];
              $entete[69] = $entete[58];

              $entete[70] = $listcount2 & 0xFF;
              $entete[71] = $listcount & 0xFF;

              $handle=fopen(session_id().'.dat', "wb");
              $checksum = 0;

              $entete_length = count($entete);
              for ($i=0; $i<$entete_length; $i++)
                fwrite($handle, chr($entete[$i]));

              for ($k=0; $k<$listcount; $k++)
                {
                  for ($i=0; $i<$listcount2; $i++)
                    {
                      fwrite($handle, chr($onti_numbersign[$k][$i] == "positive" ? 0x00 : 0x80));
                      $checksum += $onti_numbersign[$k][$i] == "positive" ? 0x00 : 0x80;

                      if ($onti_exposant[$k][$i] >= 0)
                        $exposant = 0x80 + $onti_exposant[$k][$i];
                      else
                        $exposant = 0x80 + $onti_exposant[$k][$i];

                      fwrite($handle, chr($exposant));
                      $checksum += $exposant;

                      $onti_mantissa[$k][$i] = str_replace('.', '', $onti_mantissa[$k][$i]);
                      $onti_mantissa[$k][$i] = substr($onti_mantissa[$k][$i].str_repeat('0', 14), 0, 14);
                      for ($j=0; $j<strlen($onti_mantissa[$k][$i]); $j+=2)
                        {
                          $towrite = hexdec($onti_mantissa[$k][$i][$j].$onti_mantissa[$k][$i][$j+1]);
                          fwrite($handle, chr($towrite));
                          $checksum += $towrite;
                        }

                    }
                }

              for ($i=55; $i<72; $i++)
                $checksum += $entete[$i];
              fwrite($handle, Chr($checksum & 0xFF));
              fwrite($handle, Chr(($checksum >> 8) & 0xFF));

              fclose($handle);

              $final_filename = "$onti_filename".".tizw.83m";
              header( 'Content-Type: application/octet-stream' );
              header('Content-Disposition: attachment; filename="'.$final_filename.'"');
              header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
              readfile(session_id().'.dat');
          }
      }
    else if ($filetype == "txt" || $filetype == "txtnoheader")
      {
         $text = "";
         for ($i=0; $i<$listcount; $i++)
           {
             for ($j=0; $j<$listcount2; $j++)
               {
                 $text .= ($onti_numbersign[$i][$j] == "positive" ? '' : '-').($onti_mantissa[$i][$j]).('e').($onti_expsign[$i][$j] == "positive" ? '' : '-').abs($onti_exposant[$i][$j]).", ";
               }
             $text .= "\r\n";
           }
         if ($filetype != "txtnoheader")
           {
             $str = "Variable Name: ".$onti_filename;
             $str .= "\r\nComment: ".$onti_comment;
             $str .= "\r\nStore Type: ".$onti_storetype;
             $str .= "\r\nItem Count: ".$listcount;
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
