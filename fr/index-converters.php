<?
  session_start();
  include "top.php";
?>

<script language="javascript">
<!--
function ShowHide(id) {
    obj = document.getElementsByTagName("div");
    if (obj[id].style.visibility == 'visible'){
    obj[id].style.visibility = 'hidden';
    }
    else {
    obj[id].style.visibility = 'visible';
    }
}
-->
</script>


  <h2>Online Decoders</h2>
  <div style="border: 1px solid gray; background-color: #F0F0F0; height: 40px;"><div style="padding-left: 8px;">
    <div style="float: left">
      <h3><a href="javascript://" onclick="ShowHide('83p_txt');"><img src="./images/extensions/89z.png"><img src="./images/extensions/txt.png">
      8XP / 83P to TXT</h3></a>
    </div>
    <div id="83p_txt" style="float: left; padding-top: 8px; padding-left: 15px; visibility: hidden;">
      <form enctype="multipart/form-data" action="83ptxtconverter.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        Choose a file to convert: <input name="userfile" type="file" />
        <input type="submit" value="Display File" />
      </form>
    </div>
    <br>
  </div></div>
  <br>
  <div style="border: 1px solid gray; background-color: #F0F0F0; height: 40px;"><div style="padding-left: 8px;">
    <div style="float: left">
      <h3><a href="javascript://" onclick="ShowHide('89t_txt');"><img src="./images/extensions/89t.png"><img src="./images/extensions/txt.png">
      89T / 92T / V2T to TXT</h3></a>
    </div>
    <div id="89t_txt" style="float: left; padding-top: 8px; padding-left: 15px; visibility: hidden;">
      <form enctype="multipart/form-data" action="89ttxtconverter.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        Choose a file to convert: <input name="userfile" type="file" />
        <input type="submit" value="Display File" />
      </form>
    </div>
    <br>
  </div></div>
  <br>
  <div style="border: 1px solid gray; background-color: #F0F0F0; height: 40px;"><div style="padding-left: 8px;">
    <div style="float: left">
      <h3><a href="javascript://" onclick="ShowHide('89t_html');"><img src="./images/extensions/89t.png"><img src="./images/extensions/html.png">
      89T / 92T / V2T to HTML - BETA</h3></a>
    </div>
    <div id="89t_html" style="float: left; padding-top: 8px; padding-left: 15px; visibility: hidden;">
      <form enctype="multipart/form-data" action="89thtmlconverter.php" method="post">
          <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
          Choose a file to convert: <input name="userfile" type="file" />
          <input type="submit" value="Display File" />
      </form>
    </div>
    <br>
  </div></div>
  <br>
  <div style="border: 1px solid gray; background-color: #F0F0F0; height: 40px;"><div style="padding-left: 8px;">
    <div style="float: left">
      <h3><a href="javascript://" onclick="ShowHide('89i_jpg');"><img src="./images/extensions/89i.gif"><img src="./images/extensions/jpg.png">
      89I / 92I / V2I to JPG / PNG / GIF</h3></a>
    </div>
    <div id="89i_jpg" style="float: left; padding-top: 8px; padding-left: 15px; visibility: hidden;">
      <form enctype="multipart/form-data" action="89ijpgconverter.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        Choose a file to convert: <input name="userfile" type="file" />
        <input type="submit" value="Display File" />
      </form>
    </div>
    <br>
  </div></div>
  <br>
  <h2>Online Encoders</h2>
  <div style="border: 1px solid gray; background-color: #F0F0F0; height: 40px;"><div style="padding-left: 8px;">
    <div style="float: left">
      <h3><a href="javascript://" onclick="ShowHide('txt_83p');"><img src="./images/extensions/txt.png"><img src="./images/extensions/89z.png">
      TXT to 83P / 8XP</h3></a>
    </div>
    <div id="txt_83p" style="float: left; padding-top: 8px; padding-left: 15px; visibility: hidden;">
      <form enctype="multipart/form-data" action="83pencoder.php" method="post">
        <input type="submit" value="Create a new file" /> <b>Or</b>
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        Open a text file: <input name="userfile" type="file" />
        <input type="submit" value="Open" />
      </form>
    </div>
    <br>
  </div></div>
  <br>
  <div style="border: 1px solid gray; background-color: #F0F0F0; height: 40px;"><div style="padding-left: 8px;">
    <div style="float: left">
      <h3><a href="javascript://" onclick="ShowHide('txt_89t');"><img src="./images/extensions/txt.png"><img src="./images/extensions/89t.png">
      TXT to 89T / 92T / V2T</h3></a>
    </div>
    <div id="txt_89t" style="float: left; padding-top: 8px; padding-left: 15px; visibility: hidden;">
      <form enctype="multipart/form-data" action="89tencoder.php" method="post">
        <input type="submit" value="Create a new file" /> <b>Or</b>
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        Open a text file: <input name="userfile" type="file" />
        <input type="submit" value="Open" />
      </form>
    </div>
    <br>
  </div></div>
  <br>
  <div style="border: 1px solid gray; background-color: #F0F0F0; height: 40px;"><div style="padding-left: 8px;">
    <div style="float: left">
      <h3><a href="javascript://" onclick="ShowHide('jpg_89i');"><img src="./images/extensions/jpg.png"><img src="./images/extensions/89i.gif">
      JPG / GIF / PNG to 89I / 92I / V2I</h3></a>
    </div>
    <div id="jpg_89i" style="float: left; padding-top: 8px; padding-left: 15px; visibility: hidden;">
      <form enctype="multipart/form-data" action="89iencoder.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        Open a text file: <input name="userfile" type="file" />
        <input type="submit" value="Convert" />
      </form>
    </div>
    <br>
  </div></div>
  <br>
<?
  include "bottom.php";
?>