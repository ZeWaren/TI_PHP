<?
  session_start();
  include "top.php";
?>

<?
 $uploadDir = 'tempuploaded/';
 $ffilename=session_id();
   if ( (!isset($_FILES['userfile'])) || (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadDir . $ffilename)))
     {
       echo 'File Problem<br>';
       echo '<a href="index.php">Back to main menu</a>';
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
       echo '<a href="index.php">Back to main menu</a>';
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
  if ($filetype != 'e0')
    {
       echo '<font color="red">File Problem - Is a TI File but doesn\'t seem to be a Text File</font><br>';
       echo $filetype == 'df' ? '<font color="red">Seems to be a Picture File</font><br>' : '';
       echo '<a href="index.php">Back to main menu</a>';
  $CaltocheName = "Unknown";
  $CaltocheName = $TIHeader == "89" ? 'TI-89' : $CaltocheName;
  $CaltocheName = $TIHeader == "92" ? 'TI-92' : $CaltocheName;
  $CaltocheName = $TIHeader == "92P" ? 'TI-92 Plus' : $CaltocheName;
  echo '<h2>File Information</h2>';
  echo '<h3>On Computer:</h3><ul>';
  echo '<li>FileName: <font color="DimGray">"'.$_FILES['userfile']['name'].'"</font></li>';
  echo '<li>File Size: <font color="DimGray">'.FormatFileSize(filesize($uploadDir . $ffilename)).'</font></li>';
  echo '</ul>';
  echo '<h3>File Header:</h3><ul>';
  echo '<li>Calculator Type: <font color="DimGray">'.$CaltocheName.'</font></li>';
  echo '<li>Folder: <font color="DimGray">"'.$TIFolder.'"</font></li>';
  echo '<li>Name: <font color="DimGray">"'.$TIName.'"</font></li>';
  echo '<li>Comment: <font color="DimGray">"'.$TIComment.'"</font></li>';
  echo '<li>Store Type: <font color="DimGray">'.$TIStoreType.'</font></li>';
  echo '</ul>';
       include "bottom.php";
       die();
    }

  fseek($handle,86);
  $contents = fread($handle, 1);
  $TempBin = ord($contents);
  $contents = fread($handle, 1);
  $TextLength = $TempBin * 256 + ord($contents);

  fseek($handle,90);
  $contents= fread($handle, $TextLength-3);
  $fhandlewrite=fopen('./txtconverted/'.$ffilename.'.txt', 'w');
    for ($i=0; $i<strlen($contents); $i++)
      {
        if (ord($contents[$i])==13)
          fwrite($fhandlewrite, chr(13).chr(10));
        else if (($i >= 1) && !(ord($contents[$i-1])==13))
          fwrite($fhandlewrite, $contents[$i]);
      }
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
  $sharp_tofind = array ("#1", "#2", "#3", "#U", '#E', '#V', "#W", "#I", "#N", "#S");
  $sharp_toreplace = array ('<font color="gray">#1</font>', '<font color="gray">#2</font>', '<font color="gray">#3</font>', '<font color="gray">#U</font>', '<font color="gray">#E</font>', '<font color="gray">#V</font>', '<font color="gray">#W</font>', '<font color="gray">#I</font>', '<font color="gray">#N</font>', '<font color="gray">#S</font>');
  $contents = str_replace($sharp_tofind, $sharp_toreplace, $contents);
  $amp_tofind = array ("&amp;C", "&amp;=", "&amp;-", "&amp;L", '&amp;R', '&amp;,', '&amp;;', '&amp;.', '&amp;E', '&amp;P');
  $amp_toreplace = array ('<font color="RoyalBlue">&amp;C</font>', '<font color="RoyalBlue">&amp;=</font>', '<font color="RoyalBlue">&amp;-</font>', '<font color="RoyalBlue">&amp;L</font>', '<font color="RoyalBlue">&amp;R</font>', '<font color="RoyalBlue">&amp;,</font>', '<font color="RoyalBlue">&amp;;</font>', '<font color="RoyalBlue">&amp;.</font>', '<font color="RoyalBlue">&amp;E</font>', '<font color="RoyalBlue">&amp;P</font>');
  $contents = str_replace($amp_tofind, $amp_toreplace, $contents);
  $text = $contents;
  //DISPLAY
  $CaltocheName = "Unknown";
  $CaltocheName = $TIHeader == "89" ? 'TI-89' : $CaltocheName;
  $CaltocheName = $TIHeader == "92" ? 'TI-92' : $CaltocheName;
  $CaltocheName = $TIHeader == "92P" ? 'TI-92 Plus' : $CaltocheName;
  echo '<a href="index.php">Back to main menu</a>';
  echo '<h2>File Information</h2>';
  echo '<h3>On Computer:</h3><ul>';
  echo '<li>FileName: <font color="DimGray">"'.$_FILES['userfile']['name'].'"</font></li>';
  echo '<li>File Size: <font color="DimGray">'.FormatFileSize(filesize($uploadDir . $ffilename)).'</font></li>';
  echo '</ul>';
  echo '<h3>File Header:</h3><ul>';
  echo '<li>Calculator Type: <font color="DimGray">'.$CaltocheName.'</font></li>';
  echo '<li>Folder: <font color="DimGray">"'.$TIFolder.'"</font></li>';
  echo '<li>Name: <font color="DimGray">"'.$TIName.'"</font></li>';
  echo '<li>Comment: <font color="DimGray">"'.$TIComment.'"</font></li>';
  echo '<li>Store Type: <font color="DimGray">'.$TIStoreType.'</font></li>';
  echo '</ul>';

  echo '<h2>File Content</h2>';
  echo '<div style="float: left;"><a href="gettxt.php"><img src="./images/extensions/txt.png"> Save as TXT</a> &nbsp;&nbsp; <a href="gettxt.php?removetags=1"><img src="./images/extensions/txt.png"> Save as TXT without any "&amp;" or "&" tags</a></div>';
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