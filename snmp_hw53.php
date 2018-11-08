<?php
echo "53T<br>";
if ($ip=="" OR $port=="" OR $plata=="")
{
exit("<font size=\"4\" color=\"red\">Нет порта или отсутствуют данные в АСТЛО по номеру $number</font>");
}
$comm="12mn4_ro";
    
$ports=($port*64+201326592)+(($plata)*65536);//53t


$profile = snmpget($ip, $comm,   ".1.3.6.1.2.1.10.94.1.1.1.1.4.".$ports);
if ($profile =="")
{
exit();
}


$snr_up = snmpget($ip, $comm,    ".1.3.6.1.2.1.10.94.1.1.2.1.4.".$ports);
$snr_up = ereg_replace("INTEGER:", $zamena, $snr_up);
$snr_up=round($snr_up /10);

$snr_down = snmpget($ip, $comm,  ".1.3.6.1.2.1.10.94.1.1.3.1.4.".$ports);
$snr_down = ereg_replace("INTEGER:", $zamena, $snr_down);
$snr_down=round($snr_down /10);  

$att_up = snmpget($ip, $comm,    ".1.3.6.1.2.1.10.94.1.1.2.1.5.".$ports); 
$att_up = ereg_replace("Gauge32:", $zamena, $att_up);
$att_up=round($att_up /10);  

$att_down = snmpget($ip, $comm,  ".1.3.6.1.2.1.10.94.1.1.3.1.5.".$ports); 
$att_down = ereg_replace("Gauge32:", $zamena, $att_down);
$att_down=round($att_down/10); 

$pow_up = snmpget($ip, $comm,    ".1.3.6.1.2.1.10.94.1.1.3.1.7.".$ports);
$pow_up = ereg_replace("INTEGER:", $zamena, $pow_up);
$pow_up=round($pow_up /10); 

$pow_down = snmpget($ip, $comm,  ".1.3.6.1.2.1.10.94.1.1.2.1.7.".$ports);
$pow_down = ereg_replace("INTEGER:", $zamena, $pow_down);
$pow_down=round($pow_down /10); 

$ds = snmpget($ip, $comm,        ".1.3.6.1.2.1.10.94.1.1.4.1.2.".$ports);
$ds = ereg_replace("Gauge32:", $zamena, $ds);
$ds=round($ds /1000); 

$us = snmpget($ip, $comm,        ".1.3.6.1.2.1.10.94.1.1.5.1.2.".$ports);
$us = ereg_replace("Gauge32:", $zamena, $us);
$us=round($us /1000); 

$max_ds = snmpget($ip, $comm,    ".1.3.6.1.2.1.10.94.1.1.2.1.8.".$ports); 
$max_ds = ereg_replace("Gauge32:", $zamena, $max_ds);
$max_ds=round($max_ds /1000); 

$max_us = snmpget($ip,$comm ,    ".1.3.6.1.2.1.10.94.1.1.3.1.8.".$ports); 
$max_us = ereg_replace("Gauge32:", $zamena, $max_us );
$max_us =round($max_us /1000);

$oper_stat = snmpget($ip, $comm, ".1.3.6.1.2.1.2.2.1.8.".$ports); 
$ven=snmpget($ip, $comm,         ".1.3.6.1.2.1.10.94.1.1.3.1.2.".$ports); 
$modem = snmpget($ip, $comm,     ".1.3.6.1.2.1.10.94.1.1.3.1.3.".$ports); 
?>