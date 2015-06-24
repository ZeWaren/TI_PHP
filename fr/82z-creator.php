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
  $onti_comment = isset($_POST["onti_comment"]) ? $_POST["onti_comment"] : 'Encodé par ti.zewaren.net';
  $onti_text = isset($_POST["onti_text"]) ? $_POST["onti_text"] : $filetext;
  $onti_text = $filetext != "" ? $filetext : $onti_text; 
  $listcount = 17;

  $names = array(
                  "Xmin",
                  "Xmax",
                  "Xscl",
                  "Ymin",
                  "Ymax",
                  "Yscl",
                  "Tetamin",
                  "Tetamax",
                  "Tetastep",
                  "Tmin",
                  "Tmax",
                  "Tstep",
                  "nMin",
                  "nMax",
                  "UnStart",
                  "VnStart",
                  "nStart",
                );

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
           <h2>Enregistrer le dernier fichier envoyé</h2>
           <a href="82z-encoder.php?type=82z&date=<? echo gmdate("d-M-Y-H:i:s")?>"><img src="./images/extensions/83t.gif"> Enregistrer en 82Z</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82z-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Enregistrer en TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82z-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Enregistrer en TXT sans les informations d'entête</a>
    <?
         }
    ?>
    <form action="82z-creator.php" enctype="multipart/form-data" method="post">
      <h2>Entête du fichier</h2>
      <table>
        <tbody>
            <tr>
              <td>Commentaire:</td>
              <td><input type="text" maxlength="40" name="onti_comment" value="<? echo $onti_comment;?>"> <font color="gray">max 40 charactères</font></td>
            </tr>
        </tbody>
      </table>
      <h2>Contenu du fichier</h2>
        <table>
          <?
             for ($i=0; $i<$listcount; $i++)
               {
                 echo '<tr>';
                 ?>
                  <td>
                    <? echo $names[$i].': &nbsp;&nbsp;'; ?>
                  </td>
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

                 echo '</tr>';
               }
          ?>
        </table>
      <br><br>
      <input name="submited" type="submit" value="Envoyer">
    </form>
  <?

?>

<?
  include "bottom.php";
?>