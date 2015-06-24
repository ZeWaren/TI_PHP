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
           <a href="83s-8xs-encoder.php?type=8xs&date=<? echo gmdate("d-M-Y-H:i:s")?>"><img src="./images/extensions/89s.gif"> Enregistrer en <? echo $onti_calctype == '83' ? '83S' : '8XS';?></a>
           &nbsp;&nbsp;&nbsp;
           <a href="83s-8xs-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Enregistrer en TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="83s-8xs-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Enregistrer en TXT sans les informations d'entête</a>
    <?
         }
    ?>
    <form action="83s-8xs-creator.php" enctype="multipart/form-data" method="post">
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
                  <option value="Str1" <? echo $onti_filename == 'Str1' ? 'selected' : '' ?>>Str1</option>
                  <option value="Str2" <? echo $onti_filename == 'Str2' ? 'selected' : '' ?>>Str2</option>
                  <option value="Str3" <? echo $onti_filename == 'Str3' ? 'selected' : '' ?>>Str3</option>
                  <option value="Str4" <? echo $onti_filename == 'Str4' ? 'selected' : '' ?>>Str4</option>
                  <option value="Str5" <? echo $onti_filename == 'Str5' ? 'selected' : '' ?>>Str5</option>
                  <option value="Str6" <? echo $onti_filename == 'Str6' ? 'selected' : '' ?>>Str6</option>
                  <option value="Str7" <? echo $onti_filename == 'Str7' ? 'selected' : '' ?>>Str7</option>
                  <option value="Str8" <? echo $onti_filename == 'Str8' ? 'selected' : '' ?>>Str8</option>
                  <option value="Str9" <? echo $onti_filename == 'Str9' ? 'selected' : '' ?>>Str9</option>
                  <option value="Str0" <? echo $onti_filename == 'Str0' ? 'selected' : '' ?>>Str0</option>
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