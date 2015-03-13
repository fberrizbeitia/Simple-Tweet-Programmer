<?php
include("../classes/conexion.php");
include("../classes/tweet.php");

// START SESSION AND VALIDATE USER
include("../classes/util.php");
@session_start();
if(!$_SESSION["logged"]){
	goToUrl("../logout.php");
}
//-------------------------------

$id = "";
if(isset($_GET["id"])){
	$id = $_GET["id"];
	$objTweet = new tweet($conn);
	$objTweet->obtenerPorID($id);
	$objTweet->borrar();
	alert("The Tweets has been removed");
}

goToUrl("tweet-view.php");
?>