<?php
session_start();
$div_authoriz_visible = "visible";
$div_choise_visible = "hidden";
$div_registr_visible = "visible";

$flag_registration = false;
$flag_authorization = false;

////////////////////////////////////////////////////////////////// erors
$eror_name_text ="";
$eror_surname_text ="";
$eror_nick_text = "";
$eror_mail_text= "";
$eror_pasword_text = "";
$eror_pasword_text_reped = "";
$eror_login_text = "";
$eror_ath_pasword_text = "";
$eror = false;
///////////////////////////////////////////////////////////////////



if(isset($_POST["authorization_button"]))
{
	//$flag_authorization = true;
	$_SESSION["authorization_button"] = true;
}
if(isset($_POST["registration_button"]))
{
	//$flag_registration = true;
	$_SESSION["registration_button"] = true;
}
if(isset($_POST["return_a"]) || isset($_POST["return_r"]))
{
	//$flag_authorization = false;
	$_SESSION["authorization_button"] = false;
	//$flag_registration = false;
	$_SESSION["registration_button"] = false;
}


if(isset($_POST["end_regist_button"]))
{
	$name_text = htmlspecialchars( $_POST["name_text"]);
	$surname_text = htmlspecialchars( $_POST["surname_text"]);
	$nick_text = htmlspecialchars( $_POST["nick_text"]);
	$mail_text = htmlspecialchars( $_POST["mail_text"]);
	$pasword_text = htmlspecialchars( $_POST["pasword_text"]);
	$pasword_text_reped = htmlspecialchars( $_POST["pasword_text_reped"]);
	
	$_SESSION["name_text"] = $name_text;
	$_SESSION["surname_text"] = $surname_text;
	$_SESSION["nick_text"] = $nick_text;
	$_SESSION["mail_text"] = $mail_text;
	//n $_SESSION["pasword_text"] = $pasword_text;
	//$_SESSION["pasword_text_reped"] = $pasword_text_reped;
	
	if($name_text == "" || strlen($name_text) < 2 || preg_match("/ /", $name_text) )
	{
		$eror_name_text = "enter correct name ";
		$eror = true;
	}
	if($surname_text == "" || strlen($surname_text) < 2 || preg_match("/ /", $surname_text))
	{
		$eror_surname_text = "enter correct surname";
		$eror = true;
	}
	if($nick_text == ""  || strlen($nick_text) < 2 || preg_match("/ /", $nick_text))
	{
		$eror_nick_text = "enter correct login";
		$eror = true;
	}
	if($mail_text == ""  || strlen($mail_text) < 5 || !preg_match("/@/", $mail_text))
	{
		$eror_mail_text = "enter correct mail";
		$eror = true;
	}
	if($pasword_text == "")
	{
		$eror_pasword_text = "enter password";
		$eror = true;
	}
	if($pasword_text_reped != $pasword_text)
	{
		$eror_pasword_text_reped = "enter correct password";
		$eror = true;
	}
	if(!$eror)
	{
		$message = "you are registered on the site";
		$adresat = $mail_text ;
		$tema = "site registration";
		$tema = "=?utf-8?B?" . base64_encode($tema) . "?=";// ПРЕОБРАЗОВАНИЕ ТЕМЫ К ПРАВИЛЬНОМУ ФОРМАТУ, ЧТО БЫ МЕССЕДЖЕРЫ СМОГЛИ ЕЁ ПОНЯТЬ.
		$from = "site@gmail.com";
		$headers = "From: $from\r\nReply-to: $from \r\nContent-type: text/plain; charset=utf-8\r\n";
		//mail($adresat, $tema, $message, $headers);
	}
}

if(isset($_POST["enter_butt"]))
{
	$login_text = htmlspecialchars($_POST["login_text"]);
	$ath_pasword_text = htmlspecialchars($_POST["ath_pasword_text"]);
	
	
	if($login_text == ""  || strlen($login_text) < 5 || !preg_match("/ /", $login_text))
	{
		$eror_login_text = "enter correct mail";
		$eror = true;
	}
	/* здесь будет проверка пароля из базы данных............................................................
	if($ath_pasword_text == "")
	{
		$eror_pasword_text = "enter password";
		$eror = true;
	}
	*/
	//header("Location:  АДРЕС_СТРАНИЦЫ");
	
}



$flag_authorization = $_SESSION["authorization_button"];
$flag_registration = $_SESSION["registration_button"];
?>

<script>
var a =  '<?php echo $flag_authorization; ?>';
var a1 =  '<?php echo $flag_registration; ?>';
function press_registration()
{
	document.getElementById("divregist").style.visibility = '<?php echo $div_registr_visible; ?>';
	document.getElementById("divchoise").style.visibility =  '<?php echo $div_choise_visible; ?>';
}
function press_authorization()
{
	document.getElementById("divchoise").style.visibility = '<?php echo $div_choise_visible; ?>';	
	document.getElementById("divauthorization").style.visibility = '<?php echo $div_authoriz_visible; ?>';
	document.getElementById("divregist").style.display = "none";
}
</script>

<DOCTYPE  html>

<html>
<head>
	<title> авторизация </title>
</head>
<style>
#divregist{
visibility: collapse;
}

#divauthorization

{
visibility: collapse;
}

</style>
<body>

<div id="divchoise" align="center" {display: none;}>
	<form name="choice"  action="" method="post" >
		<input class="butt" type="submit"  name="authorization_button" value="enter in cab"    / > 
		<input class="butt" type="submit"  name="registration_button"  value="registration"  style="margin-left: 10"  /> 
	</form>
</div>


  
  
<div id="divregist" align="left" name="div_regist" >
	<form name="registration_form" action="" method="post">
		<label> name </label> <br/>
		<input type="text" class="text_feeld" name="name_text" value="<?php echo $_SESSION["name_text"];?>" placeholder="name"/>
		<span style="color:red" > <?php echo $eror_name_text;?></span>
		<br/>
		
		<label> surname </label> <br/>
		<input type="text" class="text_feeld" name="surname_text" value="<?php echo $_SESSION["surname_text"];?>" placeholder="surname"/>
		<span style="color:red" > <?php echo $eror_surname_text;?></span>
		<br/>
		
		<label> nick </label> <br/>
		<input type="text" class="text_feeld" name="nick_text" value="<?php echo $_SESSION["nick_text"];?>" placeholder="nick"/>
		<span style="color:red" > <?php echo $eror_nick_text;?></span>
		<br/>
		
		<label> mail </label> <br/>
		<input type="text" class="text_feeld" name="mail_text" value="<?php echo $_SESSION["mail_text"];?>" placeholder="mail"/>
		<span style="color:red" > <?php echo $eror_mail_text;?></span>
		<br/>
		
		<label> pasword </label> <br/>
		<input type="password" class="text_pasword" name="pasword_text"  placeholder="pasword"/>
		<span style="color:red" > <?php echo $eror_pasword_text;?></span>
		<br/>
		
		<label>reped pasword </label> <br/>
		<input type="password" class="text_pasword" name="pasword_text_reped" placeholder="reped pasword"/>
		<span style="color:red" > <?php echo $eror_pasword_text_reped;?></span>
		<br/>
		
		<input class="butt" type="submit" name="end_regist_button" value="register"/>
		
		<input class="butt" type="submit" name="return_r" value="return" style="margin-left: 10" /> <br/>
		
	</form>
</div>


<div id="divauthorization" align="left" name="div_regist" >
	<form name="authorizatiob_form" action="" method="post">
		<label> login </label> <br/>
		<input type="text" class="text_feeld" name="login_text" placeholder="login"/>
		<span style="color:red" > <?php echo $eror_login_text;?></span>
		<br/>
		
		<label> pasword </label> <br/>
		<input type="pasword" class="text_feeld" name="ath_pasword_text" placeholder="pasword"/>
		<span style="color:red" > <?php echo $eror_ath_pasword_text;?></span>
		<br/>
		
		<input class="butt" type="submit" name="enter_butt" value="enter"/> 
		
		<input class="butt" type="submit" name="return_a" value="return" style="margin-left: 10" /> <br/>
		
	</form>
</div>

<script>
if(a == '1')
{
	press_authorization();
}
if(a1 == '1')
{
	press_registration();
}
</script>  
  
</body>
</html>