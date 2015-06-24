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
       echo '<h2>Open a file</h2>';
       echo '<form enctype="multipart/form-data" action="89t-92t-9xt-v2t--html-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI Text File (89t, 92t, 9xt, v2t): <input name="userfile" type="file" /> <input type="submit" value="Open">';
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
       echo '<h2>Open a file</h2>';
       echo '<form enctype="multipart/form-data" action="89t-92t-9xt-v2t--html-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI Text File (89t, 92t, 9xt, v2t): <input name="userfile" type="file" /> <input type="submit" value="Open">';
       echo '</form>';
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
       echo '<h2>Open a file</h2>';
       echo '<form enctype="multipart/form-data" action="89t-92t-9xt-v2t--html-converter.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Open a TI Text File (89t, 92t, 9xt, v2t): <input name="userfile" type="file" /> <input type="submit" value="Open">';
       echo '</form>';
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

  $text = '';
    for ($i=0; $i<strlen($contents); $i++)
      {
        if (($i > 1) && (ord($contents[$i-1])==13))
          $text=$text.'';
        else
          $text = $text.$contents[$i];
      }
  $contents=$text;
/*  $contents = nl2br(htmlentities($contents));
  $contents= str_replace('  ', '&nbsp;&nbsp;', $contents);
  $contents= str_replace('&nbsp; ', '&nbsp;&nbsp;', $contents);
  $sharp_tofind = array ("#1", "#2", "#3", "#U", '#E', '#V', "#W", "#I", "#N", "#S");
  $sharp_toreplace = array ('<font color="gray">#1</font>', '<font color="gray">#2</font>', '<font color="gray">#3</font>', '<font color="gray">#U</font>', '<font color="gray">#E</font>', '<font color="gray">#V</font>', '<font color="gray">#W</font>', '<font color="gray">#I</font>', '<font color="gray">#N</font>', '<font color="gray">#S</font>');
  $contents = str_replace($sharp_tofind, $sharp_toreplace, $contents);
  $amp_tofind = array ("&amp;C", "&amp;=", "&amp;-", "&amp;L", '&amp;R', '&amp;,', '&amp;;', '&amp;.', '&amp;E', '&amp;P');
  $amp_toreplace = array ('<font color="RoyalBlue">&amp;C</font>', '<font color="RoyalBlue">&amp;=</font>', '<font color="RoyalBlue">&amp;-</font>', '<font color="RoyalBlue">&amp;L</font>', '<font color="RoyalBlue">&amp;R</font>', '<font color="RoyalBlue">&amp;,</font>', '<font color="RoyalBlue">&amp;;</font>', '<font color="RoyalBlue">&amp;.</font>', '<font color="RoyalBlue">&amp;E</font>', '<font color="RoyalBlue">&amp;P</font>');
  $contents = str_replace($amp_tofind, $amp_toreplace, $contents);*/
  $contents='<font><div style="text-align: left;">'.nl2br(htmlspecialchars($contents));
  $contents=str_replace('&amp;', '&', $contents);
  $text = '';
  $in_underline = false;
  $half_underline=false;
  $half_bascule=false;
  $in_formula=false;
  $in_picture = false;
  $in_subscript=false;
  $in_vector=false;
  $in_inverted=false;
  $in_strike=false;
    for ($i=0; $i<strlen($contents)-1; $i++)
      {
        if (($i < strlen($contents) - 5) && $contents[$i]=="<" && $contents[$i+1]=="b" && $contents[$i+2]=="r" && $contents[$i+3]==" " && $contents[$i+4]=="/" && $contents[$i+5]==">")
          {
            $text .= '<br />';
            $i+=5;
            continue;
          }
        if ($half_underline && !$in_underline)
          {
            $text .= $half_bascule ? '<u>' : '</u>';
            $half_bascule=!$half_bascule;
          }
        //
        if ($contents[$i+1]=="U" && $contents[$i]=="#")
          {
            $text .= $in_underline ? '</u>' : '<u>';
            $i++;
            $in_underline=!$in_underline;
          }
        else if ($contents[$i+1]=="I" && $contents[$i]=="#")
          {
            $text .= $in_inverted ? '</font>' : '<font style="background-color: black;" color="white">';
            $i++;
            $in_inverted=!$in_inverted;
          }
        else if ($contents[$i+1]=="S" && $contents[$i]=="#")
          {
            $text .= $in_strike ? '</strike>' : '<strike>';
            $i++;
            $in_strike=!$in_strike;
          }
        else if ($contents[$i+1]=="E" && $contents[$i]=="#")
          {
            $text .= $in_subscript ? '</sup>' : '<sup>';
            $i++;
            $in_subscript=!$in_subscript;
          }
        else if ($contents[$i+1]=="V" && $contents[$i]=="#")
          {
            $text .= $in_vector ? '</font>' : '<font color="#663300">';
            $i++;
            $in_vector=!$in_vector;
          }
        else if ($contents[$i+1]=="N" && $contents[$i]=="#")
          {
            $half_underline=!$half_underline;
            if (!$half_bascule && !$half_underline)
              $text .= '</u>';
//            $half_bascule=$half_underline;
            $i++;
          }
        else if ($contents[$i+1]=="W" && $contents[$i]=="#")
          {
            $i++;
          }
        else if ($contents[$i+1]=="E" && $contents[$i]=="&")
          {
            $text .= '<font color="darkblue">';
            $in_formula=true;
            $i++;
          }
        else if ($contents[$i+1]=="P" && $contents[$i]=="&")
          {
            $text .= '<font color="darkgreen">';
            $in_picture=true;
            $i++;
          }
        else if ($contents[$i+1]=="C" && $contents[$i]=="&")
          {
            $text .= '</div><div style="text-align: center;">';
            $i++;
          }
        else if ($contents[$i+1]=="R" && $contents[$i]=="&")
          {
            $text .= '</div><div style="text-align: right;">';
            $i++;
          }
        else if ($contents[$i+1]=="L" && $contents[$i]=="&")
          {
            $text .= '</div><div style="text-align: left;">';
            $i++;
          }
        else if ($contents[$i+1]=="-" && $contents[$i]=="&")
          {
            $text .= '<hr>';
            $i+=7;            
          }
        else if ($contents[$i+1]=="1" && $contents[$i]=="#")
          {
            $text .= '</font><font>';
            $i+=1;
          }
        else if ($contents[$i+1]=="2" && $contents[$i]=="#")
          {
            $text .= '</font><font style="font-size: 130%">';
            $i+=1;
          }
        else if ($contents[$i+1]=="3" && $contents[$i]=="#")
          {
            $text .= '</font><font style="font-size: 150%">';
            $i+=1;
          }
        else if ($contents[$i+1]=="=" && $contents[$i]=="&")
          {
            $text .= '<hr><hr>';
            $i+=7;
          }
        else
          $text .= $contents[$i];
        if (ord($contents[$i])==13 && ($in_formula || $in_picture))
          {
            $text .= '</font>';
            $in_formula = false;
            $in_picture = false;
          }
      }
    if ($half_underline && $half_bascule)
      $text .= '</u>';
    $text .= '</div></font>';
//  $contents = nl2br(htmlentities($text));
  $contents= str_replace('  ', '&nbsp;&nbsp;', $text);
  $contents= str_replace('&nbsp; ', '&nbsp;&nbsp;', $contents);
  $text = $contents;

  $fhandlewrite=fopen('./htmlconverted/'.$ffilename.'.html', 'w');

  fwrite($fhandlewrite, '<html><head><style type="text/css">/*<![CDATA[*/ hr { height: 1px; color: #aaa; background-color: #aaa; border: 0; margin: .2em 0 .2em 0; } #zwcontent {font: x-small sans-serif; border: 1px solid black; background-color:#F0F0F0; font-family:Ti92Pluspc; overflow:auto }/*]]>*/</style><!--[if gte IE 6]><style type="text/css">#zwcontent { font: xx-small sans-serif; }</style><![endif]--></head><body><div id="zwcontent"><div style="font-size: 127%; padding: 3px;">'.$contents[0]);

//  fwrite($fhandlewrite, $contents[0]);
    for ($i=1; $i<strlen($contents); $i++)
      {
//        if (ord($contents[$i])==13)
//          fwrite($fhandlewrite, chr(13).chr(10));
//        if (($i >= 1) && !(ord($contents[$i-1])==13))
          fwrite($fhandlewrite, $contents[$i]);
      }
  fwrite($fhandlewrite, '</div></div></body></html>');
  fclose($fhandlewrite);

  //DISPLAY
  $CaltocheName = "Unknown";
  $CaltocheName = $TIHeader == "89" ? 'TI-89' : $CaltocheName;
  $CaltocheName = $TIHeader == "92" ? 'TI-92' : $CaltocheName;
  $CaltocheName = $TIHeader == "92P" ? 'TI-92 Plus' : $CaltocheName;
  echo '<a href="index.php">Back to main menu</a>';
  echo '<h2>Open a file</h2>';
  echo '<form enctype="multipart/form-data" action="89t-92t-9xt-v2t--html-converter.php" method="post">';
  echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
  echo 'Open a TI Text File (89t, 92t, 9xt, v2t): <input name="userfile" type="file" /> <input type="submit" value="Open">';
  echo '</form>';
  echo '<h2>File Information</h2>';
  echo '<div style="float: left;">';
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
  echo '</ul></div>';

  echo '<br clear="all"><h2>File Content</h2>';
  echo '<div style="float: left">';
  echo '<a href="./htmlconverted/'.$ffilename.'.html"><img src="./images/extensions/html.png"> Save as HTML</a>';
  echo '<br><br>';
  ?>
    </div>
    <div style="float: right;">
      <div style="padding: 3px;">
        <font color="#663300">Vectors (#V)</font><br>
        <font color="darkgreen">Pictures (&P)</font><br>
        <font color="darkblue">Formulas (&E)</font><br>
      </div>
    </div><br clear="all">
  <?  
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
  echo '<br><a href="index.php">Back to main menu</a>';
?>

<?
  include "bottom.php";
?>