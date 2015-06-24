<html>
<body>
<?
  echo '<table>';
  for ($i=0; $i<255; $i++)
    {
      echo '<tr><td>'.$i.'</td><td>'.strtoupper(dechex($i)).'</td><td><font face="TI-83 Symbols">'.chr($i).'</font></td></tr>';
    }
  echo '</table>';
?>
</body>
</html>
