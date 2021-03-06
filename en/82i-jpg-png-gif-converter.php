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
       echo '<form enctype="multipart/form-data" action="82i-jpg-png-gif-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI Image File (82i): <input name="userfile" type="file" /> <input type="submit" value="Open">';
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
       echo '<form enctype="multipart/form-data" action="82i-jpg-png-gif-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI Image File (82i): <input name="userfile" type="file" /> <input type="submit" value="Open">';
       echo '</form>';
       include "bottom.php";
       die();
    }

  fseek($handle, 0);
  $contents = fread($handle, 8);

  if ($contents == "**TI82**")
    {
          fseek($handle,59);
          $contents = fread($handle, 1);
          if (ord($contents) != 0x07)
            {
               echo 'File Problem - Doesn\'t seem to be a Picture File<br>';
               echo '<a href="index.php">Back to main menu</a>';
               echo '<h2>Open a file</h2>';
               echo '<form enctype="multipart/form-data" action="82i-jpg-png-gif-converter.php" method="post">';
               echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
               echo 'Open a TI Image File (82i): <input name="userfile" type="file" /> <input type="submit" value="Open">';
               echo '</form>';
               include "bottom.php";
               die();
            }
          fseek($handle,11);
          $contents = fread($handle, 40);
          $TIComment = VireZeroTerminaux($contents);

          fseek($handle,61);
          $contents = fread($handle, 1);
          $TIName = 'Pic'.(ord($contents) == "9" ? 0 : ord($contents)+1);

          $i=0;
          fseek($handle,72);

          $height = 63;
          $width = 96;
          $widthextension = 96;

            for ($i=0; $i<$height * Floor($widthextension/8); $i++)
              {
                $buffer = fread($handle, 1);
                $pixels[$i] = ord($buffer);
              }
          $ilength = $height * Floor($widthextension/8);
          $store = array_fill(0, $ilength*8, hexdec("FFFFFF"));
          $index=0;
            for ($i=0; $i<$ilength; $i++)
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
               for ($j=0; $j < $width; $j++)
                 {
          //            echo $store[$k].' ';
                    $color = 255-$store[$k] == 255 ? $white : $black;
          //            $color=$white;
                    imagesetpixel($img, $j, $i, $color);
                    $k++;
                 }
//               $k += $widthextension-$width-1;  
            }
          imagegif($img, "./pictureconverted/".session_id().'.gif');
          imagedestroy($img);
    }



  $_SESSION["name"] = $TIName;
  $_SESSION["comment"] = $TIComment;
  $_SESSION["storetype"] = isset($TIStoreType) ? $TIStoreType : 'RAM';

  echo '<a href="index.php">Back to main menu</a>';
  echo '<h2>Open a file</h2>';
  echo '<form enctype="multipart/form-data" action="82i-jpg-png-gif-converter.php" method="post">';
  echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
  echo 'Open a TI Image File (82i): <input name="userfile" type="file" /> <input type="submit" value="Open">';
  echo '</form>';
  echo '<h2>File Information</h2>';
  echo '<h3>On Computer:</h3><ul>';
  echo '<li>FileName: <font color="DimGray">"'.$_FILES['userfile']['name'].'"</font></li>';
  echo '<li>File Size: <font color="DimGray">'.FormatFileSize(filesize($uploadDir . $ffilename)).'</font></li>';
  echo '</ul>';
  echo '<h3>File Header:</h3><ul>';
  echo '<li>Name: <font color="DimGray">"'.$TIName.'"</font></li>';
  echo '<li>Comment: <font color="DimGray">"'.$TIComment.'"</font></li>';
  echo isset($TIStoreType) ? '<li>Store Type: <font color="DimGray">'.$TIStoreType.'</font></li>' : '';
  echo '</ul>';

  echo '<h2>File Content</h2>';
  echo '<a href="82i-file-as-image-file.php?type=jpeg"><img src="./images/extensions/jpg.png"> Save as JPEG</a> &nbsp;&nbsp;';
  echo '<a href="82i-file-as-image-file.php?type=png"><img src="./images/extensions/png.png"> Save as PNG</a>&nbsp;&nbsp;';
  echo '<a href="82i-file-as-image-file.php?type=gif"><img src="./images/extensions/jpg.png"> Save as GIF</a><br><br>';
  echo '<div id="ti89content"><div style="padding: 3px;"><img src="./pictureconverted/'.session_id().'.gif?'.date("h-i-s").'"></div></div>';


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
