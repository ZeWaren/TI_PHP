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
  $onti_comment = isset($_POST["onti_comment"]) ? $_POST["onti_comment"] : 'Encodé par ti.zewaren.net';
  $onti_text = isset($_POST["onti_text"]) ? $_POST["onti_text"] : $filetext;
  $onti_text = $filetext != "" ? $filetext : $onti_text; 
  $onti_storetype = isset($_POST["onti_storetype"]) ? $_POST["onti_storetype"] : 'RAM';
  $onti_calctype = isset($_POST["onti_calctype"]) ? $_POST["onti_calctype"] : '8XS';

  $_SESSION["onti_filename"]=$onti_filename;
  $_SESSION["onti_calctype"]=$onti_calctype;
  $_SESSION["onti_comment"]=$onti_comment;
  $_SESSION["onti_storetype"]=$onti_storetype;
  $_SESSION["onti_text"]=$onti_text;

  ?>
    <?
       if ($oktosave)
         {
    ?>
           <h2>Enregistrer le dernier fichier envoyé</h2>
           <a href="83y-8xy-encoder.php?type=8xy&date=<? echo gmdate("d-M-Y-H:i:s")?>"><img src="./images/extensions/89s.gif"> Enregistrer en <? echo $onti_calctype == '83' ? '83Y' : '8XY';?></a>
           &nbsp;&nbsp;&nbsp;
           <a href="83y-8xy-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Enregistrer en TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="83y-8xy-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Enregistrer en TXT sans les informations d'entête</a>
    <?
         }
    ?>
    <form action="83y-8xy-creator.php" enctype="multipart/form-data" method="post">
      <h2>Entête du fichier</h2>
      <table>
        <tbody>
            <tr>
              <td>Modèle de calculette:</td>
              <td>
                <select name="onti_calctype">
                  <option value="83" <? echo $onti_calctype == '83' ? 'selected' : '' ?>>TI-83 Family</option>
                  <option value="83P" <? echo $onti_calctype == '83P' ? 'selected' : '' ?>>TI-83 Plus / TI-84 Plus Family</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Nom de la variable: </td>
              <td>
                <select name="onti_filename">
                  <option value="Y1" <? echo $onti_filename == 'Y1' ? 'selected' : '' ?>>Y1</option>
                  <option value="Y2" <? echo $onti_filename == 'Y2' ? 'selected' : '' ?>>Y2</option>
                  <option value="Y3" <? echo $onti_filename == 'Y3' ? 'selected' : '' ?>>Y3</option>
                  <option value="Y4" <? echo $onti_filename == 'Y4' ? 'selected' : '' ?>>Y4</option>
                  <option value="Y5" <? echo $onti_filename == 'Y5' ? 'selected' : '' ?>>Y5</option>
                  <option value="Y6" <? echo $onti_filename == 'Y6' ? 'selected' : '' ?>>Y6</option>
                  <option value="Y7" <? echo $onti_filename == 'Y7' ? 'selected' : '' ?>>Y7</option>
                  <option value="Y8" <? echo $onti_filename == 'Y8' ? 'selected' : '' ?>>Y8</option>
                  <option value="Y9" <? echo $onti_filename == 'Y9' ? 'selected' : '' ?>>Y9</option>
                  <option value="Y0" <? echo $onti_filename == 'Y0' ? 'selected' : '' ?>>Y0</option>
                  <option value="r1" <? echo $onti_filename == 'r1' ? 'selected' : '' ?>>r1</option>
                  <option value="r2" <? echo $onti_filename == 'r2' ? 'selected' : '' ?>>r2</option>
                  <option value="r3" <? echo $onti_filename == 'r3' ? 'selected' : '' ?>>r3</option>
                  <option value="r4" <? echo $onti_filename == 'r4' ? 'selected' : '' ?>>r4</option>
                  <option value="r5" <? echo $onti_filename == 'r5' ? 'selected' : '' ?>>r5</option>
                  <option value="r6" <? echo $onti_filename == 'r6' ? 'selected' : '' ?>>r6</option>
                  <option value="X1T" <? echo $onti_filename == 'X1T' ? 'selected' : '' ?>>X1T</option>
                  <option value="Y1T" <? echo $onti_filename == 'Y1T' ? 'selected' : '' ?>>Y1T</option>
                  <option value="X2T" <? echo $onti_filename == 'X2T' ? 'selected' : '' ?>>X2T</option>
                  <option value="Y2T" <? echo $onti_filename == 'Y2T' ? 'selected' : '' ?>>Y2T</option>
                  <option value="X3T" <? echo $onti_filename == 'X3T' ? 'selected' : '' ?>>X3T</option>
                  <option value="Y3T" <? echo $onti_filename == 'Y3T' ? 'selected' : '' ?>>Y3T</option>
                  <option value="X4T" <? echo $onti_filename == 'X4T' ? 'selected' : '' ?>>X4T</option>
                  <option value="Y4T" <? echo $onti_filename == 'Y4T' ? 'selected' : '' ?>>Y4T</option>
                  <option value="X5T" <? echo $onti_filename == 'X5T' ? 'selected' : '' ?>>X5T</option>
                  <option value="Y5T" <? echo $onti_filename == 'Y5T' ? 'selected' : '' ?>>Y5T</option>
                  <option value="X6T" <? echo $onti_filename == 'X6T' ? 'selected' : '' ?>>X6T</option>
                  <option value="Y6T" <? echo $onti_filename == 'Y6T' ? 'selected' : '' ?>>Y6T</option>
                  <option value="u" <? echo $onti_filename == 'u' ? 'selected' : '' ?>>u</option>
                  <option value="v" <? echo $onti_filename == 'v' ? 'selected' : '' ?>>v</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Commentaire:</td>
              <td><input type="text" maxlength="40" name="onti_comment" value="<? echo $onti_comment;?>"> <font color="gray">max 40 charactères</font></td>
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
        Texte: <input style="width: 400px;" type="text" name="onti_text" value="<? echo $onti_text; ?>">
      <br><br>
      <input name="submited" type="submit" value="Envoyer">
    </form>
  <?

?>

<?
  include "bottom.php";
?>