<?
  session_start();
  $page_title = "TI 85, TI 86";
  $meta_description = "A portal for TI 85, TI 86 File Conversions";
  $meta_keywords = "Texas Instrument TI 85 86";
  include "top.php";
?>
<a href="index.php">Retour au menu principal</a>
<table width="100%">
  <tbody>
    <tr>
      <td valign="top">
        <h2>TI-85 Plus, TI-86</h2>
        <div style="float: left; margin-right: 25px;">
          <div style="float: left">
            <a href="./images/calc-ti85.gif"><img width="98px" src="./images/calc-ti85.gif"></a>
          </div>
          <div style="float: left">
            <br>
            <b><font style="font-size: 130%">TI-85</font></b>
            <ul>
              <li>CPU: <font color="#555555">ZiLOG Z80 (6 MHz) </font></li>
              <li>Memory: <font color="#555555">28KB RAM</font></li>
              <li>Screen Size:<br> <font color="#555555">128x64 pixels,<br> 21x8 characters</font></li>
            </ul>
          </div>
        </div>
        <div style="float: left; margin-right: 40px;">
          <div style="float: left;">
            <a href="./images/calc-ti86.gif"><img width="95px" src="./images/calc-ti86.gif"></a>
          </div>
          <div style="float: left">
            <br>
            <b><font style="font-size: 130%">TI-86</font></b>
            <ul>
              <li>CPU: <font color="#555555">ZiLOG Z80 (6 MHz) </font></li>
              <li>Memory: <font color="#555555">96KB RAM</font></li>
              <li>Screen Size:<br> <font color="#555555">128x64 pixels,<br> 21x8 characters</font></li>
            </ul>
          </div>
        </div>
      </td>
      <td align="right" width="350px">
        <? $adsensetype="inline-rectangle"; include "../adsense.php"; ?>
      </td>
    </tr>
  </tbody>
</table>
<h2>Fichiers utilisés par cette calculette</h2>
  <table>
    <tr>
      <td></td>
      <td><b>Type</b></td>
      <td width="20px"></td>
      <td><b>Extensions</b></td>
      <td width="20px"></td>
      <td><b>Action</b></td>
    </tr>
    <tr>
      <td>
        <img src="./images/extensions/83c.gif">
      </td>
      <td>
        TIDataEditor Complex
      </td>
      <td></td>
      <td>
       86c
      </td>
      <td></td>
      <td>
        <a href="85c-86c-creator.php">Créer un nouveau</a>,
        <a href="85c-86c--txt-converter.php">En ouvrir un ou en convertir un en texte</a>
      </td>
    </tr>
    <tr>
      <td>
        <img src="./images/extensions/89d.gif">
      </td>
      <td>
        TI Connect Graph Database
      </td>
      <td></td>
      <td>
        86d
      </td>
      <td></td>
      <td>
<!--        <a href="83d-8xd-creator.php">Créer un nouveau</a>,
        <a href="83d-8xd--txt-converter.php">En ouvrir un ou en convertir un en texte</a> -->
      </td>
    </tr>
    <tr>
      <td>
        <img src="./images/extensions/89i.gif">
      </td>
      <td>
        TI Connect Image
      </td>
      <td></td>
      <td>
        8xi (compatible 83i)
      </td>
      <td></td>
      <td>
<!--        <a href="83i-8xi-creator.php">Créer un nouveau</a>,
        <a href="83i-8xi--jpg-png-gif-converter.php">En ouvrir un ou en convertir un en image</a> -->
      </td>
    </tr>
    <tr>
      <td>
        <img src="./images/extensions/89l.gif">
      </td>
      <td>
        TIDataEditor List
      </td>
      <td></td>
      <td>
        8xl (compatible 83l)
      </td>
      <td></td>
      <td>
<!--        <a href="83l-8xl-creator.php">Créer un nouveau</a>,
        <a href="83l-8xl--txt-converter.php">En ouvrir un ou en convertir un en texte</a> -->
      </td>
    </tr>
    <tr>
      <td>
        <img src="./images/extensions/89m.gif">
      </td>
      <td>
        TIDataEditor Matrix
      </td>
      <td></td>
      <td>
        8xm (compatible 83m)
      </td>
      <td></td>
      <td>
<!--        <a href="83m-8xm-creator.php">Créer un nouveau</a>,
        <a href="83m-8xm--txt-converter.php">En ouvrir un ou en convertir un en texte</a> -->
      </td>
    </tr>
    <tr>
      <td>
        <img src="./images/extensions/83c.gif">
      </td>
      <td>
        TI DataEditor Number
      </td>
      <td></td>
      <td>
        8xn (compatible 83n)
      </td>
      <td></td>
      <td>
<!--        <a href="83n-8xn-creator.php">Créer un nouveau</a>,
        <a href="83n-8xn--txt-converter.php">En ouvrir un ou en convertir un en texte</a> -->
      </td>
    </tr>
    <tr>
      <td>
        <img src="./images/extensions/89z.png">
      </td>
      <td>
        TI Connect Program
      </td>
      <td></td>
      <td>
        8xp (compatible 83p)
      </td>
      <td></td>
      <td>
<!--        <a href="83p-creator.php">Créer un nouveau</a>,
        <a href="83p-creator.php">Convertir un fichier texte</a>,
        <a href="83p--txt-converter.php">En ouvrir un ou en convertir un en texte</a>,    -->
      </td>
    </tr>
    <tr>
      <td>
        <img src="./images/extensions/89s.gif">
      </td>
      <td>
        TI Connect String
      </td>
      <td></td>
      <td>
        8xs (compatible 83s)
      </td>
      <td></td>
      <td>
<!--        <a href="83s-8xs-creator.php">Créer un nouveau</a>,
        <a href="83s-8xs--txt-converter.php">En ouvrir un ou en convertir un en texte</a> -->
      </td>
    </tr>
    <tr>
      <td>
        <img src="./images/extensions/83t.gif">
      </td>
      <td>
        TIConnect Table Settings
      </td>
      <td></td>
      <td>
        8xt (compatible 83t)
      </td>
      <td></td>
      <td>
<!--        <a href="83t-8xt-creator.php">Créer un nouveau</a>,
        <a href="83t-8xt--txt-converter.php">En ouvrir un ou en convertir un en texte</a> -->
      </td>
    </tr>
<!--    <tr>
      <td>
        <img src="./images/extensions/89y.gif">
      </td>
      <td>
        TI Application Variable
      </td>
      <td></td>
      <td>
        8xv (compatible 83v)
      </td>
      <td></td>
      <td></td>
    </tr>-->
    <tr>
      <td>
        <img src="./images/extensions/83t.gif">
      </td>
      <td>
        TIConnect Window Settings
      </td>
      <td></td>
      <td>
        8xw (compatible 83w)
      </td>
      <td></td>
      <td>
<!--        <a href="83w-8xw-creator.php">Créer un nouveau</a>,
        <a href="83w-8xw--txt-converter.php">En ouvrir un ou en convertir un en texte</a>  -->
      </td>
    </tr>
    <tr>
      <td>
        <img src="./images/extensions/89f.gif">
      </td>
      <td>
        TI Connect Equation
      </td>
      <td></td>
      <td>
        8xy (compatible 83y)
      </td>
      <td></td>
      <td>
<!--        <a href="83y-8xy-creator.php">Créer un nouveau</a>,
        <a href="83y-8xy--txt-converter.php">En ouvrir un ou en convertir un en texte</a> -->
      </td>
    </tr>
    <tr>
      <td>
        <img src="./images/extensions/83t.gif">
      </td>
      <td>
        TIConnect UserWinZoom
      </td>
      <td></td>
      <td>
        8xz (compatible 83z)
      </td>
      <td></td>
      <td>
<!--        <a href="83z-8xz-creator.php">Créer un nouveau</a>,
        <a href="83z-8xz--txt-converter.php">En ouvrir un ou en convertir un en texte</a> -->
      </td>
    </tr>
  </table>

<?
  include "bottom.php";
?>