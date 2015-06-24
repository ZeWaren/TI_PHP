<?
  session_start();
  if (isset($_GET["sc"])) { session_destroy(); session_start(); }
  include "top.php";
?>

<?
 $uploadDir = 'tempuploaded/';
 $ffilename=session_id();
   if ( (!isset($_FILES['userfile'])) || (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadDir . $ffilename)))
     {
       echo '<h2>Ouvrir un fichier</h2>';
       echo '<form enctype="multipart/form-data" action="89i-92i-9xi-v2i--jpg-png-gif-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir une image TI (89i, 92i, 9xi, v2i): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
       echo '</form>';
       echo '<a href="index.php">Retour au menu principal</a>';
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
       echo '<form enctype="multipart/form-data" action="89i-92i-9xi-v2i--jpg-png-gif-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir une image TI (89i, 92i, 9xi, v2i): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
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
  if ($filetype != 'df')
    {
       echo '<font color="red">File Problem - Is a TI File but doesn\'t seem to be a Picture File</font><br>';
       echo $filetype == "e0" ? '<font color="red">Seems to be a Text File.</font><br>' : '';
       echo '<a href="index.php">Retour au menu principal</a>';
       echo '<h2>Ouvrir un fichier</h2>';
       echo '<form enctype="multipart/form-data" action="89i-92i-9xi-v2i--jpg-png-gif-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir une image TI (89i, 92i, 9xi, v2i): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
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

  fseek($handle,88);
  $tempbyte1 = fread($handle, 1);
  $tempbyte2 = fread($handle, 1);
  $height = (ord($tempbyte1) << 8) + ord($tempbyte2);

  $tempbyte1 = fread($handle, 1);
  $tempbyte2 = fread($handle, 1);
  $width = (ord($tempbyte1) << 8) + ord($tempbyte2);
//  widthextension := ifthen((width mod 8) <> 0, width + (8 - (width mod 8)), width);
  $widthextension = $width % 8 <> 0 ? $width +(8- ($width % 8)) : $width;

    for ($i=0; $i<$height * Floor($widthextension/8); $i++)
      {
        $buffer = fread($handle, 1);
        $pixels[$i] = ord($buffer);
//        echo dechex(ord($buffer)).' ';
      }
  $ilength = $height * Floor($widthextension/8);
  $store = array_fill(0, $ilength*8, hexdec("FFFFFF"));
  $index=0;
    for ($i=0; $i<=$ilength - 1; $i++)
      {
        $bitByte = $pixels[$i];
        $k=7;
//        echo '<br>'.decbin($bitByte).': ';
          while ($k >= 0)
            {
//              echo ($bitByte & (1 << $k)).', ';
//              echo '('.decbin(1 << $k).')';
              $store[$index] = ($bitByte & (1 << $k)) != 0 ? hexdec("FF") : 0;
              $index++;
              $k--;
            }
      }
  $img = imagecreate($width, $height);
  $k=0;
  $black = imagecolorallocate($img, 0, 0, 0);
  $white = imagecolorallocate($img, 255, 255, 255);
  for ($i=0; $i < $height; $i++)
    {
       for ($j=0; $j <= $width; $j++)
         {
//            echo $store[$k].' ';
            $color = 255-$store[$k] == 255 ? $white : $black;
//            $color=$white;
            imagesetpixel($img, $j, $i, $color);
            $k++;
         }
       $k += $widthextension-$width-1;  
    }
  imagegif($img, "./pictureconverted/".session_id().'.gif');
  imagedestroy($img);
/*
    k := 0;
    for i := 1 to height do
      begin
        for j := 0 to width do
          begin
            BB.Canvas.Pixels[j,i] := RGB((255-store[k]) and $FF, (255-store[k]) and 255, (255-store[k]) and 255);
            inc(k);
          end;
        k := k + widthextension-width-1;
      end;
*/
  //DISPLAY
  $CaltocheName = "Unknown";
  $CaltocheName = $TIHeader == "89" ? 'TI-89' : $CaltocheName;
  $CaltocheName = $TIHeader == "92" ? 'TI-92' : $CaltocheName;
  $CaltocheName = $TIHeader == "92P" ? 'TI-92 Plus' : $CaltocheName;
  echo '<a href="index.php">Retour au menu principal</a>';
  echo '<h2>Ouvrir un fichier</h2>';
  echo '<form enctype="multipart/form-data" action="89i-92i-9xi-v2i--jpg-png-gif-converter.php" method="post">';
  echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
  echo 'Ouvrir une image TI (89i, 92i, 9xi, v2i): <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
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
  echo '<a href="getpicture.php?type=jpeg"><img src="./images/extensions/jpg.png"> Enregistrer en JPEG</a> &nbsp;&nbsp;';
  echo '<a href="getpicture.php?type=png"><img src="./images/extensions/png.png"> Enregistrer en PNG</a>&nbsp;&nbsp;';
  echo '<a href="getpicture.php?type=gif"><img src="./images/extensions/jpg.png"> Enregistrer en GIF</a><br><br>';
  echo '<div id="ti89content"><div style="padding: 3px;"><img src="./pictureconverted/'.session_id().'.gif?'.date("h-i-s").'"></div></div>';

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