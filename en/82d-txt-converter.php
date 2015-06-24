<?
  session_start();
  include "top.php";
?>

<?
 $uploadDir = 'tempuploaded/';
 $ffilename=session_id();
   if ( (!isset($_FILES['userfile'])) || (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadDir . $ffilename)))
     {
       echo '<a href="index.php">Back to main menu</a>';
       echo '<h2>Open a file</h2>';
       echo '<form enctype="multipart/form-data" action="82d-txt-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI GDB File (82d): <input name="userfile" type="file" /> <input type="submit" value="Open">';
       echo '</form>';
       include "bottom.php";
       die();
     }

  function VireZeroTerminaux($input)
  {
    for ($i=0; $i<strlen($input); $i++)
      if ($i < strlen($input) && Ord($input[$i]) == 0)
        {
          $input = substr($input, 0, $i);
          return $input;
          break;
        }
     return $input;
  }

  function FormatFileSize($mysize)
  {
    $counter=0;
    while ($mysize > 1024) {$mysize=$mysize/1024; ++$counter;}
    switch ($counter) {
      case 2: $mysymbol="MB"; break;
      case 1: $mysymbol="KB"; break;
      case 0: $mysymbol="Bytes"; break;
      case 3: $mysymbol="GB";  break;
    }
    return sprintf ("%01.1f %s", $mysize, $mysymbol);
  }

  $filename = $uploadDir.session_id();
  $handle = fopen($filename, "rb");

  $contents = fread($handle, 4);
  if ($contents != "**TI")
    {
       echo 'File Problem - Doesn\'t seem to be a TI File<br>';
       echo '<a href="index.php">Back to main menu</a>';
       echo '<h2>Open a file</h2>';
       echo '<form enctype="multipart/form-data" action="82d-txt-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI GDB File (82d): <input name="userfile" type="file" /> <input type="submit" value="Open">';
       echo '</form>';
       include "bottom.php";
       die();
    }

  fseek($handle, 0);
  $contents = fread($handle, 8);

  if ($contents == "**TI82**")
    {
         function ReadNumber()
         {
            global $handle;
            $t_ot = ord(fread($handle, 1));

            $sign = ($t_ot >> 7) == 1 ? '-' : '';

            $exposant = ord(fread($handle, 1));
            if ($exposant < 0x80)
              {
                $exposant = -1*(0x80 - $exposant);
              }
            else
              {
                $exposant = 1*($exposant - 0x80);
              }

            $numberstring = "";
            for ($i=0; $i<7; $i++)
              {
                $digit = ord(fread($handle, 1));
                $numberstring .= strlen(dechex($digit)) == 1 ? '0'.dechex($digit) : dechex($digit);
              }
            for ($i=13; $i>0; $i--)
              {
                if ($numberstring[$i] != '0')
                  break;
              }
            $numberstring = substr($numberstring, 0, $i+1);

            $numberstring = $numberstring[0].'.'.substr($numberstring, 1);
              if (abs($exposant) < 14)
                {
                  $numberstring *= pow(10, $exposant);
                }
              else
                $numberstring .= ' E'.$exposant;
            return $sign .$numberstring;
         }

         function ReadFunction()
         {
            global $handle;

            $buffer = ord(fread($handle, 1));
            $buffer += ord(fread($handle, 1)) << 8;
            $strlenght = $buffer;

              if ($strlenght > 0)
                {
                  for ($i=0; $i<$strlenght; $i++)
                    {
                      $final_str[] = ord(fread($handle, 1));
                    }
                  $final_text = fdetokenize($final_str);
                }
              else $final_text = "";
              
            return $final_text;
         }

          fseek($handle,59);
          $contents = fread($handle, 1);
          if (ord($contents) != 0x08)
            {
               echo 'File Problem - Doesn\'t seem to be a GDB File<br>';
               echo '<a href="index.php">Back to main menu</a>';
               echo '<h2>Open a file</h2>';
               echo '<form enctype="multipart/form-data" action="82d-txt-converter.php" method="post">';
               echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
               echo 'Open a TI GDB File (82d): <input name="userfile" type="file" /> <input type="submit" value="Open">';
               echo '</form>';
               include "bottom.php";
               die();
            }
          fseek($handle,11);
          $contents = fread($handle, 40);
          $TIComment = VireZeroTerminaux($contents);

          fseek($handle,61);
          $contents = fread($handle, 1);
          $TIName = 'GDB'.(ord($contents) == 9 ? "0" : ord($contents)+1);

          $i=0;
          fseek($handle,72);

          $graphingmode = ord(fread($handle, 1));
            if ($graphingmode == 0x10)
              {
                $text = "Graphing Mode: Function";
                $modesettings = ord(fread($handle, 1));
                $text .= "\r\n\r\n"."Mode Settings:";
                $text .= "\r\n".(($modesettings & 1) == 1 ? "Dot" : "Connected");
                $text .= "\r\n".(($modesettings >> 1 & 1) == 1 ? "Simul" : "Sequencial");
                $text .= "\r\n".(($modesettings >> 2 & 1) == 1 ? "GridOn" : "GridOff");
                $text .= "\r\n".(($modesettings >> 3 & 1) == 1 ? "PolarGC" : "RectGC");
                $text .= "\r\n".(($modesettings >> 4 & 1) == 1 ? "CoordOff" : "CoordOn");
                $text .= "\r\n".(($modesettings >> 5 & 1) == 1 ? "AxesOff" : "AxesOn");
                $text .= "\r\n".(($modesettings >> 6 & 1) == 1 ? "LabelOn" : "LabelOff");

//                $quatrevingt = ord(fread($handle, 1));

                $extendedmodesettings = ord(fread($handle, 1));
//                $text .= "\r\n".(($extendedmodesettings & 1) == 1 ? "ExprOff" : "ExprOn");

                $text .= "\r\n\r\nXmin: ".ReadNumber();
                $text .= "\r\nXmax: ".ReadNumber();
                $text .= "\r\nXscl: ".ReadNumber();                                
                $text .= "\r\nYmin: ".ReadNumber();
                $text .= "\r\nYmax: ".ReadNumber();
                $text .= "\r\nYscl: ".ReadNumber();

                for ($i=0; $i<10; $i++)
                  {
                    $selecteds[$i] = ord(fread($handle, 1));
                    $functions[$i] = ReadFunction();
                  }

                $text2 = $text."\r\n\r\n";
                $text .= "\r\n\r\n<table><tr><td><u>Name</u></td><td><u>State</u></td><td><u>Content</u></td></tr>";
                for ($i=0; $i<10; $i++)
                  {
                    $text .= "<tr>";
                    $text .= "<td>Y".($i == 9 ? "0" : $i + 1)."</td>";
                    $text .= "<td>".($selecteds[$i] == 0x23 ? "selected " : "unselected")."</td>";
                    $text .= "<td>".$functions[$i]."</td>";
                    $text .= "</tr>";
                    $text2 .= "Y".($i == 9 ? "0" : $i + 1)."\t".($selecteds[$i] == 0x23 ? "selected " : "unselected")."\t".$functions[$i]."\r\n";
                  }
                $text .= "</table>";
              }
            else if ($graphingmode == 0x40)
              {
                $text = "Graphing Mode: Parametric";
                $modesettings = ord(fread($handle, 1));
                $text .= "\r\n\r\n"."Mode Settings:";
                $text .= "\r\n".(($modesettings & 1) == 1 ? "Dot" : "Connected");
                $text .= "\r\n".(($modesettings >> 1 & 1) == 1 ? "Simul" : "Sequencial");
                $text .= "\r\n".(($modesettings >> 2 & 1) == 1 ? "GridOn" : "GridOff");
                $text .= "\r\n".(($modesettings >> 3 & 1) == 1 ? "PolarGC" : "RectGC");
                $text .= "\r\n".(($modesettings >> 4 & 1) == 1 ? "CoordOff" : "CoordOn");
                $text .= "\r\n".(($modesettings >> 5 & 1) == 1 ? "AxesOff" : "AxesOn");
                $text .= "\r\n".(($modesettings >> 6 & 1) == 1 ? "LabelOn" : "LabelOff");

//                $quatrevingt = ord(fread($handle, 1));

                $extendedmodesettings = ord(fread($handle, 1));
//                $text .= "\r\n".(($extendedmodesettings & 1) == 1 ? "ExprOff" : "ExprOn");

                $text .= "\r\n\r\nXmin: ".ReadNumber();
                $text .= "\r\nXmax: ".ReadNumber();
                $text .= "\r\nXscl: ".ReadNumber();                                
                $text .= "\r\nYmin: ".ReadNumber();
                $text .= "\r\nYmax: ".ReadNumber();
                $text .= "\r\nYscl: ".ReadNumber();
                $text .= "\r\nTmin: ".ReadNumber();
                $text .= "\r\nTmax: ".ReadNumber();
                $text .= "\r\nTscl: ".ReadNumber();

                for ($i=0; $i<12; $i++)
                  {
                    $selecteds[$i] = ord(fread($handle, 1));
                    $functions[$i] = ReadFunction();
                  }

                $text2 = $text."\r\n\r\n";
                $text .= "\r\n\r\n<table><tr><td><u>Index</u></td><td><u>State</u></td><td><u>XxT</u></td><td><u>YxT</u></td></tr>";
                $count = 0;
                for ($i=0; $i<6; $i++)
                  {
                    $text .= "<tr>";
                    $text .= "<td>".($i == 9 ? "0" : $i + 1)."</td>";
                    $text .= "<td>".($selecteds[$i] == 0x23 ? "selected " : "unselected")."</td>";
                    $text .= "<td>".$functions[$count++]."</td>";
                    $text .= "<td>".$functions[$count++]."</td>";
                    $text .= "</tr>";
                    $text2 .= ($i == 9 ? "0" : $i + 1).($selecteds[$i] == 0x23 ? "selected " : "unselected")."\t".$functions[$count-2]."\t".$functions[$count-1]."\r\n";
                  }
                $text .= "</table>";
              }
            else if ($graphingmode == 0x20)
              {
                $text = "Graphing Mode: Polar";
                $modesettings = ord(fread($handle, 1));
                $text .= "\r\n\r\n"."Mode Settings:";
                $text .= "\r\n".(($modesettings & 1) == 1 ? "Dot" : "Connected");
                $text .= "\r\n".(($modesettings >> 1 & 1) == 1 ? "Simul" : "Sequencial");
                $text .= "\r\n".(($modesettings >> 2 & 1) == 1 ? "GridOn" : "GridOff");
                $text .= "\r\n".(($modesettings >> 3 & 1) == 1 ? "PolarGC" : "RectGC");
                $text .= "\r\n".(($modesettings >> 4 & 1) == 1 ? "CoordOff" : "CoordOn");
                $text .= "\r\n".(($modesettings >> 5 & 1) == 1 ? "AxesOff" : "AxesOn");
                $text .= "\r\n".(($modesettings >> 6 & 1) == 1 ? "LabelOn" : "LabelOff");

//                $quatrevingt = ord(fread($handle, 1));

                $extendedmodesettings = ord(fread($handle, 1));
//                $text .= "\r\n".(($extendedmodesettings & 1) == 1 ? "ExprOff" : "ExprOn");

                $text .= "\r\n\r\nXmin: ".ReadNumber();
                $text .= "\r\nXmax: ".ReadNumber();
                $text .= "\r\nXscl: ".ReadNumber();                                
                $text .= "\r\nYmin: ".ReadNumber();
                $text .= "\r\nYmax: ".ReadNumber();
                $text .= "\r\nYscl: ".ReadNumber();
                $text .= "\r\nTetaMin: ".ReadNumber();
                $text .= "\r\nTetaMax: ".ReadNumber();
                $text .= "\r\nTetaStep: ".ReadNumber();

                for ($i=0; $i<6; $i++)
                  {
                    $selecteds[$i] = ord(fread($handle, 1));
                    $functions[$i] = ReadFunction();
                  }

                $text2 = $text."\r\n\r\n";
                $text .= "\r\n\r\n<table><tr><td><u>Name</u></td><td><u>State</u></td><td><u>Content</u></td></tr>";
                for ($i=0; $i<6; $i++)
                  {
                    $text .= "<tr>";
                    $text .= "<td>r".($i == 9 ? "0" : $i + 1)."</td>";
                    $text .= "<td>".($selecteds[$i] == 0x23 ? "selected " : "unselected")."</td>";
                    $text .= "<td>".$functions[$i]."</td>";
                    $text .= "</tr>";
                    $text2 .= "r".($i == 9 ? "0" : $i + 1).($selecteds[$i] == 0x23 ? "selected " : "unselected")."\t".$functions[$i]."\r\n";
                  }
                $text .= "</table>";
              }
            else if ($graphingmode == 0x80)
              {
                $text = "Graphing Mode: Sequence";
                $modesettings = ord(fread($handle, 1));
                $text .= "\r\n\r\n"."Mode Settings:";
                $text .= "\r\n".(($modesettings & 1) == 1 ? "Dot" : "Connected");
                $text .= "\r\n".(($modesettings >> 1 & 1) == 1 ? "Simul" : "Sequencial");
                $text .= "\r\n".(($modesettings >> 2 & 1) == 1 ? "GridOn" : "GridOff");
                $text .= "\r\n".(($modesettings >> 3 & 1) == 1 ? "PolarGC" : "RectGC");
                $text .= "\r\n".(($modesettings >> 4 & 1) == 1 ? "CoordOff" : "CoordOn");
                $text .= "\r\n".(($modesettings >> 5 & 1) == 1 ? "AxesOff" : "AxesOn");
                $text .= "\r\n".(($modesettings >> 6 & 1) == 1 ? "LabelOn" : "LabelOff");

                $quatrevingt = ord(fread($handle, 1));

//                $extendedmodesettings = ord(fread($handle, 1));
//                $text .= "\r\n".(($extendedmodesettings & 1) == 1 ? "ExprOff" : "ExprOn");

                $text .= "\r\n\r\nXmin: ".ReadNumber();
                $text .= "\r\nXmax: ".ReadNumber();
                $text .= "\r\nXscl: ".ReadNumber();                                
                $text .= "\r\nYmin: ".ReadNumber();
                $text .= "\r\nYmax: ".ReadNumber();
                $text .= "\r\nYscl: ".ReadNumber();
                $text .= "\r\nnMin: ".ReadNumber();
                $text .= "\r\nnMax: ".ReadNumber();
                $text .= "\r\nUnStart: ".ReadNumber();
                $text .= "\r\nVnStart: ".ReadNumber();
                $text .= "\r\nnStart: ".ReadNumber();                                

                for ($i=0; $i<3; $i++)
                  {
                    $selecteds[$i] = ord(fread($handle, 1));
                    $functions[$i] = ReadFunction();
                  }

                $text2 = $text."\r\n\r\n";
                $text .= "\r\n\r\n<table><tr><td><u>Name</u></td><td><u>Style</u></td><td><u>State</u></td><td><u>Content</u></td></tr>";
                $functionnames = array ("u", 'v', "w");
                for ($i=0; $i<3; $i++)
                  {
                    $text .= "<tr>";
                    $text .= "<td>".$functionnames[$i]."</td>";
                    $text .= "<td>".($selecteds[$i] == 0x23 ? "selected " : "unselected")."</td>";
                    $text .= "<td>".$functions[$i]."</td>";
                    $text .= "</tr>";
                    $text2 .= $functionnames[$i].($selecteds[$i] == 0x23 ? "selected " : "unselected")."\t".$functions[$i]."\r\n";
                  }
                $text .= "</table>";
              }
    }

  $_SESSION["text"] = $text2;
  $_SESSION["name"] = $TIName;  
  $_SESSION["comment"] = $TIComment;
  $_SESSION["storetype"] = isset($TIStoreType) ? $TIStoreType : 'RAM';

  echo '<a href="index.php">Back to main menu</a>';
  echo '<h2>Open a file</h2>';
  echo '<form enctype="multipart/form-data" action="82d-txt-converter.php" method="post">';
  echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
  echo 'Open a TI GDB File (82d): <input name="userfile" type="file" /> <input type="submit" value="Open">';
  echo '</form>';
  echo '<h2>File Information</h2>';
  echo '<h3>On Computer:</h3><ul>';
  echo '<li>FileName: <font color="DimGray">"'.$_FILES['userfile']['name'].'"</font></li>';
  echo '<li>File Size: <font color="DimGray">'.FormatFileSize(filesize($uploadDir . $ffilename)).'</font></li>';
  echo '</ul>';
  echo '<h3>File Header:</h3><ul>';
  echo '<li>Variable Name: <font color="DimGray">"'.$TIName.'"</font></li>';
  echo '<li>Comment: <font color="DimGray">"'.$TIComment.'"</font></li>';
  echo isset($TIStoreType) ? '<li>Store Type: <font color="DimGray">'.$TIStoreType.'</font></li>' : '';
  echo '</ul>';

  echo '<h2>File Content</h2>';
  echo '<div style="float: left;"><a href="83d-8xd-file-as-text-file.php"><img src="./images/extensions/txt.png"> Save as TXT</a></div>';
  echo '<div style="float: left;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="83d-8xd-file-as-text-file.php?noheader=true"><img src="./images/extensions/txt.png"> Save as TXT without any header information</a></div>';
  echo '<div style="float: right;"><a href="./fonts/TI-83PL.TTF"><img src="./images/extensions/font.gif"> Download a TI8X Font</a></div>';
  echo '<br><br>';
  echo '<div id="ti83content"><div style="padding: 3px;">'.nl2br($text).'</div></div>';


/*  $count = 0;
  //TABLE HEXA
  echo '<h1>File Hexa</h1><br>';
  fseek($handle,0);
  echo '<hr><table><tr>';
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
  fclose($handle);

  function PosA($input, $poswhat)
  {
     for ($i=0; $i<count($input); $i++)
       {
         if ($input[$i] == ($poswhat[0]) && $input[$i+1] == ($poswhat[1]))
           return $i;
       }
     return 0;
  }

  function fdetokenize($tokenstring)
  {
    //Recupération des tokens
    $tokens = fopen("ti82tokens.dat", "rb");
    fseek($tokens, 0);
    for ($i=0; $i<filesize("ti82tokens.dat") / 16; $i++)
      {
        fseek($tokens, $i*16);
          for ($j=0; $j<16; $j++)
            {
               $MP[$i][$j] = fread($tokens, 1);
//               echo "'".$MP[$i][$j].'"';
            }
      }
    fclose($tokens);
    //Traitement
    $char=0;
    $result = "";
    while($char < count($tokenstring))
      {
        $pos = $tokenstring[$char];
          if ($pos > count($MP))
            {
              return 'Invalid Token!';
            }
        $st = "";
        $st2 = "";
          for ($i=1; $i<9; $i++)
            {
              if (ord($MP[$pos][$i]) > 0xE)
                {
//                  echo $MP[$pos][$i];
                  $st .= $MP[$pos][$i];
                }  
            }
          $X = PosA($MP[$pos], chr(38).'*');
          if ($X > 0)
            {
              $X -= 2;
              $char++;
                if (count(array_slice($tokenstring, $char, 1))==0)
                  {
                    return 'Error! Missing 2';
                  }
              $bufferword = substr($st, $X, 5);
              $st="";
                if ($bufferword + $tokenstring[$char] <= count($MP))
                  for($i=0; $i<9; $i++)
                    {
                      if (ord($MP[ $bufferword + $tokenstring[$char] ][$i]) > 0xF)
                        {
                          $st .= $MP[$bufferword + $tokenstring[$char]][$i];
                        }
                    }
            }

        if ($st == chr(38) . '$black')
          $st="";
        if ($st == chr(38) . '#CRLF')
          $st="\r\n";
//          echo $pos.' ';
//          echo '"'.$st.'"<br/>';
        $result .= $st;
        $char++;
      }
    return $result;
  }

?>

<?
  include "bottom.php";
?>
