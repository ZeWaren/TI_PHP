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

  $onti_numbersign = isset($_POST["onti_numbersign"]) ? $_POST["onti_numbersign"] : 'positive';
  $onti_mantissa = isset($_POST["onti_mantissa"]) ? $_POST["onti_mantissa"] : '1';
  $onti_expsign = isset($_POST["onti_expsign"]) ? $_POST["onti_expsign"] : 'positive';
  $onti_exposant = isset($_POST["onti_exposant"]) ? $_POST["onti_exposant"] : '0';

  $onti_numbersign2 = isset($_POST["onti_numbersign2"]) ? $_POST["onti_numbersign2"] : 'positive';
  $onti_mantissa2 = isset($_POST["onti_mantissa2"]) ? $_POST["onti_mantissa2"] : '1';
  $onti_expsign2 = isset($_POST["onti_expsign2"]) ? $_POST["onti_expsign2"] : 'positive';
  $onti_exposant2 = isset($_POST["onti_exposant2"]) ? $_POST["onti_exposant2"] : '0';

  $onti_mantissa += 0;
  $onti_exposant += 0;
  $onti_exposant *= $onti_expsign == "positive" ? 1 : -1;
  while ($onti_mantissa >= 10)
    {
      $onti_mantissa /= 10;
      $onti_exposant++;
    }

  while ($onti_mantissa < 1)
    {
      $onti_mantissa *= 10;
      $onti_exposant--;
    }

  $onti_mantissa2 += 0;
  $onti_exposant2 += 0;
  $onti_exposant2 *= $onti_expsign2 == "positive" ? 1 : -1;
  while ($onti_mantissa2 >= 10)
    {
      $onti_mantissa2 /= 10;
      $onti_exposant2++;
    }

  while ($onti_mantissa2 < 1)
    {
      $onti_mantissa2 *= 10;
      $onti_exposant2--;
    }

  $_SESSION["onti_filename"]=$onti_filename;
  $_SESSION["onti_calctype"]=$onti_calctype;
  $_SESSION["onti_comment"]=$onti_comment;
  $_SESSION["onti_storetype"]=$onti_storetype;

  $_SESSION["onti_numbersign"]=$onti_numbersign;
  $_SESSION["onti_mantissa"]=$onti_mantissa;
  $_SESSION["onti_expsign"]=$onti_expsign;
  $_SESSION["onti_exposant"]=$onti_exposant;

  $_SESSION["onti_numbersign2"]=$onti_numbersign2;
  $_SESSION["onti_mantissa2"]=$onti_mantissa2;
  $_SESSION["onti_expsign2"]=$onti_expsign2;
  $_SESSION["onti_exposant2"]=$onti_exposant2;

  ?>
    <?
       if ($oktosave)
         {
    ?>
           <h2>Save Last Updated File</h2>
           <a href="83c-8xc-encoder.php?type=8xc&date=<? echo gmdate("d-M-Y-H:i:s")?>"><img src="./images/extensions/83c.gif"> Save as <? echo $onti_calctype == '83' ? '83C' : '8XC';?></a>
           &nbsp;&nbsp;&nbsp;
           <a href="83c-8xc-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Save as TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="83c-8xc-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Save as TXT without header information</a>
    <?
         }
    ?>
    <form action="83c-8xc-creator.php" enctype="multipart/form-data" method="post">
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
              <td><input type="text" maxlength="8" name="onti_filename" value="<? echo $onti_filename;?>"> <font color="gray">max 8 characters</font></td>
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
        </tbody>
      </table>
      <h2>File Content</h2>
        <table>
          <tr>
            <td>Real part: </td>
            <td>
              <select name="onti_numbersign">
                <option value="positive" <? echo $onti_numbersign == 'positive' ? 'selected' : '' ?>>+</option>
                <option value="negative" <? echo $onti_numbersign == 'negative' ? 'selected' : '' ?>>-</option>
              </select>
              <input type="text" maxlength="15" name="onti_mantissa" value="<? echo sprintf("%.14f", $onti_mantissa) ?>">
              E
              <select name="onti_expsign">
                <option value="positive" <? echo $onti_exposant >= 0 ? 'selected' : '' ?>>+</option>
                <option value="negative" <? echo $onti_exposant < 0 ? 'selected' : '' ?>>-</option>
              </select>
              <input type="text" maxlength="2" name="onti_exposant" value="<? echo abs($onti_exposant); ?>">
            </td>
          </tr>
          <tr>
            <td>Complex part: </td>
            <td>
              <select name="onti_numbersign2">
                <option value="positive" <? echo $onti_numbersign2 == 'positive' ? 'selected' : '' ?>>+</option>
                <option value="negative" <? echo $onti_numbersign2 == 'negative' ? 'selected' : '' ?>>-</option>
              </select>
              <input type="text" maxlength="15" name="onti_mantissa2" value="<? echo sprintf("%.14f", $onti_mantissa2) ?>">
              E
              <select name="onti_expsign2">
                <option value="positive" <? echo $onti_exposant2 >= 0 ? 'selected' : '' ?>>+</option>
                <option value="negative" <? echo $onti_exposant2 < 0 ? 'selected' : '' ?>>-</option>
              </select>
              <input type="text" maxlength="2" name="onti_exposant2" value="<? echo abs($onti_exposant2); ?>"> i
            </td>
          </tr>
        </table>
      <br>
      <input name="submited" type="submit" value="Update">
    </form>
  <?

?>

<?
  include "bottom.php";
?>