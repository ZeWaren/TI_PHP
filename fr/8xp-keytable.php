<?
  session_start();
  include "top.php";
?>

<?
  echo '<a href="index.php">Retour au menu principal</a>';
  echo '<h2>Tableau des touches</h2>';
  echo '<br>';

/*  $text = '<table>';

    $tokens = fopen("ti83tokenkeys.dat", "rb");
    $tokenstrue = fopen("ti83tokens.dat", "rb");    
    fseek($tokens, 0);
    fseek($tokenstrue, 0);    
    for ($i=0; $i<filesize("ti83tokenkeys.dat") / 16; $i++)
      {
        fseek($tokens, $i*16);
        fseek($tokenstrue, $i*16);
        $salut = fread($tokens, 16);
        $tokentrue = fread($tokenstrue, 16);
          if (substr($tokentrue, 2, 7) == '&$black' || substr($tokentrue, 4, 2) == '&*' || substr($tokentrue, 2, 2) == '&!' || ord(substr($salut, 1, 1)) == 0xFF)
            continue;
        $text .= '<tr>';
        $text .= '<td>';
          for ($j=0; $j<strlen($tokentrue) ;$j++)
            {
              if (ord($tokentrue[$j]) > 0xE)
                $text .= $tokentrue[$j];
            }
        $text .= '</td>';
        $text .= '<td>';
          for ($j=0; $j<strlen($salut) ;$j++)
            {
              if (ord($salut[$j]) == 0x01 && $j > 2)
                {
                  $text .= ord($salut[$j+1]).'x';
                  $j++;
                  continue;
                }
              else if (ord($salut[$j]) > 0xE)
                $text .= '<img src="./images/8xpkeys/chr'.(ord($salut[$j])).'.gif"> ';
            }
        $text .= '</td>';
        $text .= '</tr>'."\r\n";
      }
    fclose($tokens);
    fclose($tokenstrue);

  $text .= '</table>';

  echo '<div id="ti83content"><div style="padding: 3px;">'.$text.'</div></div>';*/    

?>

<div id="ti83content"><div style="padding: 3px;"><table><tr><td>ÂDMS</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>ÂDec</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>ÂFrac</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>¸</td><td><img src="./images/8xpkeys/chr191.gif"> </td></tr>
<tr><td>Boxplot</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>[</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr175.gif"> </td></tr>
<tr><td>]</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr185.gif"> </td></tr>
<tr><td>{</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr163.gif"> </td></tr>
<tr><td>}</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr164.gif"> </td></tr>
<tr><td>ı</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr59.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>Ù</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr59.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Ò</td><td><img src="./images/8xpkeys/chr156.gif"> </td></tr>
<tr><td>‹</td><td><img src="./images/8xpkeys/chr161.gif"> </td></tr>
<tr><td>ˆ</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>”</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>(</td><td><img src="./images/8xpkeys/chr163.gif"> </td></tr>
<tr><td>)</td><td><img src="./images/8xpkeys/chr164.gif"> </td></tr>
<tr><td>round(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>pxl-Test(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>augment(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>rowSwap(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr142.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr143.gif"> </td></tr>
<tr><td>row+(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr142.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr156.gif"> </td></tr>
<tr><td>*row(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr142.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr152.gif"> </td></tr>
<tr><td>*row+(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr142.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr153.gif"> </td></tr>
<tr><td>max(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>min(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>RÂPr(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>RÂP¡(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>PÂRx(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>PÂRy(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>median(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>randM(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>mean(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>solve(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr181.gif"> 28x<img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>seq(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>fnInt(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>nDeriv(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>fMin(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>fMax(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td> </td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>"</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr195.gif"> </td></tr>
<tr><td>,</td><td><img src="./images/8xpkeys/chr162.gif"> </td></tr>
<tr><td>‡</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr203.gif"> </td></tr>
<tr><td>!</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>CubicReg </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>QuartReg </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>0</td><td><img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>1</td><td><img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>2</td><td><img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>3</td><td><img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>4</td><td><img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>5</td><td><img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>6</td><td><img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>7</td><td><img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>8</td><td><img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>9</td><td><img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>.</td><td><img src="./images/8xpkeys/chr203.gif"> </td></tr>
<tr><td>˚</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr162.gif"> </td></tr>
<tr><td> or </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td> xor </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr32.gif"> </td></tr>
<tr><td>:</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr203.gif"> </td></tr>
<tr><td>&#CRLF</td><td><img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td> and </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr32.gif"> </td></tr>
<tr><td>A</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>B</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> </td></tr>
<tr><td>C</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr143.gif"> </td></tr>
<tr><td>D</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr156.gif"> </td></tr>
<tr><td>E</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr152.gif"> </td></tr>
<tr><td>F</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr153.gif"> </td></tr>
<tr><td>G</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr154.gif"> </td></tr>
<tr><td>H</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr155.gif"> </td></tr>
<tr><td>I</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr161.gif"> </td></tr>
<tr><td>J</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr162.gif"> </td></tr>
<tr><td>K</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr163.gif"> </td></tr>
<tr><td>L</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr164.gif"> </td></tr>
<tr><td>M</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr165.gif"> </td></tr>
<tr><td>N</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr171.gif"> </td></tr>
<tr><td>O</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>P</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>Q</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>R</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr175.gif"> </td></tr>
<tr><td>S</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr181.gif"> </td></tr>
<tr><td>T</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>U</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>V</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>W</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr185.gif"> </td></tr>
<tr><td>X</td><td><img src="./images/8xpkeys/chr132.gif"> </td></tr>
<tr><td>Y</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Z</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>¡</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>prgm</td><td><img src="./images/8xpkeys/chr143.gif"> </td></tr>
<tr><td>Radian</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Degree</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> <img src="./images/8xpkeys/chr101.gif"> </td></tr>
<tr><td>Normal</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Sci</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Eng</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Float</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>=</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td><</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>></td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>˜</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>˘</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>¯</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>+</td><td><img src="./images/8xpkeys/chr195.gif"> </td></tr>
<tr><td>-</td><td><img src="./images/8xpkeys/chr185.gif"> </td></tr>
<tr><td>Ans</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr204.gif"> </td></tr>
<tr><td>Fix </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Horiz</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Full</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Func</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Param</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Polar</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Seq</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>IndpntAuto</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr112.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>IndpntAsk</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr112.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>DependAuto</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr112.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>DependAsk</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr112.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>–</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>—</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>“</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>*</td><td><img src="./images/8xpkeys/chr195.gif"> </td></tr>
<tr><td>/</td><td><img src="./images/8xpkeys/chr165.gif"> </td></tr>
<tr><td>Trace</td><td><img src="./images/8xpkeys/chr114.gif"> <img src="./images/8xpkeys/chr114.gif"> <img src="./images/8xpkeys/chr97.gif"> <img src="./images/8xpkeys/chr99.gif"> <img src="./images/8xpkeys/chr101.gif"> </td></tr>
<tr><td>ClrDraw</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>ZStandard</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>ZTrig</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>ZBox</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Zoom In</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Zoom Out</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>ZSquare</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>ZInteger</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>ZPrevious</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>ZDecimal</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>ZoomStat</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>ZoomRcl</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>PrintScreen</td><td></td></tr>
<tr><td>ZoomSto</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Text(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td> nPr </td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td> nCr </td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>FnOn </td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>FnOff </td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>StorePic </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>RecallPic </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>StoreGDB </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>RecallGDB </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>Line(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Vertical </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>Pt-On(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Pt-Off(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Pt-Change(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>Pxl-On(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>Pxl-Off(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>Pxl-Change(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>Shade(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>Circle(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>Horizontal </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr32.gif"> </td></tr>
<tr><td>Tangent(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr181.gif"> </td></tr>
<tr><td>DrawInv </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr173.gif"> <img src="./images/8xpkeys/chr32.gif"> </td></tr>
<tr><td>DrawF </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>rand</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>ƒ</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr155.gif"> </td></tr>
<tr><td>getKey</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>'</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>?</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr204.gif"> </td></tr>
<tr><td>˙</td><td><img src="./images/8xpkeys/chr204.gif"> </td></tr>
<tr><td>int(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>abs(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>det(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>identity(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>dim(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>sum(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>prod(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>not(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>iPart(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>fPart(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr161.gif"> </td></tr>
<tr><td>”(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>ln(</td><td><img src="./images/8xpkeys/chr181.gif"> </td></tr>
<tr><td>Î^(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr181.gif"> </td></tr>
<tr><td>log(</td><td><img src="./images/8xpkeys/chr171.gif"> </td></tr>
<tr><td>˝^(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr171.gif"> </td></tr>
<tr><td>sin(</td><td><img src="./images/8xpkeys/chr152.gif"> </td></tr>
<tr><td>sinÒ(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr152.gif"> </td></tr>
<tr><td>cos(</td><td><img src="./images/8xpkeys/chr153.gif"> </td></tr>
<tr><td>cosÒ(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr153.gif"> </td></tr>
<tr><td>tan(</td><td><img src="./images/8xpkeys/chr154.gif"> </td></tr>
<tr><td>tanÒ(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr154.gif"> </td></tr>
<tr><td>sinh(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr181.gif"> 25x<img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>sinhÒ(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr181.gif"> 26x<img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>cosh(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr143.gif"> 19x<img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>coshÒ(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr143.gif"> 20x<img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>tanh(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>tanhÒ(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>If </td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Then</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Else</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>While </td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>Repeat </td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>For(</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>End</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>Return</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr152.gif"> </td></tr>
<tr><td>Lbl </td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>Goto </td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>Pause </td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>Stop</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr153.gif"> </td></tr>
<tr><td>IS>(</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>DS<(</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> </td></tr>
<tr><td>Input </td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Prompt </td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Disp </td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>DispGraph</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>Output(</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>ClrHome</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>Fill(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>SortA(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>SortD(</td><td><img src="./images/8xpkeys/chr120.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>DispTable</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>Menu(</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr143.gif"> </td></tr>
<tr><td>Send(</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> </td></tr>
<tr><td>Get(</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>PlotsOn </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>PlotsOff </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>·</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> </td></tr>
<tr><td>Plot1(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Plot2(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Plot3(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>^</td><td><img src="./images/8xpkeys/chr155.gif"> </td></tr>
<tr><td>Õ</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>1-Var Stats </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>2-Var Stats </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>LinReg(ax+b) </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>ExpReg </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>LnReg </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>PwrReg </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>Med-Med </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>QuadReg </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>ClrList </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>ClrTable</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>Histogram</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>xyLine</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Scatter</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>LinReg(a+bx) </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>[A]</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>[B]</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>[C]</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>[D]</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>[E]</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>[F]</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>[G]</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>[H]</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>[I]</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>[J]</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>LÅ</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>LÇ</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>LÉ</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>LÑ</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>LÖ</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>LÜ</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>YÅ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>YÇ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>YÉ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>YÑ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>YÖ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>YÜ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>Yá</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>Yà</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>Yâ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>YÄ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>XÅ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>YÅ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>XÇ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>YÇ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>XÉ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>YÉ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>XÑ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>YÑ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>XÖ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>YÖ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>XÜ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>YÜ‘</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> </td></tr>
<tr><td>rÅ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>rÇ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>rÉ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>rÑ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>rÖ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>rÜ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>u</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>v</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>w</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>Pic1</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Pic2</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Pic3</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>Pic4</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>Pic5</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>Pic6</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>Pic7</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>Pic8</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>Pic9</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>Pic0</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>GDB1</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>GDB2</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>GDB3</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>GDB4</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>GDB5</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>GDB6</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>GDB7</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>GDB8</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>GDB9</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>GDB0</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>RegEq</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>n</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>À</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>∆x</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>∆x‹</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Sx</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>«x</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>minX</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>maxX</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>minY</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr89.gif"> </td></tr>
<tr><td>maxY</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>Ã</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>∆y</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>∆y‹</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>Sy</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>«y</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>∆xy</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>r</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>Med</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>QÅ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>QÉ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>a</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>b</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>c</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>d</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>e</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>xÅ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>xÇ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>xÉ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>yÅ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>yÇ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>yÉ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>÷</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr171.gif"> </td></tr>
<tr><td>p</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>z</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>t</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>‰‹</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>„</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>df</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>Í</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>ÍÅ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>ÍÇ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>ÀÅ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>SxÅ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr143.gif"> </td></tr>
<tr><td>nÅ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr153.gif"> </td></tr>
<tr><td>ÀÇ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> </td></tr>
<tr><td>SxÇ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr156.gif"> </td></tr>
<tr><td>nÇ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr154.gif"> </td></tr>
<tr><td>Sxp</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr152.gif"> </td></tr>
<tr><td>lower</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr155.gif"> </td></tr>
<tr><td>upper</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr161.gif"> </td></tr>
<tr><td>s</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>rÚ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>RÚ</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>df</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>SS</td><td></td></tr>
<tr><td>MS</td><td></td></tr>
<tr><td>df</td><td></td></tr>
<tr><td>SS</td><td></td></tr>
<tr><td>MS</td><td></td></tr>
<tr><td>ZXscl</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>ZYscl</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>Xscl</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>Yscl</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>ZU÷Start</td><td></td></tr>
<tr><td>ZV÷Start</td><td></td></tr>
<tr><td>Xmin</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Xmax</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Ymin</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>Ymax</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>Tmin</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Tmax</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>¡min</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>¡max</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>ZXmin</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>ZXmax</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>ZYmin</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>ZYmax</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>Z¡min</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>Z¡max</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>ZTmin</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>ZTmax</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>TblMin</td><td></td></tr>
<tr><td>÷Min</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>Z÷Min</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>÷Max</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>Z÷Max</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>÷Start</td><td></td></tr>
<tr><td>Z÷Start</td><td></td></tr>
<tr><td>æTbl</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr184.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Tstep</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>¡step</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>ZTstep</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>Z¡step</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>æX</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>æY</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>XFact</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>YFact</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>TblInput</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr184.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>‚</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>I%</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>PV</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>PMT</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>FV</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>Xres</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>ZXres</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>Sequential</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Simul</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>PolarGC</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>RectGC</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>CoordOn</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>CoordOff</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Connected</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Dot</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>AxesOn</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>AxesOff</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>GridOn</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>GridOff</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> <img src="./images/8xpkeys/chr102.gif"> <img src="./images/8xpkeys/chr102.gif"> </td></tr>
<tr><td>LabelOn</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>LabelOff</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Web</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Time</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>uvAxes</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>vwAxes</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>uwAxes</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Str1</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr172.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Str2</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr172.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Str3</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr172.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>Str4</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr172.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>Str5</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr172.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>Str6</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr172.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>Str7</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr172.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>Str8</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr172.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>Str9</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr172.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>Str0</td><td><img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr172.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>npv(</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>irr(</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>bal(</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>∆Prn(</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>∆Int(</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>ÂNom(</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> </td></tr>
<tr><td>ÂEff(</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr143.gif"> </td></tr>
<tr><td>dbd(</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr156.gif"> </td></tr>
<tr><td>lcm(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>gcd(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>randInt(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>randBin(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>sub(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr181.gif"> 37x<img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>stdDev(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>variance(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>inString(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr161.gif"> 7x<img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>normalcdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>normalpdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>tcdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>‰‹cdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>„cdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>binompdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>binomcdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>poissoncdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr143.gif"> </td></tr>
<tr><td>poissonpdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> </td></tr>
<tr><td>geometpdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr156.gif"> </td></tr>
<tr><td>geometcdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr152.gif"> </td></tr>
<tr><td>normalpdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>tpdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>‰‹pdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>„pdf(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>randNorm(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>tvm_Pmt</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>tvm_I%</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>tvm_PV</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>tvm_‚</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>tvm_FV</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>conj(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>real(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>imag(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>angle(</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>cumSum(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>expr(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr152.gif"> 9x<img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>length(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> 5x<img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>æList(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>ref(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>rref(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> </td></tr>
<tr><td>ÂRect</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>ÂPolar</td><td><img src="./images/8xpkeys/chr141.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>Î</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr152.gif"> </td></tr>
<tr><td>SinReg </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr32.gif"> </td></tr>
<tr><td>Logistic </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr32.gif"> </td></tr>
<tr><td>LinRegTTest </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr152.gif"> </td></tr>
<tr><td>ShadeNorm(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>Shade_t(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>Shade‰‹(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>Shade„(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr144.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>MatrÂlist(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>ListÂmatr(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr156.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>Z-Test(</td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>T-Test </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
<tr><td>2-SampZTest(</td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>1-PropZTest(</td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>2-PropZTest(</td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>‰‹-Test(</td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr143.gif"> </td></tr>
<tr><td>ZInterval </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>2-SampZInt(</td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>1-PropZInt(</td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>2-PropZInt(</td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> </td></tr>
<tr><td>GraphStyle(</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr155.gif"> </td></tr>
<tr><td>2-SampTTest </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> <img src="./images/8xpkeys/chr32.gif"> </td></tr>
<tr><td>2-Samp„Test  </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr194.gif"> <img src="./images/8xpkeys/chr32.gif"> <img src="./images/8xpkeys/chr32.gif"> </td></tr>
<tr><td>TInterval </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>2-SampTInt </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>SetUpEditor </td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr183.gif"> <img src="./images/8xpkeys/chr32.gif"> </td></tr>
<tr><td>Pmt_End</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr152.gif"> </td></tr>
<tr><td>Pmt_Bgn</td><td><img src="./images/8xpkeys/chr140.gif"> <img src="./images/8xpkeys/chr192.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr153.gif"> </td></tr>
<tr><td>Real</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>rÎ^¡‡</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>a+b‡</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>ExprOn</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>ExprOff</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>ClrAllLists</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr195.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>GetCalc(</td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>DelVar </td><td><img src="./images/8xpkeys/chr143.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr154.gif"> </td></tr>
<tr><td>EquÂString(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr152.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>StringÂEqu(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr181.gif"> 36x<img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Clear Entries</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr195.gif"> <img src="./images/8xpkeys/chr194.gif"> </td></tr>
<tr><td>Select(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>ANOVA(</td><td><img src="./images/8xpkeys/chr133.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr153.gif"> </td></tr>
<tr><td>ModBoxplot</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>NormProbPlot</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr111.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>GﬁT</td><td><img src="./images/8xpkeys/chr122.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr126.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>ZoomFit</td><td><img src="./images/8xpkeys/chr113.gif"> <img src="./images/8xpkeys/chr202.gif"> </td></tr>
<tr><td>DiagnosticOn</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>DiagnosticOff</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>Archive </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr195.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>UnArchive </td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr195.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>Asm(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>AsmComp(</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>AsmPrgm</td><td><img src="./images/8xpkeys/chr121.gif"> <img src="./images/8xpkeys/chr202.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr134.gif"> <img src="./images/8xpkeys/chr205.gif"> </td></tr>
<tr><td>a</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr141.gif"> </td></tr>
<tr><td>b</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr140.gif"> </td></tr>
<tr><td>c</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr143.gif"> </td></tr>
<tr><td>d</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr156.gif"> </td></tr>
<tr><td>e</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr152.gif"> </td></tr>
<tr><td>f</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr153.gif"> </td></tr>
<tr><td>g</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr154.gif"> </td></tr>
<tr><td>h</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr155.gif"> </td></tr>
<tr><td>i</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr161.gif"> </td></tr>
<tr><td>j</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr162.gif"> </td></tr>
<tr><td>k</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr163.gif"> </td></tr>
<tr><td>l</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr164.gif"> </td></tr>
<tr><td>m</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr165.gif"> </td></tr>
<tr><td>n</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr171.gif"> </td></tr>
<tr><td>o</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr172.gif"> </td></tr>
<tr><td>p</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr173.gif"> </td></tr>
<tr><td>q</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr174.gif"> </td></tr>
<tr><td>r</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr175.gif"> </td></tr>
<tr><td>s</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr181.gif"> </td></tr>
<tr><td>t</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr182.gif"> </td></tr>
<tr><td>u</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr183.gif"> </td></tr>
<tr><td>v</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr184.gif"> </td></tr>
<tr><td>w</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr185.gif"> </td></tr>
<tr><td>x</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr191.gif"> </td></tr>
<tr><td>y</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr192.gif"> </td></tr>
<tr><td>z</td><td><img src="./images/8xpkeys/chr131.gif"> <img src="./images/8xpkeys/chr193.gif"> </td></tr>
</table></div></div>

<?
  echo '</table>';
  include "bottom.php";
?>