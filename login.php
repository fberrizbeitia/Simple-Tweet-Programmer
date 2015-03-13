<?php
require("config.php");
require("classes/util.php");

if(isset($_POST["login"]) and  isset($_POST["pwd"])){
	if(isValid($_POST["login"]) and isValid($_POST["pwd"])){
		if($_POST["login"] == $usr and $_POST["pwd"]==$pwd){
			session_start();
			$_SESSION["logged"] = true;
			goToUrl("system/main.php");
		}else{
			alert("The user and/or password doesn't match. Please try again");
			goToUrl("index.php");	
		}	
	}
}

?>