
<table border="1">
<?php

/*
Скрипт для работы с оборудованием DSLAM на сети Укртелеком
Скрипт отображает характеристики порта АDSL

 */
$priv = $_GET['priv'];
echo $_GET['priv'];

$number=$_GET['tel'];
echo <<<HERE
<form action="index.php" method="GET" >
 Номер телефона/НС: <input type="text" name="tel" value="$number"/>
 <input type="submit">
 <br>
 <br>
HERE;

// Сбор и обработка ошибок
//	function Error($num) {
//		   switch ($num) {
//		case 1: echo '<br />[PHP Telnet] <a href="http://www.geckotribe.com/php-telnet/errors/fsockopen.php">Connect failed: Unable to open network connection</a><br />'; break;
//		case 2: echo '<br />[PHP Telnet] <a href="http://www.geckotribe.com/php-telnet/errors/unknown-host.php">Connect failed: Unknown host</a><br />'; break;
//		case 3: echo '<br />[PHP Telnet] <a href="http://www.geckotribe.com/php-telnet/errors/login.php">Connect failed: Login failed</a><br />'; break;
//		case 4: echo '<br />[PHP Telnet] <a href="http://www.geckotribe.com/php-telnet/errors/php-version.php">Connect failed: Your server\'s PHP version is too low for PHP Telnet</a><br />'; break;
//		}
//	}
//
//
if ($_SERVER['REMOTE_ADDR'] == "10.27.2.223")
{
$privet = $priv;  
}


if (empty($number))
exit("Программа работает в тестовом режиме!!!");


require ("GetShortChain.php");


          
//  echo '<br>DSLAM: <b>'. $m[1] .'</b><br>';
//  echo 'Slot: <b>'. $m[2] .'</b><br>';
//  echo 'Port: <b>'. $m[3] .'</b><br>';
//  echo 'Ip: <b>'.   $ip[1] .'</b><br>';

$dslam=$m[1];
$plata=$m[2];
$port=$m[3];
$ip=$ip[1];



function rep($qq)
{
$zamena="";
$qq = ereg_replace('"', $zamena, $qq);
$qq = ereg_replace("Gauge32:", $zamena, $qq);
$qq = ereg_replace("INTEGER:", $zamena, $qq);
$qq = ereg_replace("STRING:", $zamena, $qq);
echo $qq;
}


if($ip=="192.168.212.121"  OR $ip=="192.168.212.148" OR $ip=="192.168.212.149" OR $ip=="192.168.212.122")
{ echo '<br>DSLAM: <b>'. $m[1] .'</b><br>';
  echo 'Slot: <b>'. $m[2] .'</b><br>';
  echo 'Port: <b>'. $m[3] .'</b><br>';
  echo 'Ip: <b>'.   $ip .'</b><br>';
  echo "<font size=\"4\" color=\"red\"> На данный момент DSLAM HiFocus не обрабатывается!!!</font><br>";
}
 else
 {
if ($plata>80)
{
 include ("bd.php");

 
 //прверить на айпи
 
include("snmp_ik.php");
}
    else
    {
    if($ip=="192.168.208.241" OR $ip=="192.168.208.242" OR $ip=="192.168.208.243" OR $ip=="192.168.208.244" OR $ip=="192.168.208.245")
    {
    include("snmp_hw53.php");
        }
        else
        {
        include("snmp_hw56.php");
         }
            }
}

if($oper_stat=='INTEGER: up(1)')
{
$text = "


<tr>
<td>DSLAM </td>
<td>$dslam <font size=\"4\" color=\"red\"> $privet </font> </td> 
</tr>



<tr>
<td>IP </td>
<td>$ip  </td>
</tr>


<tr>
<td>Плата:</td>
<td>$plata </td>
</tr>

<tr>
<td>Порт:</td>
<td>$port </td>
</tr>

<td>Профайл:</td>
<td>$profile </td>
</tr>

<tr>
<td>Текущая скорость DS:</td>
<td>$ds kbit/s</td>
</tr>

<tr>
<td>Текущая скорость US:</td>
<td>$us kbit/s</td>
</tr>



<tr>
<td>Сигнал/шум DS:</td>
<td>$snr_down  dB</td>
</tr>


<tr>
<td >Сигнал/шум US:</td>
<td>$snr_up  dB</td>
</tr>



<tr>
<td>Затухание DS :</td>
<td>$att_down  dB</td>
</tr>

<tr>
<td>Затухание US :</td>
<td>$att_up  dB</td>
</tr>


<tr>
<td>Максимальный DS:</td>
<td>$max_ds kbit/s</td>
</tr>

<tr>
<td>Максимальный US:</td>
<td>$max_us kbit/s</td>
</tr>

<tr>
<td>Выходная мощность DS:</td>
<td>$pow_down   dB</td>
</tr>

<tr>
<td>Входная мощность US:</td>
<td>$pow_up   dB</td>
</tr>


<tr>
<td>Статус порта:</td>
<td>Порт активный $oper_stat</td>
</tr>

<tr>
<td>Modem:</td>
<td>$modem</td>
</tr>

";

rep($text);


}


else 
{
$text="


<tr>
<td>DSLAM </td>
<td>$dslam </td>

</tr>


<tr>
<td>IP </td>
<td>$ip </td>
</tr>

<tr>
<td>Плата:</td>
<td>$plata </td>
</tr>


<tr>
<td>Порт: </td>
<td>$port </td>
</tr>


<td>Профайл: </td>
<td>$profile </td>
</tr>
<tr>
<td>Статус порта: </td>
<td>Порт не активный $oper_stat </td>
</tr>



";
rep($text);
}
//if ($plata>80)
// include ("telnet.php");


?>

<td width="50px" border="0">Нормы</td>
<td>
<strong>Первичные параметры:</strong><br>
&nbsp&nbsp* Сопротивление шлейфа — не более 1000 Ом<br>
&nbsp&nbsp* Сопротивление изоляции — не менее 40 МОм<br>
&nbsp&nbsp* Ёмкость шлейфа — не более 300 нФ<br>
&nbsp&nbsp* Ёмкостная асимметрия — не более 10 нФ, или не более 5 %<br>
<br>
<strong>SNR Margin (Signal-to-Noise Ratio(SNR)):</strong><br>
&nbsp&nbsp* менее 6 dB - плохая линия, присутствуют проблемы синхронизации<br>
&nbsp&nbsp* от 7 dB до 10 dB - возможны сбои<br>
&nbsp&nbsp* от 11 dB до 20 dB - нормальная линия, без проблем с синхронизацией<br>
&nbsp&nbsp* от 20 dB и выше -  хорошая линия<br>
<br>
<strong>Затухание сигнала (Line Attenuation):</strong><br>
&nbsp&nbsp* до 20 dB — отличная линия<br>
&nbsp&nbsp* от 20 dB до 40 dB — рабочая линия<br>
&nbsp&nbsp* от 40 dB до 50 dB — возможны сбои<br>
&nbsp&nbsp* от 50 dB до 60 dB — периодически пропадает синхронизация<br>
&nbsp&nbsp* от 60 dB и выше — оборудование работать не будет<br>

</td>
</tr>
