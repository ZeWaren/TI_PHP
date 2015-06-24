<?
  session_start();
  $removetags = isset($_GET["removetags"]) ? $_GET["removetags"] : false;
  if (!$removetags)
    {
      header("HTTP/1.0 200 OK");
      header('Location: ./txtconverted/'.session_id().'.txt');
    }
  else
    {
      $text = file_get_contents('./txtconverted/'.session_id().'.txt');
      $sharp_tofind = array ("#1", "#2", "#3", "#U", '#E', '#V', "#W", "#I");
      $amp_tofind = array ("&C", "&=", "&-", "&L", '&R', '&,', '&;', '&.', '&E', '&P');
      $text = str_replace($sharp_tofind, '', $text);
      $text = str_replace($amp_tofind, '', $text);
      file_put_contents('./txtconverted/'.session_id().'_untagged.txt', $text);
      header("HTTP/1.0 200 OK");
      header('Location: ./txtconverted/'.session_id().'_untagged.txt');
    }
?>
