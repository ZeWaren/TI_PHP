<?
  session_start();

  $onti_comment = isset($_SESSION["onti_comment"]) ? $_SESSION["onti_comment"] : 'Created on ti.zewaren.net';
  $onti_filename = isset($_SESSION["onti_filename"]) ? $_SESSION["onti_filename"] : 'GDB1';

  $listcount = isset($_SESSION["listcount"]) ? $_SESSION["listcount"] : 1;
  $onti_numbersign = isset($_SESSION["onti_numbersigns"]) ? $_SESSION["onti_numbersigns"] : array('positive');
  $onti_mantissa = isset($_SESSION["onti_mantissas"]) ? $_SESSION["onti_mantissas"] : array('1');
  $onti_expsign = isset($_SESSION["onti_expsigns"]) ? $_SESSION["onti_expsigns"] : array('positive');
  $onti_exposant = isset($_SESSION["onti_exposants"]) ? $_SESSION["onti_exposants"] : array('0');

  $onti_graphsettings1 = isset($_SESSION["onti_graphsettings1"]) ? $_SESSION["onti_graphsettings1"] : "DOT";
  $onti_graphsettings2 = isset($_SESSION["onti_graphsettings2"]) ? $_SESSION["onti_graphsettings2"] : "SIMUL";
  $onti_graphsettings3 = isset($_SESSION["onti_graphsettings3"]) ? $_SESSION["onti_graphsettings3"] : "GRIDON";
  $onti_graphsettings4 = isset($_SESSION["onti_graphsettings4"]) ? $_SESSION["onti_graphsettings4"] : "POLARGC";
  $onti_graphsettings5 = isset($_SESSION["onti_graphsettings5"]) ? $_SESSION["onti_graphsettings5"] : "COORDOFF";
  $onti_graphsettings6 = isset($_SESSION["onti_graphsettings6"]) ? $_SESSION["onti_graphsettings6"] : "AXESOFF";
  $onti_graphsettings7 = isset($_SESSION["onti_graphsettings7"]) ? $_SESSION["onti_graphsettings7"] : "LABELON";

  $onti_functioncontent = isset($_SESSION["onti_functioncontent"]) ? $_SESSION["onti_functioncontent"] : array ("");
  $onti_functioncontent2 = isset($_SESSION["onti_functioncontent2"]) ? $_SESSION["onti_functioncontent2"] : array ("");
  $onti_funcselected = isset($_SESSION["onti_funcselected"]) ? $_SESSION["onti_funcselected"] : array('unselected');

  $onti_mode = isset($_SESSION["onti_mode"]) ? $_SESSION["onti_mode"] : "function";

  $onti_sequencemode = isset($_SESSION["onti_sequencemode"]) ? $_SESSION["onti_sequencemode"] : "Time";

  $filetype = isset($_GET["type"]) ? $_GET["type"] : "82d";
    if ($filetype == "82d")
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

          $entete[55] = 0xB;
          $entete[59] = 0x8;

          $entete[60] = 0x61;
          $tinumber = substr($onti_filename, 3, 1);
          $tinumber = $tinumber == "0" ? '9' : $tinumber - 1;
          $entete[61] = $tinumber;

          $handle=fopen(session_id().'.dat', "wb");
          $checksum = 0;

          $entete_length = count($entete);
          for ($i=0; $i<$entete_length; $i++)
            fwrite($handle, chr($entete[$i]));

          if ($onti_mode == "function")
            {
              fwrite($handle, chr(0x10));
              $checksum += 0x10;
            }
          else if ($onti_mode == "parametric")
            {
              fwrite($handle, chr(0x40));
              $checksum += 0x40;
            }
          else if ($onti_mode == "polar")
            {
              fwrite($handle, chr(0x20));
              $checksum += 0x20;
            }
          else if ($onti_mode == "sequence")
            {
              fwrite($handle, chr(0x80));
              $checksum += 0x80;
            }

          $modesettings = 0;
          $modesettings |= $onti_graphsettings1 == "DOT" ? 1 : 0;
          $modesettings |= $onti_graphsettings2 == "SIMUL" ? 2 : 0;
          $modesettings |= $onti_graphsettings3 == "GRIDON" ? 4 : 0;
          $modesettings |= $onti_graphsettings4 == "POLARGC" ? 8 : 0;
          $modesettings |= $onti_graphsettings5 == "COORDOFF" ? 16 : 0;
          $modesettings |= $onti_graphsettings6 == "AXESOFF" ? 32 : 0;
          $modesettings |= $onti_graphsettings7 == "LABELON" ? 64 : 0;

          fwrite($handle, chr($modesettings));
          $checksum += $modesettings;

          if ($onti_mode == "sequence")
            {
              $modes = array ( "Time" => 0x00, "Web" => 0x01);
              fwrite($handle, chr($modes[$onti_sequencemode]));
              $checksum += $modes[$onti_sequencemode];
            }
          else
            fwrite($handle, chr(0x00));            
/*          else
            {
              fwrite($handle, chr(0x80));
              $checksum += 0x80;
            }*/

/*          fwrite($handle, chr($onti_graphsettings8 == "EXPROFF" ? 0x21 : 0x20));
          $checksum += $onti_graphsettings8 == "EXPROFF" ? 0x21 : 0x20;*/

          for ($i=0; $i<$listcount; $i++)
            {
              fwrite($handle, chr($onti_numbersign[$i] == "positive" ? 0x40 : 0xC0));
              $checksum += $onti_numbersign[$i] == "positive" ? 0x40 : 0xC0;
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
          if ($onti_mode == "function")
            {
/*              $graphstyle = array( 0 => "solid line", 1 => "thick line", 2 => "shade above", 3 => "shade below", 4 => "trace", 5 => "animate", 6 => "dotted line");
              for ($i=0; $i<10; $i++)
                {
                  fwrite($handle, chr(array_search($onti_funcmode[$i], $graphstyle)));
                  $checksum += array_search($onti_funcmode[$i], $graphstyle);
                }*/
              $filesize = 0;
              for ($i=0; $i<10; $i++)
                {
                   unset($content);
                   $onti_funcselected[$i] = strlen($onti_functioncontent[$i]) > 0 ? $onti_funcselected[$i] : 'unselected';
                   fwrite($handle, chr($onti_funcselected[$i] == "selected" ? 0x2B : 0x03));
                   $checksum += $onti_funcselected[$i] == "selected" ? 0x2B : 0x03;

                   if (strlen($onti_functioncontent[$i]) > 0)
                     {
                       $text = tokenise('\r'.$onti_functioncontent[$i]."\r", false, true, true);
                       $text = substr($text, 3, -1);
                     }
                   else
                     $text = "";
                   $filesize += strlen($text) + 2;
                   fwrite($handle, chr( strlen($text) & 0xFF ));
                   $checksum += strlen($text) & 0xFF;
                   fwrite($handle, chr( strlen($text) >> 8 & 0xFF ));
                   $checksum += strlen($text) >> 8 & 0xFF;

                   for($j=0; $j<strlen($text); $j++)
                     {
//                       $content[] = ord($text[$j]);
                       fwrite($handle, $text[$j]);
                       $checksum += ord($text[$j]);
                     }
                }
              $filesize += 88-21;                    
            }
          else if ($onti_mode == "parametric")
            {
/*              $graphstyle = array( 0 => "solid line", 1 => "thick line", 2 => "shade above", 3 => "shade below", 4 => "trace", 5 => "animate", 6 => "dotted line");
              for ($i=1; $i<7; $i++)
                {
                  fwrite($handle, chr(array_search($onti_funcmode[$i], $graphstyle)));
                  $checksum += array_search($onti_funcmode[$i], $graphstyle);
                }*/
              $filesize = 0;
              for ($i=1; $i<7; $i++)
                {
                   unset($content);
                   $onti_funcselected[$i] = strlen($onti_functioncontent[$i]) > 0 ? $onti_funcselected[$i] : 'unselected';
                   fwrite($handle, chr($onti_funcselected[$i] == "selected" ? 0x23 : 0x03));
                   $checksum += $onti_funcselected[$i] == "selected" ? 0x23 : 0x03;

                   if (strlen($onti_functioncontent[$i]) > 0)
                     {
                       $text = tokenise('\r'.$onti_functioncontent[$i]."\r", false, true, true);
                       $text = substr($text, 3, -1);
                     }
                   else
                     $text = "";

                   $filesize += strlen($text) + 2;
                   fwrite($handle, chr( strlen($text) & 0xFF ));
                   $checksum += strlen($text) & 0xFF;
                   fwrite($handle, chr( strlen($text) >> 8 & 0xFF ));
                   $checksum += strlen($text) >> 8 & 0xFF;

                   for($j=0; $j<strlen($text); $j++)
                     {
//                       $content[] = ord($text[$j]);
                       fwrite($handle, $text[$j]);
                       $checksum += ord($text[$j]);
                     }

                   fwrite($handle, chr($onti_funcselected[$i] == "selected" ? 0x23 : 0x03));
                   $checksum += $onti_funcselected[$i] == "selected" ? 0x23 : 0x03;

                   if (strlen($onti_functioncontent2[$i]) > 0)
                     {
                       $text = tokenise('\r'.$onti_functioncontent2[$i]."\r", false, true, true);
                       $text = substr($text, 3, -1);
                     }
                   else
                     $text = "";
                   $filesize += strlen($text) + 2;
                   fwrite($handle, chr( strlen($text) & 0xFF ));
                   $checksum += strlen($text) & 0xFF;
                   fwrite($handle, chr( strlen($text) >> 8 & 0xFF ));
                   $checksum += strlen($text) >> 8 & 0xFF;

                   for($j=0; $j<strlen($text); $j++)
                     {
//                       $content[] = ord($text[$j]);
                       fwrite($handle, $text[$j]);
                       $checksum += ord($text[$j]);
                     }
                }
              $filesize += 104-8;                            
            }
          else if ($onti_mode == "polar")
            {
/*              $graphstyle = array( 0 => "solid line", 1 => "thick line", 2 => "shade above", 3 => "shade below", 4 => "trace", 5 => "animate", 6 => "dotted line");
              for ($i=0; $i<6; $i++)
                {
                  fwrite($handle, chr(array_search($onti_funcmode[$i], $graphstyle)));
                  $checksum += array_search($onti_funcmode[$i], $graphstyle);
                }*/
              $filesize = 0;
              for ($i=0; $i<6; $i++)
                {
                   unset($content);
                   $onti_funcselected[$i] = strlen($onti_functioncontent[$i]) > 0 ? $onti_funcselected[$i] : 'unselected';
                   fwrite($handle, chr($onti_funcselected[$i] == "selected" ? 0x23 : 0x03));
                   $checksum += $onti_funcselected[$i] == "selected" ? 0x23 : 0x03;

                   if (strlen($onti_functioncontent[$i]) > 0)
                     {
                       $text = tokenise('\r'.$onti_functioncontent[$i]."\r", false, true, true);
                       $text = substr($text, 3, -1);
                     }
                   else
                     $text = "";
                   $filesize += strlen($text) + 2;
                   fwrite($handle, chr( strlen($text) & 0xFF ));
  