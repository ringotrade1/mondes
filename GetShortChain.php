<?php
/*
  Получение линейной цепочки по номеру нагрузки
  методом GetShortChain сервиса ChainService.

  Для полноценной работы требуется веб-сервер с PHP 5 (лучше - PHP 5.2).
  В сборке PHP требуется библиотечка php_soap.dll (обычно находящаяся в подпапке ext).
  В php.ini раскомментировать строку extension=php_soap.dll.
  Средства Oracle не требуются.

  Для получения DSLAM и порта - провести разбор строки с цепочкой (см. комментраии ниже).

  Пример демонстрационный. Ошибочные ситуации не обрабатываются!
*/
?>
<?php

  // адрес описания сервиса
  $url = "http://astlo.ukrtelecom.net/RSNetGain-PL/ricoserver/ChainService.asmx?WSDL";

  // создание объекта клиента SOAP
  $client = new SoapClient($url, array("trace" => 1, "exceptions" => 1));

  // подготовка параметров метода GetShortChain сервиса

  // читаем значения параметров из GetShortChain.ini
 // $request = parse_ini_file("GetShortChain.ini");
  // или формируем массив параметров прямо тут
  $request = array("equipmentNo"=>"$number", "departmentId"=>3592, "zoneId"=>532, "equipmentType"=>8, "connectionType"=>0);
//565712

  $params["info"]["EquipmentInfo"] = (object) $request;

  // вызов метода GetShortChain сервиса
  $response = $client->GetShortChain($params);


  // обработка результата запроса

  // делаем массив из свойств объекта
  
    $result = @get_object_vars($response->GetShortChainResult->ChainInfo);
    if (@get_object_vars($response->GetShortChainResult->ChainInfo)==false)
 exit("<font size=\"4\" color=\"red\"><br>Нет значений по номеру $number, возможно НС</font>");
  // массив $result["chain"]->string собираем в строку и переводим ее в кодировку windows-1251
  // заменяя этой строкой $result["chain"]
  $result["chain"] = iconv("utf-8", "windows-1251", implode(";", $result["chain"]->string));

  // в итоге массив $result содержит ответ сервиса
 
/*
  foreach ($result as $field => $value)
  {
    echo $field .': <b>'. $value .'</b><br>';
  }

  // в $result["chain"] находится строка с линейной цепочкой
  // из которой можно извлечь DSLAM и порт (разбором строки)
/*  echo "<pre>";
	print_r($result);
  echo "</pre>";
 */ 
  // например, так
  preg_match("/([a-zA-Z0-9\-_]+)\)-(\d+)-(\d+)/", $result["chain"], $m);
  preg_match("/(\d*\.\d*\.\d*\.\d*)/", $result["chain"], $ip);
  
/*
  echo '<br>DSLAM: <b>'. $m[1] .'</b><br>';
  echo 'Slot: <b>'. $m[2] .'</b><br>';
  echo 'Port: <b>'. $m[3] .'</b><br>';
  echo 'Ip: <b>'. $ip[1] .'</b><br>';
   */ 
 

?>