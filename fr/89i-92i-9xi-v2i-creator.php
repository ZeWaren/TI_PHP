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

  $onti_filename = isset($_POST["onti_filename"]) ? $_POST["onti_filename"] : 'untitled';
  $onti_folder = isset($_POST["onti_folder"]) ? $_POST["onti_folder"] : 'main';
  $onti_comment = isset($_POST["onti_comment"]) ? $_POST["onti_comment"] : 'Encodé par ti.zewaren.net';
  $onti_calctype = isset($_POST["onti_calctype"]) ? $_POST["onti_calctype"] : '89';
  $onti_screentype = isset($_POST["onti_screentype"]) ? $_POST["onti_screentype"] : 'TI89';
  $onti_storetype = isset($_POST["onti_storetype"]) ? $_POST["onti_storetype"] : 'RAM';
  $_SESSION["onti_filename"]=$onti_filename;
  $_SESSION["onti_folder"]=$onti_folder;
  $_SESSION["onti_comment"]=$onti_comment;
  $_SESSION["onti_calctype"]=$onti_calctype;
  $_SESSION["onti_image"]=$onti_image;
  $_SESSION["onti_storetype"]=$onti_storetype;

   if (!isset($img))
     {
       echo '<h2>Ouvrir un fichier</h2>';
       echo '<form enctype="multipart/form-data" action="89i-92i-9xi-v2i-creator.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir un fichier image (jpg, png, gif,):  <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
       echo '</form>';
       include "bottom.php";
       die();
     }
   $max_width=$onti_screentype=='TI89' ? 158 : 239;
   $max_height=$onti_screentype=='TI89' ? 79 : 103;
   $img = ReduceSizeToFitMax($img, $max_width, $max_height);
   $img = ReduceSizeToFitMax($img, $max_width, $max_height); //Deux fois au cas ou les deux composantes dépassent
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
           <a href="getencodedimagefile.php?type=89i"><img src="./images/extensions/89i.gif"> Enregistrer en 89I / 92I</a>
           &nbsp;&nbsp;&nbsp;
           <a href="getencodedimagefile.php?type=jpg"><img src="./images/extensions/jpg.png"> Enregistrer en JPG</a>
           &nbsp;&nbsp;&nbsp;
           <a href="getencodedimagefile.php?type=png"><img src="./images/extensions/png.png"> Enregistrer en PNG</a>
           &nbsp;&nbsp;&nbsp;
           <a href="getencodedimagefile.php?type=gif"><img src="./images/extensions/gif.png"> Enregistrer en GIF</a>
    <?
         }
    ?>
    <?
       echo '<h2>Ouvrir un autre fichier</h2>';
       echo '<form enctype="multipart/form-data" action="89i-92i-9xi-v2i-creator.php" method="post">';
       echo '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />';
       echo 'Ouvrir un fichier image (jpg, png, gif,):  <input name="userfile" type="file" /> <input type="submit" value="Ouvrir">';
       echo '</form>';
    ?>   
    <form action="89i-92i-9xi-v2i-creator.php" enctype="multipart/form-data" method="post">
      <h2>Entête du fichier</h2>
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
      <h2>Contenu du fichier</h2>
        <input type="hidden" name="onti_image" value="<? echo $onti_image; ?>">
        <table>
          <tbody>
            <tr>
              <td>Calculator Screen Size</td>
              <td>
                <input type="radio" name="onti_screentype" value="TI89" <? echo $onti_screentype == "TI89" ? 'checked' : '' ?>>TI 89 (158x79 pixels)
                <input type="radio" name="onti_screentype" value="TI92V200" <? echo $onti_screentype == "TI92V200" ? 'checked' : '' ?>> TI 92 / V200 (239x103 pixels)
              </td>
            </tr>
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