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
       $filetext = str_replace("\r\n", " ", file_get_contents($filename));
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

  $onti_filename = isset($_POST["onti_filename"]) ? $_POST["onti_filename"] : 'untitled';
  $onti_folder = isset($_POST["onti_folder"]) ? $_POST["onti_folder"] : 'main';
  $onti_comment = isset($_POST["onti_comment"]) ? $_POST["onti_comment"] : 'Encodé par ti.zewaren.net';
  $onti_calctype = isset($_POST["onti_calctype"]) ? $_POST["onti_calctype"] : '89';
  $onti_text = isset($_POST["onti_text"]) ? $_POST["onti_text"] : $filetext;
  $onti_text = $filetext != '' ? $filetext : $onti_text;
  $onti_storetype = isset($_POST["onti_storetype"]) ? $_POST["onti_storetype"] : 'RAM';
  $_SESSION["onti_filename"]=$onti_filename;
  $_SESSION["onti_folder"]=$onti_folder;
  $_SESSION["onti_comment"]=$onti_comment;
  $_SESSION["onti_calctype"]=$onti_calctype;
  $_SESSION["onti_text"]=$onti_text;
  $_SESSION["onti_storetype"]=$onti_storetype;

  ?>
    <?
       if ($onti_text!="")
         {
    ?>
           <h2>Enregistrer le dernier fichier envoyé</h2>
           <a href="89s-92s-9xs-v2s-encoder.php?type=89s"><img src="./images/extensions/89t.png"> Enregistrer en 89S / 92S / 9XS / V2S</a>
           &nbsp;&nbsp;&nbsp;
           <a href="89s-92s-9xs-v2s-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Enregistrer en TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="89s-92s-9xs-v2s-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Enregistrer en TXT sans les informations d'entête</a>
    <?
         }
    ?>
    <form action="89s-92s-9xs-v2s-creator.php" enctype="multipart/form-data" method="post">
      <h2>Entête du fichier</h2>
      <div style="float: left;">
        <table>
          <tbody>
              <tr>
                <td>Modèle de calculette:</td>
                <td>
                  <select name="onti_calctype">
                    <option value="89" <? echo $onti_calctype == '89' ? 'selected' : '' ?>>TI-89</option>
                    <option value="92" <? echo $onti_calctype == '92' ? 'selected' : '' ?>>TI-92</option>
                    <option value="92P" <? echo $onti_calctype == '92P' ? 'selected' : '' ?>>TI-92P</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Nom de la variable: </td>
                <td><input type="text" maxlength="8" name="onti_filename" value="<? echo $onti_filename;?>"> <font color="gray">max 8 charactères</font></td>
              </tr>
              <tr>
                <td>Dossier:</td>
                <td><input type="text" maxlength="8" name="onti_folder" value="<? echo $onti_folder;?>"> <font color="gray">max 8 charactères</font></td>
              </tr>
              <tr>
                <td>Commentaire:</td>
                <td><input type="text" maxlength="40" name="onti_comment" value="<? echo $onti_comment;?>"> <font color="gray">max 40 charactères</font></td>
              </tr>
              <tr>
                <td>Stockage:</td>
                <td>
                  <input type="radio" name="onti_storetype" value="RAM" <? echo $onti_storetype == "RAM" ? 'checked' : '' ?>>RAM
                  <input type="radio" name="onti_storetype" value="RAML" <? echo $onti_storetype == "RAML" ? 'checked' : '' ?>> RAM Locked
                  <input type="radio" name="onti_storetype" value="ARCHIVE" <? echo $onti_storetype == "ARCHIVE" ? 'checked' : '' ?>> Archive
                </td>
              </tr>
          </tbody>
        </table>
      </div>
      <div style="float: right">
        <? $adsensetype="180150"; include "../adsense.php"; ?>
      </div>
      <br clear="all">
      <h2>Contenu du fichier</h2>
        Importer un fichier texte: <input name="userfile" type="file" /> <input type="submit" value="Importer"> <i>Returns will be converted into spaces</i><br><br>
        Contenu: <input style="width: 600px;" type="text" name="onti_text" value="<? echo htmlentities($onti_text); ?>">
        <br><br>
        <input type="submit" value="Envoyer">
    </form>
  <?

?>

<?
  include "bottom.php";
?>