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
       echo '<form enctype="multipart/form-data" action="89s-92s-9xs-v2s--txt-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir une chaîne TI (89t, 92t, 9xt, v2t): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
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
  $contents = '';
  $count=0;
  $contents = fread($handle, 8);
  $TIHeader = '';
  $TIHeader = $contents == '**TI89**' ? "89" : $TIHeader;
  $TIHeader = $contents == '**TI92**' ? "92" : $TIHeader;
  $TIHeader = $contents == '**TI92P*' ? "92P" : $TIHeader;
  if ($TIHeader == '')
    {
       echo 'File Problem - Doesn\'t seem to be a TI89/92 Text File<br>';
       echo '<a href="index.php">Retour au menu principal</a>';
       echo '<h2>Ouvrir un fichier</h2>';
       echo '<form enctype="multipart/form-data" action="89s-92s-9xs-v2s--txt-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI String File (89s, 92s, 9xs, v2s): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
       echo '</form>';
       include "bottom.php";
       die();
    }

  fseek($handle,10);
  $contents = fread($handle, 8);
  $TIFolder = VireZeroTerminaux($contents);

  fseek($handle,18);
  $contents = fread($handle, 40);
  $TIComment = VireZeroTerminaux($contents);

  fseek($handle,64);
  $contents = fread($handle, 8);
  $TIName = VireZeroTerminaux($contents);

  fseek($handle,73);
  $contents = fread($handle, 1);
  $TIStoreTypeN = ord($contents);
  $StoreTypes = array ("RAM", 'RAM Locked', 'Archive');
  $TIStoreType = $TIStoreTypeN < 3 ? $StoreTypes[$TIStoreTypeN] : 'Archive';

  fseek($handle,-3, SEEK_END);
  $filetype=dechex(ord(fread($handle, 1)));
  if ($filetype != '2d')
    {
       echo '<font color="red">File Problem - Is a TI File but doesn\'t seem to be a String File</font><br>';
       echo $filetype == 'df' ? '<font color="red">Seems to be a Picture File</font><br>' : '';
       echo '<a href="index.php">Retour au menu principal</a>';
       echo '<h2>Ouvrir un fichier</h2>';
       echo '<form enctype="multipart/form-data" action="89s-92s-9xs-v2s--txt-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI String File (89s, 92s, 9xs, v2s): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
       echo '</form>';       
        $CaltocheName = "Unknown";
        $CaltocheName = $TIHeader == "89" ? 'TI-89' : $CaltocheName;
        $CaltocheName = $TIHeader == "92" ? 'TI-92' : $CaltocheName;
        $CaltocheName = $TIHeader == "92P" ? 'TI-92 Plus' : $CaltocheName;
        echo '<h2>Information sur le fichier</h2>';
        echo '<h3>Fichier ordinateur</h3><ul>';
        echo '<li>Nom du fichier: <font color="DimGray">"'.$_FILES['userfile']['name'].'"</font></li>';
        echo '<li>Taille du fichier: <font color="DimGray">'.FormatFileSize(filesize($uploadDir . $ffilename)).'</font></li>';
        echo '</ul>';
        echo '<h3>Entête du fichier:</h3><ul>';
        echo '<li>Modèle de calculette:: <font color="DimGray">'.$CaltocheName.'</font></li>';
        echo '<li>Dossier: <font color="DimGray">"'.$TIFolder.'"</font></li>';
        echo '<li>Nom: <font color="DimGray">"'.$TIName.'"</font></li>';
        echo '<li>Commentaire: <font color="DimGray">"'.$TIComment.'"</font></li>';
        echo '<li>Stockage: <font color="DimGray">'.$TIStoreType.'</font></li>';
        echo '</ul>';
       include "bottom.php";
       die();
    }

  fseek($handle,86);
  $contents = fread($handle, 1);
  $TempBin = ord($contents);
  $contents = fread($handle, 1);
  $TextLength = $TempBin * 256 + ord($contents);

  fseek($handle,89);
  $contents= fread($handle, $TextLength-3);
  $fhandlewrite=fopen('./txtconverted/'.$ffilename.'.txt', 'w');
/*    for ($i=0; $i<strlen($contents); $i++)
      {
        if (ord($contents[$i])==13)
          fwrite($fhandlewrite, chr(13).chr(10));
        else if (($i >= 1) && !(ord($contents[$i-1])==13))
          fwrite($fhandlewrite, $contents[$i]);
      }*/
  fclose($fhandlewrite);

  $text = '';
    for ($i=0; $i<strlen($contents); $i++)
      {
        if (($i > 1) && (ord($contents[$i-1])==13))
          $text=$text.'';
        else
          $text = $text.$contents[$i];
      }
  $contents=$text;
  $contents = nl2br(htmlentities($contents));
  $contents= str_replace('  ', '&nbsp;&nbsp;', $contents);
  $contents= str_replace('&nbsp; ', '&nbsp;&nbsp;', $contents);
  $text = $contents;

  $CaltocheName = "Unknown";
  $CaltocheName = $TIHeader == "89" ? 'TI-89' : $CaltocheName;
  $CaltocheName = $TIHeader == "92" ? 'TI-92' : $CaltocheName;
  $CaltocheName = $TIHeader == "92P" ? 'TI-92 Plus' : $CaltocheName;

  $_SESSION["onti_folder"] = $TIFolder;
  $_SESSION["onti_calctype"] = $CaltocheName;
  $_SESSION["onti_filename"] = $TIName;
  $_SESSION["onti_comment"] = $TIComment;
  $_SESSION["onti_storetype"] = $TIStoreType;
  $_SESSION["onti_text"] = $text;

  //DISPLAY
  echo '<a href="index.php">Retour au menu principal</a>';
  echo '<h2>Ouvrir un fichier</h2>';
  echo '<form enctype="multipart/form-data" action="89s-92s-9xs-v2s--txt-converter.php" method="post">';
  echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
  echo 'Open a TI String File (89s, 92s, 9xs, v2s): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
  echo '</form>';
  echo '<h2>Information sur le fichier</h2>';
  echo '<h3>Fichier ordinateur</h3><ul>';
  echo '<li>Nom du fichier: <font color="DimGray">"'.$_FILES['userfile']['name'].'"</font></li>';
  echo '<li>Taille du fichier: <font color="DimGray">'.FormatFileSize(filesize($uploadDir . $ffilename)).'</font></li>';
  echo '</ul>';
  echo '<h3>Entête du fichier:</h3><ul>';
  echo '<li>Modèle de calculette:: <font color="DimGray">'.$CaltocheName.'</font></li>';
  echo '<li>Dossier: <font color="DimGray">"'.$TIFolder.'"</font></li>';
  echo '<li>Nom: <font color="DimGray">"'.$TIName.'"</font></li>';
  echo '<li>Commentaire: <font color="DimGray">"'.$TIComment.'"</font></li>';
  echo '<li>Stockage: <font color="DimGray">'.$TIStoreType.'</font></li>';
  echo '</ul>';

  echo '<h2>Contenu du fichier</h2>';
  echo '<div style="float: left;"><a href="string-file-as-text-file.php?date='.gmdate("D, d-M-Y-H-i-s").'&addheader=true"><img src="./images/extensions/txt.png"> Enregistrer en TXT</a> &nbsp;&nbsp; <a href="string-file-as-text-file.php?date='.gmdate("D, d-M-Y-H-i-s").'&addheader=false"><img src="./images/extensions/txt.png"> Enregistrer en TXT sans les informations d\'entête</a></div>';
  echo '<div style="float: right;"><a href="./fonts/TI-92p.TTF"><img src="./images/extensions/font.gif"> Download a TI89/92 Font</a></div>';
  echo '<br><br>';
  echo '<div id="ti89content"><div style="padding: 3px;">'.$text.'</div></div>';

  //TABLE HEXA
/*  echo '<h1>File Hexa</h1><br>';
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