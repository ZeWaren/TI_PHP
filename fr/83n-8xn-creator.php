<?
  session_start();
  include "top.php";
?>

<?
 echo '<a href="index.php">Retour au menu principal</a>';
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
  $onti_comment = isset($_POST["onti_comment"]) ? $_POST["onti_comment"] : 'Encod� par ti.zewaren.net';
  $onti_text = isset($_POST["onti_text"]) ? $_POST["onti_text"] : $filetext;
  $onti_text = $filetext != "" ? $filetext : $onti_text; 
  $onti_storetype = isset($_POST["onti_storetype"]) ? $_POST["onti_storetype"] : 'RAM';
  $onti_calctype = isset($_POST["onti_calctype"]) ? $_POST["onti_calctype"] : '83P';
  $onti_numbersign = isset($_POST["onti_numbersign"]) ? $_POST["onti_numbersign"] : 'positive';
  $onti_mantissa = isset($_POST["onti_mantissa"]) ? $_POST["onti_mantissa"] : '1';
  $onti_expsign = isset($_POST["onti_expsign"]) ? $_POST["onti_expsign"] : 'positive';
  $onti_exposant = isset($_POST["onti_exposant"]) ? $_POST["onti_exposant"] : '0';

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

  $_SESSION["onti_filename"]=$onti_filename;
  $_SESSION["onti_calctype"]=$onti_calctype;
  $_SESSION["onti_comment"]=$onti_comment;
  $_SESSION["onti_numbersign"]=$onti_numbersign;
  $_SESSION["onti_mantissa"]=$onti_mantissa;
  $_SESSION["onti_expsign"]=$onti_expsign;
  $_SESSION["onti_exposant"]=$onti_exposant;      
  $_SESSION["onti_storetype"]=$onti_storetype;

  ?>
    <?
       if ($oktosave)
         {
    ?>
           <h2>Enregistrer le dernier fichier envoy�</h2>
           <a href="83n-8xn-encoder.php?type=8xn&date=<? echo gmdate("d-M-Y-H:i:s")?>"><img src="./images/extensions/83c.gif"> Enregistrer en <? echo $onti_calctype == '83' ? '83N' : '8XN';?></a>
           &nbsp;&nbsp;&nbsp;
           <a href="83n-8xn-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Enregistrer en TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="83n-8xn-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Enregistrer en TXT sans les informations d'ent�te</a>
    <?
         }
    ?>
    <form action="83n-8xn-creator.php" enctype="multipart/form-data" method="post">
      <h2>Ent�te du fichier</h2>
      <table>
        <tbody>
            <tr>
              <td>Mod�le de calculette:</td>
              <td>
                <select name="onti_calctype">
                  <option value="83" <? echo $onti_calctype == '83' ? 'selected' : '' ?>>TI-83 Family</option>
                  <option value="83P" <? echo $onti_calctype == '83P' ? 'selected' : '' ?>>TI-83 Plus / TI-84 Plus Family</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Nom de la variable: </td>
              <td><input type="text" maxlength="8" name="onti_filename" value="<? echo $onti_filename;?>"> <font color="gray">max 8 charact�res</font></td>
            </tr>
            <tr>
              <td>Commentaire:</td>
              <td><input type="text" maxlength="40" name="onti_comment" value="<? echo $onti_comment;?>"> <font color="gray">max 40 charact�res</font></td>
            </tr>
            <tr>
              <td>Stockage:</td>
              <td>
                <input type="radio" name="onti_storetype" value="RAM" <? echo $onti_storetype == "RAM" ? 'checked' : '' ?>>RAM
                <input type="radio" name="onti_storetype" value="ARCHIVE" <? echo $onti_storetype == "ARCHIVE" ? 'checked' : '' ?>> Archive
                <i>(non applicable pour les TI-83)</i>
              </td>
            </tr>
        </tbody>
      </table>
      <h2>Contenu du fichier</h2>
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
      <br><br>
      <input name="submited" type="submit" value="Envoyer">
    </form>
  <?

?>

<?
  include "bottom.php";
?>