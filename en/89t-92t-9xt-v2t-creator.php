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

  $onti_filename = isset($_POST["onti_filename"]) ? $_POST["onti_filename"] : 'untitled';
  $onti_folder = isset($_POST["onti_folder"]) ? $_POST["onti_folder"] : 'main';
  $onti_comment = isset($_POST["onti_comment"]) ? $_POST["onti_comment"] : 'Created on ti.zewaren.net';
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
           <h2>Save Last Updated File</h2>
           <a href="getencodedtextfile.php?type=89t"><img src="./images/extensions/89t.png"> Save as 89T / 92T</a>
           &nbsp;&nbsp;&nbsp;
           <a href="getencodedtextfile.php?type=txt"><img src="./images/extensions/txt.png"> Save as TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="getencodedtextfile.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Save as TXT without header information</a>
    <?
         }
    ?>
    <form action="89t-92t-9xt-v2t-creator.php" enctype="multipart/form-data" method="post">
      <h2>File Header</h2>
      <div style="float: left;">
        <table>
          <tbody>
              <tr>
                <td>Calculator Type</td>
                <td>
                  <select name="onti_calctype">
                    <option value="89" <? echo $onti_calctype == '89' ? 'selected' : '' ?>>TI-89</option>
                    <option value="92" <? echo $onti_calctype == '92' ? 'selected' : '' ?>>TI-92</option>
                    <option value="92P" <? echo $onti_calctype == '92P' ? 'selected' : '' ?>>TI-92P</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Variable Name:</td>
                <td><input type="text" maxlength="8" name="onti_filename" value="<? echo $onti_filename;?>"> <font color="gray">max 8 characters</font></td>
              </tr>
              <tr>
                <td>Folder:</td>
                <td><input type="text" maxlength="8" name="onti_folder" value="<? echo $onti_folder;?>"> <font color="gray">max 8 characters</font></td>
              </tr>
              <tr>
                <td>Comment:</td>
                <td><input type="text" maxlength="40" name="onti_comment" value="<? echo $onti_comment;?>"> <font color="gray">max 40 characters</font></td>
              </tr>
              <tr>
                <td>Store Type</td>
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
      <h2>File Content</h2>
        Import a text file: <input name="userfile" type="file" /> <input type="submit" value="Import"><br><br>
        <textarea rows="15" name="onti_text"><? echo htmlentities($onti_text); ?></textarea>
      <br>
      <input type="submit" value="Update">
    </form>
  <?

?>

<?
  include "bottom.php";
?>