<?
  session_start();

  $onti_comment = isset($_SESSION["onti_comment"]) ? $_SESSION["onti_comment"] : 'Created on ti.zewaren.net';
  $onti_calctype = isset($_SESSION["onti_calctype"]) ? $_SESSION["onti_calctype"] : '83';
  $onti_filename = isset($_SESSION["onti_filename"]) ? $_SESSION["onti_filename"] : 'GDB1';
  $onti_storetype = isset($_SESSION["onti_storetype"]) ? $_SESSION["onti_storetype"] : 'RAM';

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
  $onti_graphsettings8 = isset($_SESSION["onti_graphsettings8"]) ? $_SESSION["onti_graphsettings8"] : "EXPROFF";

  $onti_funcmode = isset($_SESSION["onti_funcmode"]) ? $_SESSION["onti_funcmode"] : array('solid line');
  $onti_functioncontent = isset($_SESSION["onti_functioncontent"]) ? $_SESSION["onti_functioncontent"] : array ("");
  $onti_functioncontent2 = isset($_SESSION["onti_functioncontent2"]) ? $_SESSION["onti_functioncontent2"] : array ("");
  $onti_funcselected = isset($_SESSION["onti_funcselected"]) ? $_SESSION["onti_funcselected"] : array('unselected');

  $onti_mode = isset($_SESSION["onti_mode"]) ? $_SESSION["onti_mode"] : "function";

  $onti_sequencemode = isset($_SESSION["onti_sequencemode"]) ? $_SESSION["onti_sequencemode"] : "Time";

  $filetype = isset($_GET["type"]) ? $_GET["type"] : "8xd";
    if ($filetype == "8xd")
      {
        //83P/84 Family
        if ($onti_calctype == '83P')
          {
               for($i=0; $i<75; $i++)
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

              $entete[55] = 0xD;
              $entete[59] = 0x08;
              $entete[60] = 0x61;

              $tinumber = substr($onti_filename, 3, 1);
              $tinumber = $tinumber == "0" ? '9' : $tinumber - 1;

              $entete[61] = $tinumber;

              $entete[69] = $onti_storetype == 'RAM' ? 0 : 128;

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
                  $modes = array ( "Time" => 0x80, "Web" => 0x81, "uv" => 0x84, "vw" => 0x88, "uw" => 0x90 );
                  fwrite($handle, chr($modes[$onti_sequencemode]));
                  $checksum += $modes[$onti_sequencemode];
                }
              else
                {
                  fwrite($handle, chr(0x80));
                  $checksum += 0x80;
                }

              fwrite($handle, chr($onti_graphsettings8 == "EXPROFF" ? 0x21 : 0x20));
              $checksum += $onti_graphsettings8 == "EXPROFF" ? 0x21 : 0x20;

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
                  $graphstyle = array( 0 => "solid line", 1 => "thick line", 2 => "shade above", 3 => "shade below", 4 => "trace", 5 => "animate", 6 => "dotted line");
                  for ($i=0; $i<10; $i++)
                    {
                      fwrite($handle, chr(array_search($onti_funcmode[$i], $graphstyle)));
                      $checksum += array_search($onti_funcmode[$i], $graphstyle);
                    }
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
                  $filesize += 88;                    
                }
              else if ($onti_mode == "parametric")
                {
                  $graphstyle = array( 0 => "solid line", 1 => "thick line", 2 => "shade above", 3 => "shade below", 4 => "trace", 5 => "animate", 6 => "dotted line");
                  for ($i=1; $i<7; $i++)
                    {
                      fwrite($handle, chr(array_search($onti_funcmode[$i], $graphstyle)));
                      $checksum += array_search($onti_funcmode[$i], $graphstyle);
                    }
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
                  $filesize += 104;                            
                }
              else if ($onti_mode == "polar")
                {
                  $graphstyle = array( 0 => "solid line", 1 => "thick line", 2 => "shade above", 3 => "shade below", 4 => "trace", 5 => "animate", 6 => "dotted line");
                  for ($i=0; $i<6; $i++)
                    {
                      fwrite($handle, chr(array_search($onti_funcmode[$i], $graphstyle)));
                      $checksum += array_search($onti_funcmode[$i], $graphstyle);
                    }
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
                  $filesize += 98;
                }
              else if ($onti_mode == "sequence")
                {
                  $graphstyle = array( 0 => "solid line", 1 => "thick line", 2 => "shade above", 3 => "shade below", 4 => "trace", 5 => "animate", 6 => "dotted line");
                  for ($i=0; $i<3; $i++)
                    {
                      fwrite($handle, chr(array_search($onti_funcmode[$i], $graphstyle)));
                      $checksum += array_search($onti_funcmode[$i], $graphstyle);
                    }
                  $filesize = 0;
                  for ($i=0; $i<3; $i++)
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
                    }
                  $filesize += 155;                    
                }

              for ($i=55; $i<75; $i++)
                $checksum += $entete[$i];

              fseek($handle, 72);
              fwrite($handle, chr($filesize & 0xFF));
              fwrite($handle, chr($filesize >> 8 & 0xFF));
              $checksum += $filesize & 0xFF;

              $filesize += 2;

              fseek($handle, 53);
              fwrite($handle, chr($filesize+0x11 & 0xFF));
              fwrite($handle, chr($filesize+0x11 >> 8 & 0xFF));

              fseek($handle, 57);
              fwrite($handle, chr($filesize & 0xFF));
              fwrite($handle, chr($filesize >> 8 & 0xFF));
              $checksum += $filesize & 0xFF;

              fseek($handle, 70);
              fwrite($handle, chr($filesize & 0xFF));
              fwrite($handle, chr($filesize >> 8 & 0xFF));
              $checksum += $filesize & 0xFF;

              fseek($handle, 0, SEEK_END);
              fwrite($handle, Chr($checksum & 0xFF));
              fwrite($handle, Chr(($checksum >> 8) & 0xFF));

              fclose($handle);

              $final_filename = "$onti_filename.tizw.8xd";
              header( 'Content-Type: application/octet-stream' );
              header('Content-Disposition: attachment; filename="'.$final_filename.'"');
              header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
              readfile(session_id().'.dat');
          }
        //83 Family
        else if ($onti_calctype == '83')
          {
               for($i=0; $i<73; $i++)
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
                  $modes = array ( "Time" => 0x80, "Web" => 0x81, "uv" => 0x84, "vw" => 0x88, "uw" => 0x90 );
                  fwrite($handle, chr($modes[$onti_sequencemode]));
                  $checksum += $modes[$onti_sequencemode];
                }
              else
                {
                  fwrite($handle, chr(0x80));
                  $checksum += 0x80;
                }

              fwrite($handle, chr($onti_graphsettings8 == "EXPROFF" ? 0x21 : 0x20));
              $checksum += $onti_graphsettings8 == "EXPROFF" ? 0x21 : 0x20;

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
                  $graphstyle = array( 0 => "solid line", 1 => "thick line", 2 => "shade above", 3 => "shade below", 4 => "trace", 5 => "animate", 6 => "dotted line");
                  for ($i=0; $i<10; $i++)
                    {
                      fwrite($handle, chr(array_search($onti_funcmode[$i], $graphstyle)));
                      $checksum += array_search($onti_funcmode[$i], $graphstyle);
                    }
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
                  $filesize += 88;                    
                }
              else if ($onti_mode == "parametric")
                {
                  $graphstyle = array( 0 => "solid line", 1 => "thick line", 2 => "shade above", 3 => "shade below", 4 => "trace", 5 => "animate", 6 => "dotted line");
                  for ($i=1; $i<7; $i++)
                    {
                      fwrite($handle, chr(array_search($onti_funcmode[$i], $graphstyle)));
                      $checksum += array_search($onti_funcmode[$i], $graphstyle);
                    }
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
                  $filesize += 104;                            
                }
              else if ($onti_mode == "polar")
                {
                  $graphstyle = array( 0 => "solid line", 1 => "thick line", 2 => "shade above", 3 => "shade below", 4 => "trace", 5 => "animate", 6 => "dotted line");
                  for ($i=0; $i<6; $i++)
                    {
                      fwrite($handle, chr(array_search($onti_funcmode[$i], $graphstyle)));
                      $checksum += array_search($onti_funcmode[$i], $graphstyle);
                    }
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
                  $filesize += 98;
                }
              else if ($onti_mode == "sequence")
                {
                  $graphstyle = array( 0 => "solid line", 1 => "thick line", 2 => "shade above", 3 => "shade below", 4 => "trace", 5 => "animate", 6 => "dotted line");
                  for ($i=0; $i<3; $i++)
                    {
                      fwrite($handle, chr(array_search($onti_funcmode[$i], $graphstyle)));
                      $checksum += array_search($onti_funcmode[$i], $graphstyle);
                    }
                  $filesize = 0;
                  for ($i=0; $i<3; $i++)
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
                    }
                  $filesize += 155;                    
                }

              for ($i=55; $i<72; $i++)
                $checksum += $entete[$i];

//              $filesize--;

              fseek($handle, 70);
              fwrite($handle, chr($filesize & 0xFF));
              fwrite($handle, chr($filesize >> 8 & 0xFF));
              $checksum += $filesize & 0xFF;

              $filesize += 2;

              fseek($handle, 53);
              fwrite($handle, chr($filesize+0x0F & 0xFF));
              fwrite($handle, chr($filesize+0x0F >> 8 & 0xFF));

              fseek($handle, 57);
              fwrite($handle, chr($filesize & 0xFF));
              fwrite($handle, chr($filesize >> 8 & 0xFF));
              $checksum += $filesize & 0xFF;

              fseek($handle, 68);
              fwrite($handle, chr($filesize & 0xFF));
              fwrite($handle, chr($filesize >> 8 & 0xFF));
              $checksum += $filesize & 0xFF;

              fseek($handle, 0, SEEK_END);
              fwrite($handle, Chr($checksum & 0xFF));
              fwrite($handle, Chr(($checksum >> 8) & 0xFF));

              fclose($handle);

              $final_filename = "$onti_filename.tizw.83d";
              header( 'Content-Type: application/octet-stream' );
              header('Content-Disposition: attachment; filename="'.$final_filename.'"');
              header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
              readfile(session_id().'.dat');   
          }
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
                          "Tstep",
                          "PlotStart",
                          "nMax",
                          "u(nMin), first element",
                          "v(nMin), first element",
                          "nMin",
                          "u(nMin), second element",
                          "v(nMin), second element",
                          "w(nMin), first element",
                          "PlotStep",
                          "Xres",
                          "w(nMin), second element",
                        );
         for ($i=0; $i<$listcount; $i++)
           {
             $text .= $names[$i].': ';
             $text .= ($onti_numbersign[$i] == "positive" ? '' : '-').($onti_mantissa[$i]).('e').($onti_expsign[$i] == "positive" ? '' : '-').abs($onti_exposant[$i]);
             $text .= "\r\n";
           }
         if ($filetype != "txtnoheader")
           {
             $str = "Comment: ".$onti_comment;
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

function tokenise($ascstr, $as_plain_text, $lowercase_has_priority, $case_sensitive)
{
  if ($as_plain_text)
    {
      $ascstr = Tokens($ascstr, false, $lowercase_has_priority, 0);
      $ascstr = Tokens($ascstr, true, $lowercase_has_priority, $case_sensitive ? 1 : 0);
    }
  else
    {
      $ascstr = Tokens($ascstr, true, $lowercase_has_priority, $case_sensitive ? 1 : 0);
      $ascstr = Tokens($ascstr, false, $lowercase_has_priority, 0);
    }
  $ascstr = str_replace(chr(38),'',$ascstr);
  $ascstr = str_replace('ï','',$ascstr);
  return $ascstr;
}

function Tokens($astr, $longtoken, $lcp, $cs)
{
    $tokens = fopen("ti83tokens.dat", "rb");
    fseek($tokens, 0);
    for ($i=0; $i<filesize("ti83tokens.dat") / 16; $i++)
      {
        fseek($tokens, $i*16);
          for ($j=0; $j<16; $j++)
            {
               $MP[$i][$j] = ord(fread($tokens, 1));
//               echo "'".$MP[$i][$j].'"';
            }
      }
    fclose($tokens);
    $cChar = "";
    $bytecnt = -1;
    $twobyte = 0;
    $tableindex = -1;
    while (true)
    {
      $tableindex++;
        if ($tableindex > count($MP)-1)
          return $astr;
      $BS = '';
      for ($i=0; $i<count($MP[$tableindex]); $i++)
        if ($MP[$tableindex][$i] > 0xF)
          $BS .= chr($MP[$tableindex][$i]);
      $bytecnt++;
      $d = $BS;
        if ($d == "")
          return $astr;
        else if ($d == chr(38).'$black')
          continue;

        if ($longtoken)
          {
            if (strlen($d) == 1)
              continue;
          }
        else if ( (strlen($d) > 1) && ($d[0] != chr(38)) )
          continue;
        if ($lcp && (strlen($d) == 1) && (ord($d[0]) > 96) && (ord($d[0]) < 123) && $twobyte <> 187)
          continue;                     


        if ( strlen($d) > 1 && ord($d[0]) == 38 && $d[1]=='!' )
          {
            $twobyte = substr($d, 2);
            $bytecnt = -1;
            continue;
          }
      $cChar = Chr($bytecnt);
        if ($twobyte > 0)
          $cChar = chr($twobyte) . $cChar;
        if ($d == Chr(38).'#CRLF')
          $astr = ReplaceStrb($astr, "", $cChar.'ï');
        else
          {
            $pos = -1;
            while (true)
              {
                $pos = InStr($pos+2, $astr, $d, $cs);
                $pos = $pos == false ? 0 : $pos;
                  if ($pos==0)
                    break;
                $s1 = InStrRev($astr, 'ï', $pos);
                $s2 = InStrRev($astr, chr(38), $pos);
                  if ($s1 > $s2 || $s2==0)
                    $astr = substr($astr, 0, $pos) . chr(38) . $cChar . "ï" . substr($astr, $pos+strlen($d));
              }
          }

//      echo $BS.'<br>';
    }
/*
        pos := -1;
        repeat
          pos := InStr(pos+2, astr, d, cs);
            if pos = 0 then
              Break;
          s1 := InStrRev(astr, 'ï', pos);
          s2 := InStrRev(astr, Chr(38), pos);
          if (s1 > s2) or (s2=0) then
            astr := copy(astr, 1, pos - 1) + Chr(38)+ cChar + 'ï' + copy(astr, pos+length(d), length(astr)-pos-length(d)+1);
        until false;
      end;

  goto Beginning;
lEnd:

*/
}

/*function Tokens(astr : string; longtoken : boolean; lcp : boolean; cs : integer) : string;*/

function PosA($input, $poswhat)
{
  for ($i=0; $i<count($input); $i++)
    {
      $buffer_boolean = true;
      if ($i+strlen($poswhat) > count($input))
        return 0;
      for ($j=0; $j<strlen($poswhat); $j++)
        {
          if ($input[$i+$j] != ord($poswhat[$j]))
            $buffer_boolean=false;
        }
      if ($buffer_boolean)
        return $i;
    }
  return 0;
}

function ReplaceStrb($input, $search, $replacebywhat)
{
  $i=0;
  $bresult = "";
    while($i<strlen($input))
    {
      if (ord($input[$i]) == 13)
        {
          $bresult .= chr(38).$replacebywhat;
          $i++;
        }
      else
        $bresult .= $input[$i];
      $i++;
    }
  return $bresult;
}

/*
  function ReplaceStrb(input : string; search : string; replacebywhat : string) : string;
  var
    i : word;
    bresult : string;
    BufferString: string;
  begin
    i := 1;
    bresult := '';
    repeat
      if (Ord(input[i]) = 13) then
        begin
          bresult := bresult + Chr(38)+ replacebywhat;
          inc(i);
        end
      else
        bresult := bresult + input[i];
      inc(i);
    until i > length(input);
    result := bresult;
  end;
*/

function InStr($start, $string1, $string2, $comparemethode=0)
{
  if ($start > strlen($string1))
    return 0;
  if ($comparemethode==0)
    $bresult = strpos($string1, $string2, $start);
  else
    $bresult = strpos(strtolower($string1), strtolower($string2), $start);

  return $bresult;
}

/*
function InStr( start : integer; string1, string2 : string; comparemethode : byte = 0) : integer;
begin
  Result := 0;
  if start > length(string1) then
    Exit;
  if comparemethode = 0 then
    result := system.Pos(string2, copy(string1, start, length(string1)-start))
  else
    result := system.Pos(Lowercase(string2), lowercase(copy(string1, start, length(string1)-start)));
  if Result > 0 then
    Result := Result + start - 1;
//  Result := Result + start - start;
end;
*/

function InStrRev($sCheck, $sMatch, $start=-1, $Compare=0)
{
  $bresult = 0;
  $lensearchfor = strlen($sMatch);
  if ($lensearchfor > 0)
    {
      if ($start <= 0)
        $start = strlen(sCheck);
        while (true)
          {
            $posFound = InStr($bresult+2, $sCheck, $sMatch, $Compare);
              if ($posFound > 0 && ($posFound + $lensearchfor - 1 <= $start))
                $bresult = $posFound;
              else
                return $bresult;
          }
    }
  else
    {
      if ($start <= strlen(sCheck))
        return $start;
    }
  return 0;  
}

/*
function InStrRev( sCheck : string; sMatch : string; start : longint = -1; Compare : byte = 0) : integer;
var
  lenSearchFor : word;
  posFound : word;
begin
  result := 0;
  lenSearchFor := length(sMatch);
  if lenSearchFor > 0 then
    begin
      if start <= 0 then
        start := length(sCheck);
      repeat
        posFound := InStr(result+2, scheck, smatch, compare);
        if (posFound > 0) and (posFound + lenSearchFor -1 <= start) then
          Result := posFound
        else
          Exit;
      until false;
    end
  else
    begin
      if start <= Length(sCheck) then
        Result := start;
    end;
end;
*/      

?>
