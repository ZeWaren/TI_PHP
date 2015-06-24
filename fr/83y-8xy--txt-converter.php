<?
  session_start();
  include "top.php";
?>

<?
 $uploadDir = 'tempuploaded/';
 $ffilename=session_id();
   if ( (!isset($_FILES['userfile'])) || (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadDir . $ffilename)))
     {
       echo '<a href="index.php">Retour au menu principal</a>';
       echo '<h2>Ouvrir un fichier</h2>';
       echo '<form enctype="multipart/form-data" action="83y-8xy--txt-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir une équation TI (83y, 8xy): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
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
       echo '<a href="index.php">Retour au menu principal</a>';
       echo '<h2>Ouvrir un fichier</h2>';
       echo '<form enctype="multipart/form-data" action="83y-8xy--txt-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir une équation TI (83y, 8xy): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
       echo '</form>';
       include "bottom.php";
       die();
    }

  fseek($handle, 0);
  $contents = fread($handle, 8);

  if ($contents == "**TI83F*")
    {
          fseek($handle,60);
          $contents = fread($handle, 1);
          if (ord($contents) != 0x5E)
            {
               echo 'File Problem - Doesn\'t seem to be a Equation File<br>';
               echo '<a href="index.php">Retour au menu principal</a>';
               echo '<h2>Ouvrir un fichier</h2>';
               echo '<form enctype="multipart/form-data" action="83y-8xy--txt-converter.php" method="post">';
               echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
               echo 'Ouvrir une équation TI (83y, 8xy): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
               echo '</form>';
               include "bottom.php";
               die();
            }

          fseek($handle,11);
          $contents = fread($handle, 40);
          $TIComment = VireZeroTerminaux($contents);

          fseek($handle,61);
          $contents = ord(fread($handle, 1));
            if ($contents < 0x1A)
              $TIName = 'Y'.(($contents - 0xF) == 0xA ? 0 : $contents - 0xF);
            else if ($contents < 0x2C)
              $TIName = (($contents - 0x1F) & 1 == 1 ? 'X' : 'Y').(($contents - 0x1F) == 0xA ? 0 : $contents - 0x1F).'T';
            else if ($contents < 0x45)
              $TIName = 'r'.(($contents - 0x3F) == 0xA ? 0 : $contents - 0x3F);
            else if ($contents == 0x80)
              $TIName = "u";
            else if ($contents == 0x81)
              $TIName = "v";

          fseek($handle,69);
          $contents = fread($handle, 1);
          $TIStoreType = ord($contents) == 128 ? "Archive" : "RAM";

          fseek($handle,70);
          $buffer = ord(fread($handle, 1));
          $buffer += ord(fread($handle, 1)) << 8;
          $strlenght = $buffer;

          fseek($handle,74);
            for ($i=0; $i<$strlenght-2; $i++)
              {
                $final_str[] = ord(fread($handle, 1));
              }
          $final_text = fdetokenize($final_str);

    }
  else if ($contents == "**TI83**")
    {
          fseek($handle,60);
          $contents = fread($handle, 1);
          if (ord($contents) != 0x5E)
            {
               echo 'File Problem - Doesn\'t seem to be a Equation File<br>';
               echo '<a href="index.php">Retour au menu principal</a>';
               echo '<h2>Ouvrir un fichier</h2>';
               echo '<form enctype="multipart/form-data" action="83y-8xy--txt-converter.php" method="post">';
               echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
               echo 'Ouvrir une équation TI (83y, 8xy): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
               echo '</form>';
               include "bottom.php";
               die();
            }

          fseek($handle,11);
          $contents = fread($handle, 40);
          $TIComment = VireZeroTerminaux($contents);

          fseek($handle,61);
          $contents = ord(fread($handle, 1));
            if ($contents < 0x1A)
              $TIName = 'Y'.(($contents - 0xF) == 0xA ? 0 : $contents - 0xF);
            else if ($contents < 0x2C)
              $TIName = 'X'.(($contents - 0x1F) == 0xA ? 0 : $contents - 0x1F).'T';
            else if ($contents < 0x45)
              $TIName = 'r'.(($contents - 0x3F) == 0xA ? 0 : $contents - 0x3F);
            else if ($contents == 0x80)
              $TIName = "u";
            else if ($contents == 0x81)
              $TIName = "v";

          fseek($handle,69);
          $contents = fread($handle, 1);

          fseek($handle,68);
          $buffer = ord(fread($handle, 1));
          $buffer += ord(fread($handle, 1)) << 8;
          $strlenght = $buffer;

          fseek($handle,72);
            for ($i=0; $i<$strlenght-2; $i++)
              {
                $final_str[] = ord(fread($handle, 1));
              }
          $final_text = fdetokenize($final_str);
    }

  $text = $final_text;

  $_SESSION["text"] = $text;
  $_SESSION["name"] = $TIName;
  $_SESSION["comment"] = $TIComment;
  $_SESSION["storetype"] = isset($TIStoreType) ? $TIStoreType : 'RAM';

  echo '<a href="index.php">Retour au menu principal</a>';
  echo '<h2>Ouvrir un fichier</h2>';
  echo '<form enctype="multipart/form-data" action="83y-8xy--txt-converter.php" method="post">';
  echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
  echo 'Ouvrir une équation TI (83y, 8xy): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
  echo '</form>';
  echo '<h2>Information sur le fichier</h2>';
  echo '<h3>Fichier ordinateur</h3><ul>';
  echo '<li>Nom du fichier: <font color="DimGray">"'.$_FILES['userfile']['name'].'"</font></li>';
  echo '<li>Taille du fichier: <font color="DimGray">'.FormatFileSize(filesize($uploadDir . $ffilename)).'</font></li>';
  echo '</ul>';
  echo '<h3>Entête du fichier:</h3><ul>';
  echo '<li>Nom: <font color="DimGray">"'.$TIName.'"</font></li>';
  echo '<li>Commentaire: <font color="DimGray">"'.$TIComment.'"</font></li>';
  echo isset($TIStoreType) ? '<li>Stockage: <font color="DimGray">'.$TIStoreType.'</font></li>' : '';
  echo '</ul>';

  echo '<h2>Contenu du fichier</h2>';
  echo '<div style="float: left;"><a href="83y-8xy-file-as-text-file.php"><img src="./images/extensions/txt.png"> Enregistrer en TXT</a></div>';
  echo '<div style="float: left;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="83y-8xy-file-as-text-file.php?noheader=true"><img src="./images/extensions/txt.png"> Enregistrer en TXT sans les informations d\'entête</a></div>';
  echo '<div style="float: right;"><a href="./fonts/TI-83PL.TTF"><img src="./images/extensions/font.gif"> Télécharger une police de TI-8x</a></div>';
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
    $tokens = fopen("ti83tokens.dat", "rb");
    fseek($tokens, 0);
    for ($i=0; $i<filesize("ti83tokens.dat") / 16; $i++)
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
