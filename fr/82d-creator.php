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
  $onti_mode = isset($_POST['onti_mode']) ? $_POST['onti_mode'] : "function";

  $onti_graphsettings1 = isset($_POST["onti_graphsettings1"]) ? $_POST["onti_graphsettings1"] : "DOT";
  $onti_graphsettings2 = isset($_POST["onti_graphsettings2"]) ? $_POST["onti_graphsettings2"] : "SIMUL";
  $onti_graphsettings3 = isset($_POST["onti_graphsettings3"]) ? $_POST["onti_graphsettings3"] : "GRIDON";
  $onti_graphsettings4 = isset($_POST["onti_graphsettings4"]) ? $_POST["onti_graphsettings4"] : "POLARGC";
  $onti_graphsettings5 = isset($_POST["onti_graphsettings5"]) ? $_POST["onti_graphsettings5"] : "COORDOFF";
  $onti_graphsettings6 = isset($_POST["onti_graphsettings6"]) ? $_POST["onti_graphsettings6"] : "AXESOFF";
  $onti_graphsettings7 = isset($_POST["onti_graphsettings7"]) ? $_POST["onti_graphsettings7"] : "LABELON";

  $onti_sequencemode = isset($_POST["onti_sequencemode"]) ? $_POST["onti_sequencemode"] : "Time";

  if ($onti_mode == "function")
  {
    $names = array(
                    "Xmin",
                    "Xmax",
                    "Xscl",
                    "Ymin",
                    "Ymax",
                    "Yscl",
                  );
    for ($i=0; $i<10; $i++)
      {
        $onti_functioncontent[$i] = isset($_POST["onti_functioncontent".$i]) ? $_POST["onti_functioncontent".$i] : "";
        $onti_funcselected[$i] = isset($_POST["onti_funcselected".$i]) && $onti_functioncontent[$i] != "" ? $_POST["onti_funcselected".$i] : "unselected";
      }
  }
  else if ($onti_mode == "parametric")
  {
    $names = array(
                    "Xmin",
                    "Xmax",
                    "Xscl",
                    "Ymin",
                    "Ymax",
                    "Yscl",
                    "Tmin",
                    "Tmax",
                    "Tstep"
                  );
    for ($i=1; $i<7; $i++)
      {
        $onti_functioncontent[$i] = isset($_POST["onti_functioncontent".$i]) ? $_POST["onti_functioncontent".$i] : "";
        $onti_functioncontent2[$i] = isset($_POST["onti_functioncontent2".$i]) ? $_POST["onti_functioncontent2".$i] : "";
        $onti_funcselected[$i] = isset($_POST["onti_funcselected".$i]) ? $_POST["onti_funcselected".$i] : "unselected";
      }
  }
  else if ($onti_mode == "polar")
  {
    $names = array(
                    "Xmin",
                    "Xmax",
                    "Xscl",
                    "Ymin",
                    "Ymax",
                    "Yscl",
                    "Tetamin",
                    "Tetamax",
                    "Tetastep"
                  );
    for ($i=0; $i<6; $i++)
      {
        $onti_functioncontent[$i] = isset($_POST["onti_functioncontent".$i]) ? $_POST["onti_functioncontent".$i] : "";
        $onti_funcselected[$i] = isset($_POST["onti_funcselected".$i]) && $onti_functioncontent[$i] != "" ? $_POST["onti_funcselected".$i] : "unselected";
      }
  }
  else if ($onti_mode == "sequence")
  {
    $names = array(
                    "Xmin",
                    "Xmax",
                    "Xscl",
                    "Ymin",
                    "Ymax",
                    "Yscl",
                    "nMin",
                    "nMax",
                    "UnStart",
                    "VnStart",
                    "nStart"                                        
                  );
    for ($i=0; $i<2; $i++)
      {
        $onti_functioncontent[$i] = isset($_POST["onti_functioncontent".$i]) ? $_POST["onti_functioncontent".$i] : "";
        $onti_funcselected[$i] = isset($_POST["onti_funcselected".$i]) && $onti_functioncontent[$i] != "" ? $_POST["onti_funcselected".$i] : "unselected";
      }
  }

  $listcount = count($names);

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

  $_SESSION["onti_filename"]=$onti_filename;
  $_SESSION["onti_comment"]=$onti_comment;
  $_SESSION["listcount"]=$listcount;

  $_SESSION["onti_numbersigns"]=$onti_numbersign;
  $_SESSION["onti_mantissas"]=$onti_mantissa;
  $_SESSION["onti_expsigns"]=$onti_expsign;
  $_SESSION["onti_exposants"]=$onti_exposant;

  $_SESSION["onti_graphsettings1"] = $onti_graphsettings1;
  $_SESSION["onti_graphsettings2"] = $onti_graphsettings2;
  $_SESSION["onti_graphsettings3"] = $onti_graphsettings3;
  $_SESSION["onti_graphsettings4"] = $onti_graphsettings4;
  $_SESSION["onti_graphsettings5"] = $onti_graphsettings5;
  $_SESSION["onti_graphsettings6"] = $onti_graphsettings6;
  $_SESSION["onti_graphsettings7"] = $onti_graphsettings7;
  $_SESSION["onti_sequencemode"]=$onti_sequencemode;

  $_SESSION["onti_mode"]=$onti_mode;

  $_SESSION["onti_functioncontent"]=$onti_functioncontent;
    if (isset($onti_functioncontent2))
      $_SESSION["onti_functioncontent2"]=$onti_functioncontent2;
  $_SESSION["onti_funcselected"]=$onti_funcselected;


  ?>
    <?
       if ($oktosave)
         {
    ?>
           <h2>Save Last Updated File</h2>
           <a href="82d-encoder.php?type=82d&date=<? echo gmdate("d-M-Y-H:i:s")?>"><img src="./images/extensions/89d.gif"> Enregistrer en 82D</a>
           &nbsp;&nbsp;&nbsp;
           <a href="82d-encoder.php?type=txt"><img src="./images/extensions/txt.png"> Enregistrer en TXT</a>
           &nbsp;&nbsp;&nbsp;
           <a href="83d-encoder.php?type=txtnoheader"><img src="./images/extensions/txt.png"> Enregistrer en TXT sans les informations d'entête</a>
    <?
         }
    ?>
    <form action="82d-creator.php" enctype="multipart/form-data" method="post">
      <h2>Entête du fichier</h2>
      <table>
        <tbody>
            <tr>
              <td>Nom de la variable:</td>
              <td>
                <select name="onti_filename">
                  <option value="GDB1" <? echo $onti_filename == 'GDB1' ? 'selected' : '' ?>>GDB1</option>
                  <option value="GDB2" <? echo $onti_filename == 'GDB2' ? 'selected' : '' ?>>GDB2</option>
                  <option value="GDB3" <? echo $onti_filename == 'GDB3' ? 'selected' : '' ?>>GDB3</option>
                  <option value="GDB4" <? echo $onti_filename == 'GDB4' ? 'selected' : '' ?>>GDB4</option>
                  <option value="GDB5" <? echo $onti_filename == 'GDB5' ? 'selected' : '' ?>>GDB5</option>
                  <option value="GDB6" <? echo $onti_filename == 'GDB6' ? 'selected' : '' ?>>GDB6</option>
                  <option value="GDB7" <? echo $onti_filename == 'GDB7' ? 'selected' : '' ?>>GDB7</option>
                  <option value="GDB8" <? echo $onti_filename == 'GDB8' ? 'selected' : '' ?>>GDB8</option>
                  <option value="GDB9" <? echo $onti_filename == 'GDB9' ? 'selected' : '' ?>>GDB9</option>
                  <option value="GDB0" <? echo $onti_filename == 'GDB0' ? 'selected' : '' ?>>GDB0</option>
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
        Mode:
          <select name="onti_mode">
            <option value="function" <? echo $onti_mode == 'function' ? 'selected' : '' ?>>Function</option>
            <option value="parametric" <? echo $onti_mode == 'parametric' ? 'selected' : '' ?>>Parametric</option>
            <option value="polar" <? echo $onti_mode == 'polar' ? 'selected' : '' ?>>Polar</option>
            <option value="sequence" <? echo $onti_mode == 'sequence' ? 'selected' : '' ?>>Sequence</option>
          </select>
          <input name="nonesubmited" type="submit" value="Update">
          <br><br>
        Paramètres du graphe:<br>
          <input type="radio" name="onti_graphsettings1" value="DOT" <? echo $onti_graphsettings1 == "DOT" ? 'checked' : '' ?>>Dot
          <input type="radio" name="onti_graphsettings1" value="CONNECTED" <? echo $onti_graphsettings1 == "CONNECTED" ? 'checked' : '' ?>> Connected
          <br>
          <input type="radio" name="onti_graphsettings2" value="SIMUL" <? echo $onti_graphsettings2 == "SIMUL" ? 'checked' : '' ?>>Simul
          <input type="radio" name="onti_graphsettings2" value="SEQUENCIAL" <? echo $onti_graphsettings2 == "SEQUENCIAL" ? 'checked' : '' ?>> Sequencial
          <br>
          <input type="radio" name="onti_graphsettings3" value="GRIDON" <? echo $onti_graphsettings3 == "GRIDON" ? 'checked' : '' ?>>GridOn
          <input type="radio" name="onti_graphsettings3" value="GRIDOFF" <? echo $onti_graphsettings3 == "GRIDOFF" ? 'checked' : '' ?>> GridOff
          <br>
          <input type="radio" name="onti_graphsettings4" value="POLARGC" <? echo $onti_graphsettings4 == "POLARGC" ? 'checked' : '' ?>>PolarGC
          <input type="radio" name="onti_graphsettings4" value="RECTGC" <? echo $onti_graphsettings4 == "RECTGC" ? 'checked' : '' ?>> RectGC
          <br>
          <input type="radio" name="onti_graphsettings5" value="COORDOFF" <? echo $onti_graphsettings5 == "COORDOFF" ? 'checked' : '' ?>> CoordOff
          <input type="radio" name="onti_graphsettings5" value="COORDON" <? echo $onti_graphsettings5 == "COORDON" ? 'checked' : '' ?>>CoordOn
          <br>
          <input type="radio" name="onti_graphsettings6" value="AXESOFF" <? echo $onti_graphsettings6 == "AXESOFF" ? 'checked' : '' ?>> AxesOff
          <input type="radio" name="onti_graphsettings6" value="AXESON" <? echo $onti_graphsettings6 == "AXESON" ? 'checked' : '' ?>>AxesOn
          <br>
          <input type="radio" name="onti_graphsettings7" value="LABELON" <? echo $onti_graphsettings7 == "LABELON" ? 'checked' : '' ?>>LabelOn
          <input type="radio" name="onti_graphsettings7" value="LABELOFF" <? echo $onti_graphsettings7 == "LABELOFF" ? 'checked' : '' ?>> LabelOff
          <br>
          <br>
        <table>
          <?
             for ($i=0; $i<$listcount; $i++)
               {
                 echo '<tr>';
                 ?>
                  <td>
                    <? echo $names[$i]; ?>
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
        <?
          if ($onti_mode == "function")
            {
              echo '<table><tr><td><u>Nom</u></td><td><u>Etat</u></td><td><u>Contenu</u></td></tr>';
                for ($i = 0; $i<10; $i++)
                  {
                    echo '<tr>';
                    echo '<td>Y'.($i==9 ? '0' : $i+1).'</td>';
                    echo '<td><select name="onti_funcselected'.$i.'">'
                         .'<option value="selected" '.($onti_funcselected[$i] == "selected" ? "selected" : "").'>Selectionné</option>'
                         .'<option value="unselected" '.($onti_funcselected[$i] == "unselected" ? "selected" : "").'>Non Selectionné</option>'
                         .'</select></td>';
                    echo '<td><input style="width: 300px;" type="text" name="onti_functioncontent'.$i.'" value="'.$onti_functioncontent[$i].'"></td>';
                    echo '</tr>';
                  }
              echo '</table>';
            }
          else if ($onti_mode == "parametric")
            {
              echo '<table><tr><td><u>Index</u></td><td><u>Etat</u></td><td><u>XxT</u></td><td><u>YxT</u></td></tr>';
                for ($i = 1; $i<7; $i++)
                  {
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td><select name="onti_funcselected'.$i.'">'
                         .'<option value="selected" '.($onti_funcselected[$i] == "selected" ? "selected" : "").'>Selectionné</option>'
                         .'<option value="unselected" '.($onti_funcselected[$i] == "unselected" ? "selected" : "").'>Non Selectionné</option>'
                         .'</select></td>';
                    echo '<td><input style="width: 300px;" type="text" name="onti_functioncontent'.$i.'" value="'.$onti_functioncontent[$i].'"></td>';
                    echo '<td><input style="width: 300px;" type="text" name="onti_functioncontent2'.$i.'" value="'.$onti_functioncontent2[$i].'"></td>';
                    echo '</tr>';
                  }
              echo '</table>';
            }
          else if ($onti_mode == "polar")
            {
              echo '<table><tr><td><u>Nom</u></td><td><u>Etat</u></td><td><u>Contenu</u></td></tr>';
                for ($i = 0; $i<6; $i++)
                  {
                    echo '<tr>';
                    echo '<td>r'.($i+1).'</td>';
                    echo '<td><select name="onti_funcselected'.$i.'">'
                         .'<option value="selected" '.($onti_funcselected[$i] == "selected" ? "selected" : "").'>Selectionné</option>'
                         .'<option value="unselected" '.($onti_funcselected[$i] == "unselected" ? "selected" : "").'>Non Selectionné</option>'
                         .'</select></td>';
                    echo '<td><input style="width: 300px;" type="text" name="onti_functioncontent'.$i.'" value="'.$onti_functioncontent[$i].'"></td>';
                    echo '</tr>';
                  }
              echo '</table>';
            }
          else if ($onti_mode == "sequence")
            {
              echo 'Sequence Mode: <select name="onti_sequencemode">'
                   .'<option value="Time" '.($onti_sequencemode == "Time" ? "selected" : "").'>Time</option>'
                   .'<option value="Web" '.($onti_sequencemode == "Web" ? "selected" : "").'>Web</option>'
                   .'</select><br><br>';
              $funcnames=array("u", "v");
              echo '<table><tr><td><u>Nom</u></td><td><u>Etat</u></td><td><u>Contenu</u></td></tr>';
                for ($i = 0; $i<2; $i++)
                  {
                    echo '<tr>';
                    echo '<td>'.$funcnames[$i].'</td>';
                    echo '<td><select name="onti_funcselected'.$i.'">'
                         .'<option value="selected" '.($onti_funcselected[$i] == "selected" ? "selected" : "").'>Selectionné</option>'
                         .'<option value="unselected" '.($onti_funcselected[$i] == "unselected" ? "selected" : "").'>Non Selectionné</option>'
                         .'</select></td>';
                    echo '<td><input style="width: 300px;" type="text" name="onti_functioncontent'.$i.'" value="'.$onti_functioncontent[$i].'"></td>';
                    echo '</tr>';
                  }
              echo '</table>';
            }
        ?>
      <br><br>
      <input name="submited" type="submit" value="Update">
    </form>
  <?

?>

<?
  include "bottom.php";
?>