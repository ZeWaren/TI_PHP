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

  $onti_filename = isset($_POST["onti_filename"]) ? $_POST["onti_filename"] : 'untitled';
  $onti_comment = isset($_POST["onti_comment"]) ? $_POST["onti_comment"] : 'Encodé par ti.zewaren.net';
  $onti_text = isset($_POST["onti_text"]) ? $_POST["onti_text"] : $filetext;
  $onti_text = $filetext != "" ? $filetext : $onti_text;
  $_SESSION["onti_filename"]=$onti_filename;
  $_SESSION["onti_comment"]=$onti_comment;
  $_SESSION["onti_text"]=$onti_text;

  ?>
    <?
       if ($onti_text!="")
         {
    ?>
           <h2>Enregistrer le dernier fichier envoyé</h2>
           <a href="82p-encoder.php?type=82p"><img src="./images/extensions/89z.png"> Enregistrer en 82P</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82p-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Enregistrer en TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82p-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Enregistrer en TXT sans les informations d'entête</a>
    <?
         }
    ?>
    <form action="82p-creator.php" enctype="multipart/form-data" method="post">
      <h2>Entête du fichier</h2>
      <table>
        <tbody>
            <tr>
              <td>Nom de la variable: </td>
              <td><input type="text" maxlength="8" name="onti_filename" value="<? echo $onti_filename;?>"> <font color="gray">max 8 charactères</font></td>
            </tr>
            <tr>
              <td>Commentaire:</td>
              <td><input type="text" maxlength="40" name="onti_comment" value="<? echo $onti_comment;?>"> <font color="gray">max 40 charactères</font></td>
            </tr>
        </tbody>
      </table>
      <h2>Contenu du fichier</h2>
        Importer un fichier texte: <input name="userfile" type="file" /> <input type="submit" value="Importer"><br><br>
        <textarea rows="15" name="onti_text"><? echo htmlentities($onti_text); ?></textarea>
      <br>
      <input type="submit" value="Envoyer">
    </form>
  <?

?>

<?
  include "bottom.php";
?>