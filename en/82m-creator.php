<?
  session_start();
  include "top.php";
?>

<?
 echo '<a href="index.php">Back to main menu</a>';
 $uploadDir = 'tempuploaded/';
 $filename = $uploadDir.session_id(); 
 $ffilename=session_id();
 $filetext="";
   if ( (!isset($_FILES['userfile'])) || (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadDir . $ffilename)))
     {

     }
   else
     {
       $filetext = file_get_contents($filename);
//       echo $filename;
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

  $oktosave = isset($_POST["submited"]);
  $onti_filename = isset($_POST["onti_filename"]) ? $_POST["onti_filename"] : 'untitled';
  $onti_comment = isset($_POST["onti_comment"]) ? $_POST["onti_comment"] : 'Created on ti.zewaren.net';
  $onti_text = isset($_POST["onti_text"]) ? $_POST["onti_text"] : $filetext;
  $onti_text = $filetext != "" ? $filetext : $onti_text; 
  $onti_storetype = isset($_POST["onti_storetype"]) ? $_POST["onti_storetype"] : 'RAM';
  $onti_calctype = isset($_POST["onti_calctype"]) ? $_POST["onti_calctype"] : '83P';
  $listcount = isset($_POST["listcount"]) ? $_POST["listcount"]+0 : 5;
  $listcount = $listcount <= 0 ? 1 : $listcount;
  $listcount2 = isset($_POST["listcount2"]) ? $_POST["listcount2"]+0 : 5;
  $listcount2 = $listcount <= 0 ? 1 : $listcount2;

  unset($onti_numbersign);
  unset($onti_mantissa);
  unset($onti_expsign);
  unset($onti_exposant);

    for ($j=0; $j<$listcount; $j++)
      {
        for ($i=0; $i<$listcount2; $i++)
          {
            $onti_numbersign[$j][$i] = isset($_POST["onti_numbersign".$i.'_'.$j]) ? $_POST["onti_numbersign".$i.'_'.$j] : 'positive';
            $onti_mantissa[$j][$i] = isset($_POST["onti_mantissa".$i.'_'.$j]) ? $_POST["onti_mantissa".$i.'_'.$j] : '1';
            $onti_expsign[$j][$i] = isset($_POST["onti_expsign".$i.'_'.$j]) ? $_POST["onti_expsign".$i.'_'.$j] : 'positive';
            $onti_exposant[$j][$i] = isset($_POST["onti_exposant".$i.'_'.$j]) ? $_POST["onti_exposant".$i.'_'.$j] : '0';

            $onti_mantissa[$j][$i] += 0;
            $onti_exposant[$j][$i] += 0;
            $onti_exposant[$j][$i] *= $onti_expsign[$j][$i] == "positive" ? 1 : -1;
            $onti_exposant[$j][$i] = $onti_mantissa[$j][$i] == 0 ? 0 : $onti_exposant[$j][$i];
            while ($onti_mantissa[$j][$i] >= 10)
              {
                $onti_mantissa[$j][$i] /= 10;
                $onti_exposant[$j][$i]++;
              }

            if ($onti_mantissa[$j][$i] != 0)
              while ($onti_mantissa[$j][$i] < 1)
                {
                  $onti_mantissa[$j][$i] *= 10;
                  $onti_exposant[$j][$i]--;
                }

          }
      }

  $_SESSION["onti_filename"]=$onti_filename;
  $_SESSION["onti_calctype"]=$onti_calctype;
  $_SESSION["onti_comment"]=$onti_comment;
  $_SESSION["onti_storetype"]=$onti_storetype;
  $_SESSION["listcount"]=$listcount;
  $_SESSION["listcount2"]=$listcount2;  

  $_SESSION["onti_numbersigns"]=$onti_numbersign;
  $_SESSION["onti_mantissas"]=$onti_mantissa;
  $_SESSION["onti_expsigns"]=$onti_expsign;
  $_SESSION["onti_exposants"]=$onti_exposant;

  ?>
    <?
       if ($oktosave)
         {
    ?>
           <h2>Save Last Updated File</h2>
           <a href="82m-encoder.php?type=82m&date=<? echo gmdate("d-M-Y-H:i:s")?>"><img src="./images/extensions/89m.gif"> Save as 82M</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82m-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Save as TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82m-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Save as TXT without header information</a>
    <?
         }
    ?>
    <form action="82m-creator.php" enctype="multipart/form-data" method="post">
      <h2>File Header</h2>
      <table>
        <tbody>
            <tr>
              <td>Variable Name:</td>
              <td>
                <select name="onti_filename">
                  <option value="[A]" <? echo $onti_filename == '[A]' ? 'selected' : '' ?>>[A]</option>
                  <option value="[B]" <? echo $onti_filename == '[B]' ? 'selected' : '' ?>>[B]</option>
                  <option value="[C]" <? echo $onti_filename == '[C]' ? 'selected' : '' ?>>[C]</option>
                  <option value="[D]" <? echo $onti_filename == '[D]' ? 'selected' : '' ?>>[D]</option>
                  <option value="[E]" <? echo $onti_filename == '[E]' ? 'selected' : '' ?>>[E]</option>
                  <option value="[F]" <? echo $onti_filename == '[F]' ? 'selected' : '' ?>>[F]</option>
                  <option value="[G]" <? echo $onti_filename == '[G]' ? 'selected' : '' ?>>[G]</option>
                  <option value="[H]" <? echo $onti_filename == '[H]' ? 'selected' : '' ?>>[H]</option>
                  <option value="[I]" <? echo $onti_filename == '[I]' ? 'selected' : '' ?>>[I]</option>
                  <option value="[J]" <? echo $onti_filename == '[J]' ? 'selected' : '' ?>>[J]</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Comment:</td>
              <td><input type="text" maxlength="40" name="onti_comment" value="<? echo $onti_comment;?>"> <font color="gray">max 40 characters</font></td>
            </tr>
        </tbody>
      </table>
      <h2>File Content</h2>
        Matrix Size: <input type="text" name="listcount" value="<? echo $listcount; ?>"> rows and <input type="text" name="listcount2" value="<? echo $listcount2; ?>"> columns.
        <br><br>
        <table>
          <?
             for ($j=0; $j<$listcount; $j++)
               {
                 echo '<tr><td><h3>Row '.($j+1).'</h3></td></tr>';
                 for ($i=0; $i<$listcount2; $i++)
                   {
                     echo '<tr>';
                     ?>
                      <td>
                        <select name="onti_numbersign<? echo $i.'_'.$j; ?>">
                          <option value="positive" <? echo $onti_numbersign[$j][$i] == 'positive' ? 'selected' : '' ?>>+</option>
                          <option value="negative" <? echo $onti_numbersign[$j][$i] == 'negative' ? 'selected' : '' ?>>-</option>
                        </select>
                        <input type="text" maxlength="15" name="onti_mantissa<? echo $i.'_'.$j; ?>" value="<? echo sprintf("%.14f", $onti_mantissa[$j][$i]) ?>">
                        E
                        <select name="onti_expsign<? echo $i.'_'.$j; ?>">
                          <option value="positive" <? echo $onti_exposant[$j][$i] >= 0 ? 'selected' : '' ?>>+</option>
                          <option value="negative" <? echo $onti_exposant[$j][$i] < 0 ? 'selected' : '' ?>>-</option>
                        </select>
                        <input type="text" maxlength="2" name="onti_exposant<? echo $i.'_'.$j; ?>" value="<? echo abs($onti_exposant[$j][$i]); ?>">
                      </td>
                     <?

                     echo '</tr>';
                   }
               }
          ?>
        </table>
      <br><br>
      <input name="submited" type="submit" value="Update">
    </form>
  <?

?>

<?
  include "bottom.php";
?>