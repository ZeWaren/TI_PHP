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
  $onti_comment = isset($_POST["onti_comment"]) ? $_POST["onti_comment"] : 'Created on ti.zewaren.net';
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
           <h2>Save Last Updated File</h2>
           <a href="82y-encoder.php?type=82y"><img src="./images/extensions/89f.gif"> Save as 82Y</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82y-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Save as TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82y-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Save as TXT without header information</a>
    <?
         }
    ?>
    <form action="82y-creator.php" enctype="multipart/form-data" method="post">
      <h2>File Header</h2>
      <table>
        <tbody>
            <tr>
              <td>Variable Name:</td>
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
                  <option value="Un" <? echo $onti_filename == 'Un' ? 'selected' : '' ?>>Un</option>
                  <option value="Vn" <? echo $onti_filename == 'Vn' ? 'selected' : '' ?>>Vn</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Comment:</td>
              <td><input type="text" maxlength="40" name="onti_comment" value="<? echo $onti_comment;?>"> <font color="gray">max 40 characters</font></td>
            </tr>
        </tbody>
      </table>
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