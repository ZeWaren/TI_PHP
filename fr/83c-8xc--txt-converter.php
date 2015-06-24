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
       echo '<form enctype="multipart/form-data" action="83c-8xc--txt-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir un complexe TI (83c, 8xc): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
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
       echo '<form enctype="multipart/form-data" action="83c-8xc--txt-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir un complexe TI (83c, 8xc): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
       echo '</form>';
       include "bottom.php";
       die();
    }

  fseek($handle, 0);
  $contents = fread($handle, 8);

  if ($contents == "**TI83F*")
    {
          fseek($handle,53);
          $contents = fread($handle, 1);
          if (ord($contents) != 0x23)
            {
               echo 'File Problem - Doesn\'t seem to be a Complex File<br>';
               echo '<a href="index.php">Retour au menu principal</a>';
               echo '<h2>Ouvrir un fichier</h2>';
               echo '<form enctype="multipart/form-data" action="83c-8xc--txt-converter.php" method="post">';
               echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
               echo 'Ouvrir un complexe TI (83c, 8xc): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
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
          fseek($handle,72);

          //REAL PART
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

          //COMPLEX PART  
          $t_ot2 = ord(fread($handle, 1));
          $sign2 = ($t_ot2 >> 7) == 1 ? '-' : '+';
          $exposant2 = ord(fread($handle, 1));
          if ($exposant2 < 0x80)
            {
              $exposant2 = -1*(0x80 - $exposant2);
            }
          else
            {
              $exposant2 = 1*($exposant2 - 0x80);
            }
          $numberstring2 = "";
          for ($i=0; $i<7; $i++)
            {
              $digit = ord(fread($handle, 1));
              $numberstring2 .= strlen(dechex($digit)) == 1 ? '0'.dechex($digit) : dechex($digit);
            }
    }
  else if ($contents == "**TI83**")
    {
          fseek($handle,59);
          $contents = fread($handle, 1);
          if (ord($contents) != 0x0C)
            {
               echo 'File Problem - Doesn\'t seem to be a Number File<br>';
               echo '<a href="index.php">Retour au menu principal</a>';
               echo '<h2>Ouvrir un fichier</h2>';
               echo '<form enctype="multipart/form-data" action="83c-8xc--txt-converter.php" method="post">';
               echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
               echo 'Ouvrir un complexe TI (83c, 8xc): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
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

          $i=0;
          fseek($handle,70);

          //REAL PART
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

          //COMPLEX PART  
          $t_ot2 = ord(fread($handle, 1));
          $sign2 = ($t_ot2 >> 7) == 1 ? '-' : '+';
          $exposant2 = ord(fread($handle, 1));
          if ($exposant2 < 0x80)
            {
              $exposant2 = -1*(0x80 - $exposant2);
            }
          else
            {
              $exposant2 = 1*($exposant2 - 0x80);
            }
          $numberstring2 = "";
          for ($i=0; $i<7; $i++)
            {
              $digit = ord(fread($handle, 1));
              $numberstring2 .= strlen(dechex($digit)) == 1 ? '0'.dechex($digit) : dechex($digit);
            }    }

  //REAL PART
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
      $numberstring .= 'e'.$exposant;
  $text = $sign.$numberstring;

  //COMPLEX PART
  for ($i=13; $i>0; $i--)
    {
      if ($numberstring2[$i] != '0')
        break;
    }
  $numberstring2 = substr($numberstring2, 0, $i+1);
  $numberstring2 = $numberstring2[0].'.'.substr($numberstring2, 1);
    if (abs($exposant2) < 14)
      {
        $numberstring2 *= pow(10, $exposant2);
      }
    else
      $numberstring2 .= 'e'.$exposant2;
  $text .= ' '.$sign2.' '.$numberstring2.'i';  

  $_SESSION["text"] = $text;
  $_SESSION["name"] = $TIName;
  $_SESSION["comment"] = $TIComment;
  $_SESSION["storetype"] = isset($TIStoreType) ? $TIStoreType : 'RAM';

  echo '<a href="index.php">Retour au menu principal</a>';
  echo '<h2>Ouvrir un fichier</h2>';
  echo '<form enctype="multipart/form-data" action="83c-8xc--txt-converter.php" method="post">';
  echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
  echo 'Ouvrir un complexe TI (83c, 8xc): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
  echo '</form>';
  echo '<h2>Information sur le fichier</h2>';
  echo '<h3>Fichier ordinateur</h3><ul>';
  echo '<li>Nom du fichier: <font color="DimGray">"'.$_FILES['userfile']['name'].'"</font></li>';
  echo '<li>Taille du fichier: <font color="DimGray">'.FormatFileSize(filesize($uploadDir . $ffilename)).'</font></li>';
  echo '</ul>';
  echo '<h3>Ent�te du fichier:</h3><ul>';
  echo '<li>Nom: <font color="DimGray">"'.$TIName.'"</font></li>';
  echo '<li>Commentaire: <font color="DimGray">"'.$TIComment.'"</font></li>';
  echo isset($TIStoreType) ? '<li>Stockage: <font color="DimGray">'.$TIStoreType.'</font></li>' : '';
  echo '</ul>';

  echo '<h2>Contenu du fichier</h2>';
  echo '<div style="float: left;"><a href="83c-8xc-file-as-text-file.php"><img src="./images/extensions/txt.png"> Enregistrer en TXT</a></div>';
  echo '<div style="float: left;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="83c-8xc-file-as-text-file.php?noheader=true"><img src="./images/extensions/txt.png"> Enregistrer en TXT sans les informations d\'ent�te</a></div>';
  echo '<div style="float: right;"><a href="./fonts/TI-83PL.TTF"><img src="./images/extensions/font.gif"> T�l�charger une police de TI-8x</a></div>';
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

?>

<?
  include "bottom.php";
?>
