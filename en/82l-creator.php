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
  $listcount = isset($_POST["listcount"]) ? $_POST["listcount"]+0 : 5;
  $listcount = $listcount <= 0 ? 1 : $listcount;

  unset($onti_numbersign);
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

      }

  $_SESSION["onti_filename"]=$onti_filename;
  $_SESSION["onti_comment"]=$onti_comment;
  $_SESSION["listcount"]=$listcount;

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
           <a href="82l-encoder.php?type=82l&date=<? echo gmdate("d-M-Y-H:i:s")?>"><img src="./images/extensions/89l.gif"> Save as 82L</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82l-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Save as TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82l-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Save as TXT without header information</a>
    <?
         }
    ?>
    <form action="82l-creator.php" enctype="multipart/form-data" method="post">
      <h2>File Header</h2>
      <div style="float: right">
        <? $adsensetype="23460"; include "../adsense.php"; ?>
      </div>
      <table>
        <tbody>
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
        </tbody>
      </table>
      <h2>File Content</h2>
        Item Count: <input type="text" name="listcount" value="<? echo $listcount; ?>">
        <br><br>
        <table>
          <?

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