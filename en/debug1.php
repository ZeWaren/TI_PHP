<html>
  <head>
    <link rel="stylesheet" type="TEXT/CSS" href="main.css">
  </head>
  <body>
<?php
  function VireZeroTerminaux($input)
  {
    for ($i=0; $i<strlen($input); $i++)
      if (Ord($input[$i]) == 0)
        {
          $input = substr($input, 0, $i);
          return $input;
          break;
        }
  }

  $filename = "AMPLIOPE.89T";
  $handle = fopen($filename, "rb");
  $contents = '';
  $count=0;
  $contents = fread($handle, 8);
  $TIHeader = '';
  $TIHeader = $contents == '**TI89**' ? "89" : '';
  $TIHeader = $contents == '**TI92**' ? "92" : '';
  $TIHeader = $contents == '**TI92P*' ? "92P" : '';

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
  $TIStoreType = $StoreTypes[$TIStoreTypeN];

  fseek($handle,86);
  $contents = fread($handle, 1);
  $TempBin = ord($contents);
  $contents = fread($handle, 1);
  $TextLength = $TempBin * 256 + ord($contents);

  fseek($handle,90);
  $contents = nl2br(htmlspecialchars(fread($handle, $TextLength-3)));
  $text = $contents;
/*    for ($i=0; $i<strlen($contents); $i++)
      {
        if (ord($contents[$i])==13)
          $text=$text.'<br>';
        else
          $text = $text.$contents[$i];
      }*/
  //DISPLAY      
  $CaltocheName = $TIHeader == "89" ? 'TI-89' : '';
  $CaltocheName = $TIHeader == "92" ? 'TI-92' : '';
  $CaltocheName = $TIHeader == "92P" ? 'TI-92 Plus' : '';
  echo '<h1>File Information</h1>';
  echo '<br><b>File Header:</b><ul>';
  echo '<li>Modèle: '.$CaltocheName.'</li>';
  echo '<li>Folder: "'.$TIFolder.'"</li>';
  echo '<li>Name: "'.$TIName.'"</li>';
  echo '<li>Comment: "'.$TIComment.'"</li>';
  echo '<li>Store Type: '.$TIStoreType.'</li>';
  echo '</ul>';

  echo '<h1>File Content</h1><br>';
  echo '<div style="border: 1px solid black; background-color:#F0F0F0;">'.$text.'</div>';

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
      echo '<td>'.$contents.'</td>';
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
  echo '</tr></table>';
  fclose($handle);
?>

  </body>
</html>  