<?
  session_start();
  include "top.php";
?>

<?
 echo '<a href="index.php">Retour au menu principal</a>';
 $uploadDir = 'tempuploaded/';
// $filename = $uploadDir.session_id();

 $ffilename=session_id();
   if ( (isset($_FILES['userfile'])) && (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadDir . $ffilename.strrchr($_FILES['userfile']['name'], '.'))))
     {
       $ffilename .= strrchr($_FILES['userfile']['name'], '.');
     }
 $filename = $uploadDir.$ffilename;
 $onti_image = isset($_POST["onti_image"]) ? $_POST["onti_image"] : $filename;
// $onti_image = $ffilename != "" ? $filename : $onti_image;

   switch (strtolower(strrchr($onti_image, '.')))
     {
       case '.jpeg':
       case '.jpg' :
         {
           $img = @imagecreatefromjpeg($onti_image);
           break;
         }
       case '.png' :
         {
           $img = @imagecreatefrompng($onti_image);
           break;
         }
       case '.gif' :
         {
           $img = @imagecreatefromgif($onti_image);
           break;
         }
       default:
         {
           break;
         }
     }

  function ReduceSizeToFitMax($src_img, $max_width, $max_height)
  {
    $origw=imagesx($src_img);
    $origh=imagesy($src_img);
    if (($origw <= $max_width) && ($origh <= $max_height))
        {
          $dst_img = $src_img;
          return $dst_img;
        }
    if ($origw > $max_width)
      {
        $new_w = $max_width;
        $new_h=$new_w*$origh / $origw;
      }
    else
      {
        $new_h = $max_height;
        $new_w=$new_h*$origw / $origh;
      }
    $dst_img = imagecreatetruecolor($new_w,$new_h);
    imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img));
    return $dst_img;
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

  $onti_filename = isset($_POST["onti_filename"]) ? $_POST["onti_filename"] : 'Pic1';
  $onti_comment = isset($_POST["onti_comment"]) ? $_POST["onti_comment"] : 'Encodé par ti.zewaren.net';
  $_SESSION["onti_filename"]=$onti_filename;
  $_SESSION["onti_comment"]=$onti_comment;
  $_SESSION["onti_image"]=$onti_image;

   if (!isset($img))
     {
       echo '<h2>Ouvrir un fichier</h2>';
       echo '<form enctype="multipart/form-data" action="82i-creator.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir un fichier image (jpg, png, gif,):  <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
       echo '</form>';
       include "bottom.php";
       die();
     }
   $max_width=96;
   $max_height=64;
   $img = ReduceSizeToFitMax($img, $max_width, $max_height);
   $img = ReduceSizeToFitMax($img, $max_width, $max_height); //Deux fois au cas ou les deux composantes dépassent
   $img2 = imagecreatetruecolor(96, 64);
   $background = imagecolorallocate($img2, 255, 255, 255);   
   imagecopy($img2, $img, 0, 0, 0, 0, imagesx($img), imagesy($img));
   imagepng($img2, 'salut.png');
   imagedestroy($img);
   $img = $img2;
//   imagefilter($img, IMG_FILTER_GRAYSCALE);
     for ($i=0; $i<imagesx($img); $i++)
       for ($j=0; $j<imagesy($img); $j++)
         {
           $rgb = imagecolorat($img, $i, $j);
           $r = ($rgb >> 16) & 0xFF;
           $g = ($rgb >> 8) & 0xFF;
           $b = $rgb & 0xFF;
           imagesetpixel($img, $i, $j, ($r + $g + $b) / 3 > 100 ? 0xFFFFFF : 0x000000 );
         }
   imagepng($img, $onti_image.'.buffer.png');
?>
    <?
       if ($onti_image!="")
         {
    ?>
           <h2>Enregistrer le dernier fichier envoyé</h2>
           <a href="82i-encoder.php?type=82i&date=<? echo gmdate("d-M-Y-H:i:s")?>"><img src="./images/extensions/89i.gif"> Enregistrer en 82I</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82i-encoder.php?type=jpg"><img src="./images/extensions/jpg.png"> Enregistrer en JPG</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82i-encoder.php?type=png"><img src="./images/extensions/png.png"> Enregistrer en PNG</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82i-encoder.php?type=gif"><img src="./images/extensions/gif.png"> Enregistrer en GIF</a>
    <?
         }
    ?>
    <?
       echo '<h2>Ouvrir un autre fichier</h2>';
       echo '<form enctype="multipart/form-data" action="82i-creator.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir un fichier image (jpg, png, gif,):  <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
       echo '</form>';
    ?>   
    <form action="82i-creator.php" enctype="multipart/form-data" method="post">
      <h2>Entête du fichier</h2>
      <table>
        <tbody>
            <tr>
              <td>Nom de la variable: </td>
              <td>
                <select name="onti_filename">
                  <option value="Pic1" <? echo $onti_filename == 'Pic1' ? 'selected' : '' ?>>Pic1</option>
                  <option value="Pic2" <? echo $onti_filename == 'Pic2' ? 'selected' : '' ?>>Pic2</option>
                  <option value="Pic3" <? echo $onti_filename == 'Pic3' ? 'selected' : '' ?>>Pic3</option>
                  <option value="Pic4" <? echo $onti_filename == 'Pic4' ? 'selected' : '' ?>>Pic4</option>
                  <option value="Pic5" <? echo $onti_filename == 'Pic5' ? 'selected' : '' ?>>Pic5</option>
                  <option value="Pic6" <? echo $onti_filename == 'Pic6' ? 'selected' : '' ?>>Pic6</option>
                  <option value="Pic7" <? echo $onti_filename == 'Pic7' ? 'selected' : '' ?>>Pic7</option>
                  <option value="Pic8" <? echo $onti_filename == 'Pic8' ? 'selected' : '' ?>>Pic8</option>
                  <option value="Pic9" <? echo $onti_filename == 'Pic9' ? 'selected' : '' ?>>Pic9</option>
                  <option value="Pic0" <? echo $onti_filename == 'Pic0' ? 'selected' : '' ?>>Pic0</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Commentaire:</td>
              <td><input type="text" maxlength="40" name="onti_comment" value="<? echo $onti_comment;?>"> <font color="gray">max 40 charactères</font></td>
            </tr>
        </tbody>
      </table>
      <h2>Contenu du fichier</h2>
        <input type="hidden" name="onti_image" value="<? echo $onti_image; ?>">
        <table>
          <tbody>
            <tr>
              <td>Aperçu de l'image</td>
              <td>
                <img src="<? echo $onti_image.'.buffer.png'.'?'.date("h-i-s");?>">
              </td>
            </tr>
            <tr>
              <td><input type="submit" value="Envoyer"></td>
            </tr>
            <tr>
              <td>Image d'origine</td>
              <td><img src="<? echo $onti_image.'?'.date("h-i-s"); ?>"></td>
            </tr>
          </tbody>
        </table>
      <br>
    </form>

<?
  include "bottom.php";
?>