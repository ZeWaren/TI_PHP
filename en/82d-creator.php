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

  $oktosave = isset($_POST["submited"]);
  $onti_filename = isset($_POST["onti_filename"]) ? $_POST["onti_filename"] : 'untitled';
  $onti_comment = isset($_POST["onti_comment"]) ? $_POST["onti_comment"] : 'Created on ti.zewaren.net';
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
            $onti_mantissa[$i] /=