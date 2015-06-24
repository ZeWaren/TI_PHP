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
  $onti_listformat = isset($_POST["onti_listformat"]) ? $_POST["onti_listformat"] : 'REAL';
  $listcount = isset($_POST["listcount"]) ? $_POST["listcount"]+0 : 5;
  $listcount = $listcount <= 0 ? 1 : $listcount;

  unset($onti_mantissa);
  unset($onti_expsign);
  unset($onti_exposant);

    for ($i=0; $i<$listcount; $i++)
      {
        $onti_numbersign[$i] = isset($_POST["onti_numbersign".$i]) ? $_POST["onti_numbersign".$i] : 'positive';
        $onti_mantissa[$i] = isset($_POST["onti_mantissa".$i]) ? $_POST["onti_mantissa".$i] : '1';
        $onti_expsign[$i] = isset($_POST["onti_expsign".$i]) ? $_POST["onti_expsign".$i] : 'positive';
        $onti_exposant[$i] = isset($_POST["onti_exposant".$i]) ? $_POST["onti_exposant".$i] : '0';

        $onti_mantissa[$i] += 0;
        $onti_exposant[$i] += 0;
        $onti_exposant[$i] *= $onti_expsign[$i] == "positive" ? 1 : -1;
        $onti_exposant[$i] = $onti_mantissa[$i] == 0 ? 0 : $onti_exposant[$i];
        while ($onti_mantissa[$i] >= 10)
          {
            $onti_mantissa[$i] /= 10;
            $onti_exposant[$i]++;
          }

        if ($onti_mantissa[$i] != 0)
          while ($onti_mantissa[$i] < 1)
            {
              $onti_mantissa[$i] *= 10;
              $onti_exposant[$i]--;
            }

        if ($onti_listformat == "COMPLEX")
          {
            $onti_numbersign_c[$i] = isset($_POST["onti_numbersign_c".$i]) ? $_POST["onti_numbersign_c".$i] : 'positive';
            $onti_mantissa_c[$i] = isset($_POST["onti_mantissa_c".$i]) ? $_POST["onti_mantissa_c".$i] : '1';
            $onti_expsign_c[$i] = isset($_POST["onti_expsign_c".$i]) ? $_POST["onti_expsign_c".$i] : 'positive';
            $onti_exposant_c[$i] = isset($_POST["onti_exposant_c".$i]) ? $_POST["onti_exposant_c".$i] : '0';

            $onti_mantissa_c[$i] += 0;
            $onti_exposant_c[$i] += 0;
            $onti_exposant_c[$i] *= $onti_expsign_c[$i] == "positive" ? 1 : -1;
            $onti_exposant_c[$i] = $onti_mantissa_c[$i] == 0 ? 0 : $onti_exposant_c[$i];
            while ($onti_mantissa_c[$i] >= 10)
              {
                $onti_mantissa_c[$i] /= 10;
                $onti_exposant_c[$i]++;
              }

            if ($onti_mantissa_c[$i] != 0)
              while ($onti_mantissa_c[$i] < 1)
                {
                  $onti_mantissa_c[$i] *= 10;
                  $onti_exposant_c[$i]--;
                }
          }
      }

  $onti_numbersign_c = isset($onti_numbersign_c) ? $onti_numbersign_c : null;
  $onti_mantissa_c = isset($onti_mantissa_c) ? $onti_mantissa_c : null;
  $onti_expsign_c = isset($onti_expsign_c) ? $onti_expsign_c : null;
  $onti_exposant_c = isset($onti_exposant_c) ? $onti_exposant_c : null;

  $_SESSION["onti_filename"]=$onti_filename;
  $_SESSION["onti_calctype"]=$onti_calctype;
  $_SESSION["onti_comment"]=$onti_comment;
  $_SESSION["onti_storetype"]=$onti_storetype;
  $_SESSION["listcount"]=$listcount;

  $_SESSION["onti_numbersigns"]=$onti_numbersign;
  $_SESSION["onti_mantissas"]=$onti_mantissa;
  $_SESSION["onti_expsigns"]=$onti_expsign;
  $_SESSION["onti_exposants"]=$onti_exposant;

  $_SESSION["listformat"]=$onti_listformat;
  
  $_SESSION["onti_numbersigns_c"]=$onti_numbersign_c;
  $_SESSION["onti_mantissas_c"]=$onti_mantissa_c;
  $_SESSION["onti_expsigns_c"]=$onti_expsign_c;
  $_SESSION["onti_exposants_c"]=$onti_exposant_c;

  ?>
    <?
       if ($oktosave)
         {
    ?>
           <h2>Save Last Updated File</h2>
           <a href="83l-8xl-encoder.php?type=8xl&date=<? echo gmdate("d-M-Y-H:i:s")?>"><img src="./images/extensions/89l.gif"> Save as <? echo $onti_calctype == '83' ? '83L' : '8XL';?></a>
           &nbsp;&nbsp;&nbsp;
           <a href="83l-8xl-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Save as TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="83l-8xl-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Save as TXT without header information</a>
    <?
         }
    ?>
    <form action="83l-8xl-creator.php" enctype="multipart/form-data" method="post">
      <h2>File Header</h2>
      <table>
        <tbody>
            <tr>
              <td>Calculator Type</td>
              <td>
                <select name="onti_calctype">
                  <option value="83" <? echo $onti_calctype == '83' ? 'selected' : '' ?>>TI-83 Family</option>
                  <option value="83P" <? echo $onti_calctype == '83P' ? 'selected' : '' ?>>TI-83 Plus / TI-84 Plus Family</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Variable Name:</td>
              <td>
                <select name="onti_filename">
                  <option value="L1" <? echo $onti_filename == 'L1' ? 'selected' : '' ?>>L1</option>
                  <option value="L2" <? echo $onti_filename == 'L2' ? 'selected' : '' ?>>L2</option>
                  <option value="L3" <? echo $onti_filename == 'L3' ? 'selected' : '' ?>>L3</option>
                  <option value="L4" <? echo $onti_filename == 'L4' ? 'selected' : '' ?>>L4</option>
                  <option value="L5" <? echo $onti_filename == 'L5' ? 'selected' : '' ?>>L5</option>
                  <option value="L6" <? echo $onti_filename == 'L6' ? 'selected' : '' ?>>L6</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Comment:</td>
              <td><input type="text" maxlength="40" name="onti_comment" value="<? echo $onti_comment;?>"> <font color="gray">max 40 characters</font></td>
            </tr>
            <tr>
              <td>Store Type</td>
              <td>
                <input type="radio" name="onti_storetype" value="RAM" <? echo $onti_storetype == "RAM" ? 'checked' : '' ?>>RAM
                <input type="radio" name="onti_storetype" value="ARCHIVE" <? echo $onti_storetype == "ARCHIVE" ? 'checked' : '' ?>> Archive
                <i>(does not apply to the TI-83 Family)</i>
              </td>
            </tr>
            <tr>
              <td>List Format</td>
              <td>
                <input type="radio" name="onti_listformat" value="REAL" <? echo $onti_listformat == "REAL" ? 'checked' : '' ?>>Real
                <input type="radio" name="onti_listformat" value="COMPLEX" <? echo $onti_listformat == "COMPLEX" ? 'checked' : '' ?>> Complex
              </td>
            </tr>
        </tbody>
      </table>
      <h2>File Content</h2>
        Item Count: <input type="text" name="listcount" value="<? echo $listcount; ?>">
        <br><br>
        <table>
          <?
             if ($onti_listformat == "COMPLEX")
               echo '<td><b>Real Part</b></td><td></td><td><b>Complex Part</b></td>';

             for ($i=0; $i<$listcount; $i++)
               {
                 echo '<tr>';
                 ?>
                  <td>
                    <select name="onti_numbersign<? echo $i; ?>">
                      <option value="positive" <? echo $onti_numbersign[$i] == 'positive' ? 'selected' : '' ?>>+</option>
                      <option value="negative" <? echo $onti_numbersign[$i] == 'negative' ? 'selected' : '' ?>>-</option>
                    </select>
                    <input type="text" maxlength="15" name="onti_mantissa<? echo $i; ?>" value="<? echo sprintf("%.14f", $onti_mantissa[$i]) ?>">
                    E
                    <select name="onti_expsign<? echo $i; ?>">
                      <option value="positive" <? echo $onti_exposant[$i] >= 0 ? 'selected' : '' ?>>+</option>
                      <option value="negative" <? echo $onti_exposant[$i] < 0 ? 'selected' : '' ?>>-</option>
                    </select>
                    <input type="text" maxlength="2" name="onti_exposant<? echo $i; ?>" value="<? echo abs($onti_exposant[$i]); ?>">
                  </td>
                 <?

                 if ($onti_listformat == "COMPLEX")
                   {
                       ?>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>
                          <select name="onti_numbersign_c<? echo $i; ?>">
                            <option value="positive" <? echo $onti_numbersign_c[$i] == 'positive' ? 'selected' : '' ?>>+</option>
                            <option value="negative" <? echo $onti_numbersign_c[$i] == 'negative' ? 'selected' : '' ?>>-</option>
                          </select>
                          <input type="text" maxlength="15" name="onti_mantissa_c<? echo $i; ?>" value="<? echo sprintf("%.14f", $onti_mantissa_c[$i]) ?>">
                          E
                          <select name="onti_expsign_c<? echo $i; ?>">
                            <option value="positive" <? echo $onti_exposant_c[$i] >= 0 ? 'selected' : '' ?>>+</option>
                            <option value="negative" <? echo $onti_exposant_c[$i] < 0 ? 'selected' : '' ?>>-</option>
                          </select>
                          <input type="text" maxlength="2" name="onti_exposant_c<? echo $i; ?>" value="<? echo abs($onti_exposant_c[$i]); ?>"> i
                        </tr>
                       <?
                   }
                 echo '</tr>';
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