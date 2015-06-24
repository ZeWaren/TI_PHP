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
       echo '<form enctype="multipart/form-data" action="8xp-keys-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI Program File (8xp): <input name="userfile" type="file" /> <input type="submit" value="Open">';
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
       echo '<form enctype="multipart/form-data" action="8xp-keys-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI Program File (8xp): <input name="userfile" type="file" /> <input type="submit" value="Open">';
       echo '</form>';
       include "bottom.php";
       die();
    }

  fseek($handle,59);
  $contents = fread($handle, 1);
  if (ord($contents) != 5)
    {
       echo 'File Problem - Doesn\'t seem to be a program File<br>';
       echo '<a href="index.php">Back to main menu</a>';
       echo '<h2>Open a file</h2>';
       echo '<form enctype="multipart/form-data" action="8xp-keys-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI Program File (8xp): <input name="userfile" type="file" /> <input type="submit" value="Open">';
       echo '</form>';
       include "bottom.php";
       die();
    }

  fseek($handle,11);
  $contents = fread($handle, 40);
  $TIComment = VireZeroTerminaux($contents);

  fseek($handle,60);
  $contents = fread($handle, 8);
  $TIName = VireZeroTerminaux($contents);

  fseek($handle,69);
  $contents = fread($handle, 1);
  $TIStoreType = ord($contents) == 128 ? "Archive" : "RAM";

  $i=0;
  fseek($handle,74);
    while (!feof($handle))
    {
      $Bytes[$i] = ord(fread($handle, 1));
//      echo $Bytes[$i];
      $i++;
    }
  $text1 = fdetokenize($Bytes);
  $text= $text1[0];
  $text2 = $text1[1];
  $_keys = explode("\r\n", $text);
  $_lines = explode("\r\n", $text2);
  $_lines[0] .= "\r\n";
  $text = "";
    for ($i=0; $i<count($_keys); $i++)
      {
        $text .= $_lines[$i]."".$_keys[$i]."\r\n\r\n";
      }
  $_SESSION["text"] = $text;
  $_SESSION["name"] = $TIName;
  $_SESSION["comment"] = $TIComment;
  $_SESSION["storetype"] = $TIStoreType;

  echo '<a href="index.php">Back to main menu</a>';
  echo '<h2>Open a file</h2>';
  echo '<form enctype="multipart/form-data" action="8xp-keys-converter.php" method="post">';
  echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
  echo 'Open a TI Program File (8xp): <input name="userfile" type="file" /> <input type="submit" value="Open">';
  echo '</form>';
  echo '<h2>File Information</h2>';
  echo '<h3>On Computer:</h3><ul>';
  echo '<li>FileName: <font color="DimGray">"'.$_FILES['userfile']['name'].'"</font></li>';
  echo '<li>File Size: <font color="DimGray">'.FormatFileSize(filesize($uploadDir . $ffilename)).'</font></li>';
  echo '</ul>';
  echo '<h3>File Header:</h3><ul>';
  echo '<li>Name: <font color="DimGray">"'.$TIName.'"</font></li>';
  echo '<li>Comment: <font color="DimGray">"'.$TIComment.'"</font></li>';
  echo '<li>Store Type: <font color="DimGray">'.$TIStoreType.'</font></li>';
  echo '</ul>';

  echo '<h2>File Content</h2>';
  echo '<div style="float: right;"><a href="./fonts/TI-83PL.TTF"><img src="./images/extensions/font.gif"> Download a TI8X Font</a></div>';
  echo '<br><br>';
  echo substr($text, 0, 3) == "Asm" ? '<font color="red">This program seems to be ASM and so it can\'t be displayed properly.</font><br><br>' : '';
  $text = str_replace('  ', '&nbsp;&nbsp;', $text);
  $text = str_replace('&nbsp; ', '&nbsp;&nbsp;', $text);
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
    $tokens = fopen("ti83tokenkeys.dat", "rb");
    $tokenstrue = fopen("ti83tokens.dat", "rb");
    fseek($tokens, 0);
    for ($i=0; $i<filesize("ti83tokenkeys.dat") / 16; $i++)
      {
        fseek($tokens, $i*16);
        fseek($tokenstrue, $i*16);
          for ($j=0; $j<16; $j++)
            {
               $MP[$i][$j] = fread($tokens, 1);
               $MPtrue[$i][$j] = fread($tokenstrue, 1);               
//               echo "'".$MP[$i][$j].'"';
            }
      }
    fclose($tokens);
    fclose($tokenstrue);
    //Traitement
    $char=0;
    $result = "";
    $result2 = "";    
    while($char < count($tokenstring)-3)
      {
        $pos = $tokenstring[$char];
          if ($pos > count($MP))
            {
              return 'Invalid Token!';
            }
        $st = "";
        $sttrue = "";
        $st2 = "";
        $realst = "";
          for ($i=1; $i<15; $i++)
            {
              if (ord($MP[$pos][$i]) > 0xE)
                {
//                  echo $MP[$pos][$i];
                  $st .= '<img src="./images/8xpkeys/chr'.ord($MP[$pos][$i]).'.gif">';
                }
              if (ord($MPtrue[$pos][$i]) > 0xE)
                {
                  $sttrue .= $MPtrue[$pos][$i];
                  $realst .= $MPtrue[$pos][$i];
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
              $bufferword = substr($realst, $X, 5);
              $st="";
              $sttrue="";
                if ($bufferword + $tokenstring[$char] <= count($MP))
                  for($i=0; $i<15; $i++)
                    {
                      if (ord($MP[ $bufferword + $tokenstring[$char] ][$i]) > 0xF)
                        {
                          $st .= '<img src="./images/8xpkeys/chr'.ord($MP[$bufferword + $tokenstring[$char]][$i]).'.gif">';
                        }
                      if (ord($MPtrue[ $bufferword + $tokenstring[$char] ][$i]) > 0xF)
                        {
                          $sttrue .= $MPtrue[$bufferword + $tokenstring[$char]][$i];
                        }
                    }
            }

        if ($sttrue == chr(38) . '$black')
          $sttrue="";
        if ($sttrue == chr(38) . '#CRLF')
          $sttrue="\r\n";
//          echo $pos.' ';
//          echo '"'.$st.'"<br/>';
          if ($sttrue == '&$black' || substr($sttrue, 0, 2) == '&*' || substr($sttrue, 0, 2) == '&!')
            {
              $st="";
              $sttrue="";
            }
        $result .= $st;
        if ($pos == 0x3F)
          $result .= "\r\n";
        $result2 .= $sttrue;
        if ($pos == 0x3F)
          $result .= "<br>";
        $char++;
      }
    $finalresult = array ($result, $result2);
    return $finalresult;
  }

  /*
      X := PosA(MP[pos], Chr(38)+'*');
      if X > 0 then
        begin
          X := X - 2;
          Char := Char + 1;
            if length(copy(tokenstring,Char,1)) = 0 then
              begin
                result := 'missing 2';
                Exit;
              end;
            BufferWord := strtoint(copy(st, X+1, 5));
            st := '';
            for i := 1 to 8 do
              begin
                if MP[BufferWord + tokenstring[Char]][i] > $F then
                  st := st + Chr(MP[BufferWord + tokenstring[Char]][i]);
              end;
        end;
      if st = Chr(38)+'$black' then
        st := '';
      if st = Chr(38)+'#CRLF' then
        st := #13#10;
      Result := Result + st;
      inc(char);
    end;
  */
?>

<?
  echo '</table>';
  include "bottom.php";
?>