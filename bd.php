<?php


if (mysql_connect("127.0.0.1","root","123")==false)
{
    exit("нет доступа к базе");
}
$bd=mysql_connect("127.0.0.1","root","123");
mysql_select_db("mondes",$bd);
mysql_query("SET NAMES 'cp1251'",$bd); 
$result=mysql_query("SELECT ip FROM nod_ip WHERE name='$dslam' ",$bd);
$myrow=mysql_fetch_array($result);

if ($myrow==false)
{
    
$result=mysql_query("SELECT ip FROM nod_ip WHERE node='$plata' ",$bd);
$myrow=mysql_fetch_array($result);
if ($myrow==false)
exit("Нет ip адреса в локальной базе данных!");
echo "<font color=\"red\">Взято по ноду</font><br>";
}
$ip=$myrow['0'];








//echo '<pre>';
//print_r($myrow);
//echo $myrow['0'];
//echo '/<pre>';


    
?>