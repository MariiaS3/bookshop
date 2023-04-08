<?
$koszyk=$_COOKIE["koszyk"];
$id=$_GET["id"];
$ile=$_GET["ile"];
if ($ile<0) unset($ile);

function dodaj($koszyk,$id,$ile) {
  $zakupy = explode("|",$koszyk);
  for ($i=0;$i<count($zakupy)-1;$i++) {
    $p = explode("#",$zakupy[$i]);
    if ($p[0]==$id) {
      if (isset($ile)) $p[1]=$ile;
      else $p[1]++;
      $jest=true;
    }
    if ($p[1]>0) $nowy .= "$p[0]#$p[1]|";
  }
  if (!$jest) $nowy .= "$id#1|";
  return $nowy;
}

if ($id<>"") {
  $koszyk = dodaj($koszyk,$id,$ile);
  setcookie("koszyk", $koszyk, 0, "/");
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl"><head>
<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-2" />
<title>Koszyk</title></head><body>

<p>
Zawartość koszyka:
</p>

<?
echo "<table border=\"1\">";
echo "<tr align=\"center\"><td><b>id</b></td>
  <td><b>sztuk</b></td><td>&nbsp;</td>";
$zakupy = explode("|",$koszyk);
for ($i=0;$i<count($zakupy)-1;$i++) {
  $p = explode("#",$zakupy[$i]);
  echo "<tr><td valign=\"center\">$p[0]</td>";
  echo "<td><form action=\"index.php\" action=\"get\" style=\"display:inline;\">
  <input type=\"hidden\" name=\"id\" value=\"$p[0]\" />
  <input type=\"text\" name=\"ile\" value=\"$p[1]\" style=\"width:50px;\" />
  <input type=\"submit\" value=\" zmień \" style=\"80px;\" /></form></td>";
  echo "<td><form action=\"index.php\" action=\"get\" style=\"display:inline;\">
  <input type=\"hidden\" name=\"id\" value=\"$p[0]\" />
  <input type=\"hidden\" name=\"ile\" value=\"0\" />
  <input type=\"submit\" value=\" skasuj \" style=\"80px;\" /></form></td>";
  echo "</tr>";
}
echo "</table>";
echo "<p>
Wygląd koszyka w cookies:<br />$koszyk
</p>";
?>

<p>
Produkty do kupienia:
</p>
<a href="index.php?id=1">kup produkt 1</a> |
<a href="index.php?id=23">kup produkt 23</a> |
<a href="index.php?id=3">kup produkt 3</a> |
<a href="index.php?id=4">kup produkt 4</a> |
<a href="index.php?id=54">kup produkt 54</a> |
<a href="index.php?id=119">kup produkt 119</a> |

</body></html>