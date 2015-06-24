<?
  session_start();

  $onti_comment = isset($_SESSION["onti_comment"]) ? $_SESSION["onti_comment"] : 'Encodé par ti.zewaren.net';

  $listcount = isset($_SESSION["listcount"]) ? $_SESSION["listcount"] : 1;
  $onti_numbersign = isset($_SESSION["onti_numbersigns"]) ? $_SESSION["onti_numbersigns"] : array('positive');
  $onti_mantissa = isset($_SESSION["onti_mantissas"]) ? $_SESSION["onti_mantissas"] : array('1');
  $onti_expsign = isset($_SESSION["onti_expsigns"]) ? $_SESSION["onti_expsigns"] : array('positive');
  $onti_exposant = isset($_SESSION["onti_exposants"]) ? $_SESSION["onti_exposants"] : array('0');

  $filetype = isset($_GET["type"]) ? $_GET["type"] : "82w";
    if ($filetype == "82w")
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
         $entete[5] = Ord('2');
         $entete[6] = Ord('*');
         $entete[7] = Ord('*');
         $entete[8] = 26;
         $entete[9] = 10;
         $entete[10] = 0;

        $onti_comment=substr($onti_comment.str_repeat(chr(0), 40), 0, 40);
          for ($i=11; $i<11+40; $i++)
            $entete[$i] = ord($onti_comment[$i-11]);

        $entete[53] = ($listcount * 9 + 18) & 0xFF;
        $entete[54] = (($listcount * 9 + 18) >> 8) & 0xFF;
        $entete[55] = 0xB;
        $entete[57] = ($listcount * 9 + 3) & 0xFF;
        $entete[58] = (($listcount * 9 + 3) >> 8) & 0xFF;
        $entete[59] = 0xB;

        $entete[68] = $entete[57];
        $entete[69] = $entete[58];

        $entete[70] = 0x9A;
        $entete[71] = 0x00;

        $handle=fopen(session_id().'.dat', "wb");
        $checksum = 0;

        $entete_length = count($entete);
        for ($i=0; $i<$entete_length; $i++)
          fwrite($handle, chr($entete[$i]));

        fwrite($handle, chr(0x00));

        for ($i=0; $i<$listcount; $i++)
          {
            fwrite($handle, chr($onti_numbersign[$i] == "positive" ? 0x00 : 0x80));
            $checksum += $onti_numbersign[$i] == "positive" ? 0x00 : 0x80;
            if ($onti_exposant[$i] >= 0)
              $exposant = 0x80 + $onti_exposant[$i];
            else
              $exposant = 0x80 + $onti_exposant[$i];

            fwrite($handle, chr($exposant));
            $checksum += $exposant;

            $onti_mantissa[$i] = str_replace('.', '', $onti_mantissa[$i]);
            $onti_mantissa[$i] = substr($onti_mantissa[$i].str_repeat('0', 14), 0, 14);
            for ($j=0; $j<strlen($onti_mantissa[$i]); $j+=2)
              {
                $towrite = hexdec($onti_mantissa[$i][$j].$onti_mantissa[$i][$j+1]);
                fwrite($handle, chr($towrite));
                $checksum += $towrite;
              }

          }

        for ($i=55; $i<72; $i++)
          $checksum += $entete[$i];
        fwrite($handle, Chr($checksum & 0xFF));
        fwrite($handle, Chr(($checksum >> 8) & 0xFF));

        fclose($handle);

        $final_filename = "WindowRange.tizw.82w";
        header( 'Content-Type: application/octet-stream' );
        header('Content-Disposition: attachment; filename="'.$final_filename.'"');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        readfile(session_id().'.dat');
      }
    else if ($filetype == "txt" || $filetype == "txtnoheader")
      {
          $text = "";
          $names = array(
                          "Xmin",
                          "Xmax",
                          "Xscl",
                          "Ymin",
                          "Ymax",
                          "Yscl",
                          "Tetamin",
                          "Tetamax",
                          "Tetastep",
                          "Tmin",
                          "Tmax",
                          "Tscl",
                          "nMin",
                          "nMax",
                          "UnStart",
                          "VnStart",
                          "nStart",
                        );
         for ($i=0; $i<$listcount; $i++)
           {
             $text .= $names[$i].': ';
             $text .= ($onti_numbersign[$i] == "positive" ? '' : '-').($onti_mantissa[$i]).('e').($onti_expsign[$i] == "positive" ? '' : '-').abs($onti_exposant[$i]);
             $text .= "\r\n";
           }
         if ($filetype != "txtnoheader")
           {
             $str = "Commentaire:".$onti_comment;
             $str .= "\r\n----------\r\n".$text;
           }
         else
           $str = $text;
         $final_filename = "WindowRange.tizw.txt";
         header('Content-type: text/plain');
         header('Content-Disposition: attachment; filename="'.$final_filename.'"');
         header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
         echo $str;
      }


?>
