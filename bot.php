<?php
$error_flag = false;
$messege_chat_text = "";
$buff_errors = array();
$error_ansver_json = "";
$erors = array();
$TOKEN = "*************************************";
$CHAT_ID = "*************";

$obj = json_decode(file_get_contents('php://input'), true);

$name = htmlspecialchars($obj['form']['name']);
$phone = htmlspecialchars($obj['form']['phone']);
$emale = htmlspecialchars($obj['form']['email']);
$date = htmlspecialchars($obj['form']['date']);
$adr = htmlspecialchars($obj['form']['address']);
$comment = htmlspecialchars($obj['form']['comment']);
$days = htmlspecialchars($obj['order']['days']);
$price_for_day = htmlspecialchars($obj['order']['price']);
$price_for_all = htmlspecialchars($obj['order']['total']);
$type  = htmlspecialchars($obj['order']['type']);
$name2  = htmlspecialchars($obj['order']['name']);

	
if($name == "")
{
	$buff_errors["name"] = "Имя не задано";
	$error_flag = true;
}
if($adr == "")
{
	$buff_errors["adress"] = "Адрес на задан";
	$error_flag = true;
}
if(!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $emale))
{
	$buff_errors["email"] = "E-mail введён неверно";
	$error_flag = true;
}
if(!preg_match("/^\d\d\.\d\d\.\d{4,4}$/", $date))
{
	$buff_errors["date"] = "Дата введёна неверно";
	$error_flag = true;
}
if(!preg_match("/^(\+?)(\d{11,11})$/", $phone))
{
	$buff_errors["phone"] = "Номер введён неверно";
	$error_flag = true;
}

if(!$error_flag)
{
	$erors["success"] = true;
}
else
{
	$erors["success"] = false;
	$erors["errors"] = $buff_errors;
}

$error_ansver_json = json_encode($erors);


$messege_chat_text = "Имя: " . $name . "\n" .
					 "Номер телефона: " . $phone . "\n" .
					 "E-mail: " . $emale . "\n" .
					 "Дата доставки: " . $date . "\n" .
					 "Адрес доставки: " . $adr . "\n" ;

if($comment != "")
{
	$messege_chat_text = $messege_chat_text . "Коментарий: " . $comment . "\n";
}

$messege_chat_text = $messege_chat_text . "Количество дней: " . $days . "\n" .
										  "Стоимость за день: " . $price_for_day . "\n" .
										  "Итого: " . $price_for_all . "\n" . 
										  "Name: " . $name2 . "\n" . 
										  "Type: " . $type . "\n";


echo $error_ansver_json;

if(!$error_flag)
{
	$parameters = array('chat_id' => $CHAT_ID, 'text' => $messege_chat_text );
	$url = 'https://api.telegram.org/bot' . $TOKEN . '/sendMessage?' . http_build_query($parameters);
	$rez = file_get_contents($url);
}
die;
?>