<?
  session_start();

  $onti_filename = isset($_SESSION["onti_filename"]) ? $_SESSION["onti_filename"] : 'untitled';
  $onti_folder = isset($_SESSION["onti_folder"]) ? $_SESSION["onti_folder"] : 'main';
  $onti_comment = isset($_SESSION["onti_comment"]) ? $_SESSION["onti_comment"] : 'Encod� par ti.zewaren.net';
  $onti_calctype = isset($_SESSION["onti_calctype"]) ? $_SESSION["onti_calctype"] : '89';
  $onti_text = isset($_SESSION["onti_text"]) ? $_SESSION["onti_text"] : "";
  $onti_storetype = isset($_SESSION["onti_storetype"]) ? $_SESSION["onti_storetype"] : 'RAM';

  $encode_type = isset($_GET["type"]) ? $_GET["type"] : "txt";
  if ($encode_type == "txt" || $encode_type == "txtnoheader")
    {
       $str="";
         if ($encode_type != "txtnoheader")
           {
             $str .= "Nom de la variable:  ".$onti_filename;
             $str .= "\r\nCommentaire:".$onti_comment;
             $StoreType = "Unknown";
             $StoreType = $onti_storetype == "RAM" ? 'RAM' : $StoreType;
             $StoreType = $onti_storetype == "ARCHIVE" ? 'Archive' : $StoreType;
             $str .= "\r\nStockage: ".$StoreType;
             $str .= "\r\n------\r\n";
           }
       $str .= $onti_text;
       $final_filename = "$onti_folder"."-"."$onti_filename".".tizw.txt";
       header('Content-type: text/plain');
       header('Content-Disposition: attachment; filename="'.$final_filename.'"');
       header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
       echo $str;
    }
  else if ($encode_type == "83p")
    {
      $final_filename = "$onti_filename".".tizw.8xp";

         for ($i=0; $i<74; $i++)
           $entete[$i] = 0;
           
       $entete[0] = Ord('*');
       $entete[1] = Ord('*');
       $entete[2] = Ord('T');
       $entete[3] = Ord('I');
       $entete[4] = Ord('8');
       $entete[5] = Ord('3');
       $entete[6] = Ord('F');
       $entete[7] = Ord('*');
       $entete[8] = 26;
       $entete[9] = 10;
       $entete[10] = 0;

      $onti_comment=substr($onti_comment.str_repeat(chr(0), 40), 0, 40);
        for ($i=11; $i<11+40; $i++)
          $entete[$i] = ord($onti_comment[$i-11]);

      $onti_text = tokenise('\r'.$onti_text."\r", false, true, true);
      $onti_text = substr($onti_text, 3);

      $entete[53] = (19 + strlen($onti_text)) % 256;
      $entete[54] = (19 + strlen($onti_text)) / 256;

      $entete[55] = 13;
      $entete[56] = 0;

      $entete[57] = (strlen($onti_text)+2) % 256;
      $entete[58] = (strlen($onti_text)+2) / 256;

      $entete[59] = 5; //Program

      $onti_filename=substr($onti_filename.str_repeat(chr(0), 8), 0, 8);
      for ($i=60; $i<60+8; $i++)
        $entete[$i] = ord($onti_filename[$i-60]);

      $entete[69] = $onti_storetype == 'RAM' ? 0 : 128;

      $entete[70] = (strlen($onti_text) + 2) % 0xFF;
      $entete[71] = (strlen($onti_text) + 2) / 0xFF;

      $entete[72] = (strlen($onti_text)) % 0xFF;
      $entete[73] = (strlen($onti_text)) / 0xFF;
/*

  header[70] := (length(BufferString)+2) mod 256;
  header[71] := (length(BufferString)+2) div 256;

  header[72] := (length(BufferString)) mod 256;
  header[73] := (length(BufferString)) div 256;*/

      $handle=fopen(session_id().'.dat', "wb");

      $entete_length = count($entete);
      for ($i=0; $i<$entete_length; $i++)
        fwrite($handle, chr($entete[$i]));

      $checksum = 0;
        for ($i=0; $i<strlen($onti_text); $i++)
          {
            $checksum += ord($onti_text[$i]);
            fwrite($handle, $onti_text[$i]);
          }
        for ($i=55; $i<74; $i++)
          $checksum += $entete[$i];
//      $checksum--;    
      fwrite($handle, Chr($checksum & 0xFF));
      fwrite($handle, Chr(($checksum >> 8) & 0xFF));

      fclose($handle);

      header( 'Content-Type: application/octet-stream' );
      header('Content-Disposition: attachment; filename="'.$final_filename.'"');
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      readfile(session_id().'.dat');      
      /*
  CheckSum := 0;
    for i := 1 to length(BufferString) do
      begin
        BufferByte := Ord(BufferString[i]);
        CheckSum := CheckSum + BufferByte;
        FS.Write(BufferByte, sizeof(BufferByte));
      end;
    for i := 55 to 73 do
      CheckSum := CheckSum + header[i];

  BufferByte := CheckSum mod 256;
  FS.Write(BufferByte, SizeOf(BufferByte));
  BufferByte := ((CheckSum-BufferByte) div 256) mod 256;
  FS.Write(BufferByte, SizeOf(BufferByte));
      */

      //TABLE HEXA
/*      $handle = fopen(session_id().'.dat', "rb");
      echo '<h1>File Hexa</h1><br>';
      fseek($handle,0);
      $count=0;
      echo '<hr><table style="font-size:small;"><tr>';
        while (!feof($handle))
        {
          $contents = fread($handle, 1);
          $contents=strtoupper(dechex(ord($contents)));
            if (strlen($contents)==1)
              $contents='0'.$contents;
          echo '<td>'.$contents.'<font color="gray">('.chr(hexdec($contents)).')</font></td>';
          $count++;
            if ($count==8 || $count==16 || $count==24)
              {
                echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>';
              }
            else if ($count==32)
              {
                echo '</tr><tr>';
                $count=0;
              }
        }
      echo '</tr></table>';*/   

    }
  else
    {
      echo 'Nothing has been done';
    }

function tokenise($ascstr, $as_plain_text, $lowercase_has_priority, $case_sensitive)
{
  if ($as_plain_text)
    {
      $ascstr = Tokens($ascstr, false, $lowercase_has_priority, 0);
      $ascstr = Tokens($ascstr, true, $lowercase_has_priority, $case_sensitive ? 1 : 0);
    }
  else
    {
      $ascstr = Tokens($ascstr, true, $lowercase_has_priority, $case_sensitive ? 1 : 0);
      $ascstr = Tokens($ascstr, false, $lowercase_has_priority, 0);
    }
  $ascstr = str_replace(chr(38),'',$ascstr);
  $ascstr = str_replace('�','',$ascstr);
  return $ascstr;
}

function Tokens($astr, $longtoken, $lcp, $cs)
{
    $tokens = fopen("ti83tokens.dat", "rb");
    fseek($tokens, 0);
    for ($i=0; $i<filesize("ti83tokens.dat") / 16; $i++)
      {
        fseek($tokens, $i*16);
          for ($j=0; $j<16; $j++)
            {
               $MP[$i][$j] = ord(fread($tokens, 1));
//               echo "'".$MP[$i][$j].'"';
            }
      }
    fclose($tokens);
    $cChar = "";
    $bytecnt = -1;
    $twobyte = 0;
    $tableindex = -1;
    while (true)
    {
      $tableindex++;
        if ($tableindex > count($MP)-1)
          return $astr;
      $BS = '';
      for ($i=0; $i<count($MP[$tableindex]); $i++)
        if ($MP[$tableindex][$i] > 0xF)
          $BS .= chr($MP[$tableindex][$i]);
      $bytecnt++;
      $d = $BS;
        if ($d == "")
          return $astr;
        else if ($d == chr(38).'$black')
          continue;

        if ($longtoken)
          {
            if (strlen($d) == 1)
              continue;
          }
        else if ( (strlen($d) > 1) && ($d[0] != chr(38)) )
          continue;
        if ($lcp && (strlen($d) == 1) && (ord($d[0]) > 96) && (ord($d[0]) < 123) && $twobyte <> 187)
          continue;                     


        if ( strlen($d) > 1 && ord($d[0]) == 38 && $d[1]=='!' )
          {
            $twobyte = substr($d, 2);
            $bytecnt = -1;
            continue;
          }
      $cChar = Chr($bytecnt);
        if ($twobyte > 0)
          $cChar = chr($twobyte) . $cChar;
        if ($d == Chr(38).'#CRLF')
          $astr = ReplaceStrb($astr, "", $cChar.'�');
        else
          {
            $pos = -1;
            while (true)
              {
                $pos = InStr($pos+2, $astr, $d, $cs);
                $pos = $pos == false ? 0 : $pos;
                  if ($pos==0)
                    break;
                $s1 = InStrRev($astr, '�', $pos);
                $s2 = InStrRev($astr, chr(38), $pos);
                  if ($s1 > $s2 || $s2==0)
                    $astr = substr($astr, 0, $pos) . chr(38) . $cChar . "�" . substr($astr, $pos+strlen($d));
              }
          }

//      echo $BS.'<br>';
    }
/*
        pos := -1;
        repeat
          pos := InStr(pos+2, astr, d, cs);
            if pos = 0 then
              Break;
          s1 := InStrRev(astr, '�', pos);
          s2 := InStrRev(astr, Chr(38), pos);
          if (s1 > s2) or (s2=0) then
            astr := copy(astr, 1, pos - 1) + Chr(38)+ cChar + '�' + copy(astr, pos+length(d), length(astr)-pos-length(d)+1);
        until false;
      end;

  goto Beginning;
lEnd:

*/
}

/*function Tokens(astr : string; longtoken : boolean; lcp : boolean; cs : integer) : string;*/

function PosA($input, $poswhat)
{
  for ($i=0; $i<count($input); $i++)
    {
      $buffer_boolean = true;
      if ($i+strlen($poswhat) > count($input))
        return 0;
      for ($j=0; $j<strlen($poswhat); $j++)
        {
          if ($input[$i+$j] != ord($poswhat[$j]))
            $buffer_boolean=false;
        }
      if ($buffer_boolean)
        return $i;
    }
  return 0;
}

function ReplaceStrb($input, $search, $replacebywhat)
{
  $i=0;
  $bresult = "";
    while($i<strlen($input))
    {
      if (ord($input[$i]) == 13)
        {
          $bresult .= chr(38).$replacebywhat;
          $i++;
        }
      else
        $bresult .= $input[$i];
      $i++;
    }
  return $bresult;
}

/*
  function ReplaceStrb(input : string; search : string; replacebywhat : string) : string;
  var
    i : word;
    bresult : string;
    BufferString: string;
  begin
    i := 1;
    bresult := '';
    repeat
      if (Ord(input[i]) = 13) then
        begin
          bresult := bresult + Chr(38)+ replacebywhat;
          inc(i);
        end
      else
        bresult := bresult + input[i];
      inc(i);
    until i > length(input);
    result := bresult;
  end;
*/

function InStr($start, $string1, $string2, $comparemethode=0)
{
  if ($start > strlen($string1))
    return 0;
  if ($comparemethode==0)
    $bresult = strpos($string1, $string2, $start);
  else
    $bresult = strpos(strtolower($string1), strtolower($string2), $start);

  return $bresult;
}

/*
function InStr( start : integer; string1, string2 : string; comparemethode : byte = 0) : integer;
begin
  Result := 0;
  if start > length(string1) then
    Exit;
  if comparemethode = 0 then
    result := system.Pos(string2, copy(string1, start, length(string1)-start))
  else
    result := system.Pos(Lowercase(string2), lowercase(copy(string1, start, length(string1)-start)));
  if Result > 0 then
    Result := Result + start - 1;
//  Result := Result + start - start;
end;
*/

function InStrRev($sCheck, $sMatch, $start=-1, $Compare=0)
{
  $bresult = 0;
  $lensearchfor = strlen($sMatch);
  if ($lensearchfor > 0)
    {
      if ($start <= 0)
        $start = strlen(sCheck);
        while (true)
          {
            $posFound = InStr($bresult+2, $sCheck, $sMatch, $Compare);
              if ($posFound > 0 && ($posFound + $lensearchfor - 1 <= $start))
                $bresult = $posFound;
              else
                return $bresult;
          }
    }
  else
    {
      if ($start <= strlen(sCheck))
        return $start;
    }
  return 0;  
}

/*
function InStrRev( sCheck : string; sMatch : string; start : longint = -1; Compare : byte = 0) : integer;
var
  lenSearchFor : word;
  posFound : word;
begin
  result := 0;
  lenSearchFor := length(sMatch);
  if lenSearchFor > 0 then
    begin
      if start <= 0 then
        start := length(sCheck);
      repeat
        posFound := InStr(result+2, scheck, smatch, compare);
        if (posFound > 0) and (posFound + lenSearchFor -1 <= start) then
          Result := posFound
        else
          Exit;
      until false;
    end
  else
    begin
      if start <= Length(sCheck) then
        Result := start;
    end;
end;
*/
?>