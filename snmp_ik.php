<?php
echo "iskra<br>";
$comm="public";
	if ($ip=="" OR $port=="")
{
exit("<font size=\"4\" color=\"red\">Нет порта или ip из АСТЛО по номеру $number</font>");
}




$profile = snmpget($ip, $comm,   ".1.3.6.1.2.1.10.94.1.1.1.1.4.".$port);
$snr_up = snmpget($ip, $comm,    ".1.3.6.1.2.1.10.94.1.1.2.1.4.".$port);
$snr_down = snmpget($ip, $comm,  ".1.3.6.1.2.1.10.94.1.1.3.1.4.".$port);    
$att_up = snmpget($ip, $comm,    ".1.3.6.1.2.1.10.94.1.1.2.1.5.".$port); 
$att_down = snmpget($ip, $comm,  ".1.3.6.1.2.1.10.94.1.1.3.1.5.".$port); 
$pow_up = snmpget($ip, $comm,    ".1.3.6.1.2.1.10.94.1.1.3.1.7.".$port);
$pow_down = snmpget($ip, $comm,  ".1.3.6.1.2.1.10.94.1.1.2.1.7.".$port);
$ds = snmpget($ip, $comm,        ".1.3.6.1.2.1.10.94.1.1.4.1.2.".$port);
$us = snmpget($ip, $comm,        ".1.3.6.1.2.1.10.94.1.1.5.1.2.".$port);
$max_ds = snmpget($ip, $comm,    ".1.3.6.1.2.1.10.94.1.1.2.1.8.".$port); 
$max_us = snmpget($ip,$comm ,    ".1.3.6.1.2.1.10.94.1.1.3.1.8.".$port); 
$oper_stat = snmpget($ip, $comm, ".1.3.6.1.2.1.2.2.1.8.".$port); 
$ven=snmpget($ip, $comm,         ".1.3.6.1.2.1.10.94.1.1.3.1.2.".$port); 
$modem = snmpget($ip, $comm,     ".1.3.6.1.2.1.10.94.1.1.3.1.3.".$port); 

?>