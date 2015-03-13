<?php
include("../classes/conexion.php");
include("../classes/task.php");
include("../classes/quenue.php");

// START SESSION AND VALIDATE USER
include("../classes/util.php");
@session_start();
if(!$_SESSION["logged"]){
	goToUrl("../logout.php");
}
//-------------------------------

if(isset($_GET["idTask"]) and isset($_GET["idTweet"])){
	$objQuenue = new quenue($conn);
	$objQuenue->obtenerPorIDs($_GET["idTask"],$_GET["idTweet"]);
	$objQuenue->borrar();	
	closeConnection($conn);
	goToUrl("task-edit.php?id=".$_GET["idTask"]);
}else{
	closeConnection($conn);
	goToUrl("../logout.php");
	}
?>