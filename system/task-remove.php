<?php
include("../classes/conexion.php");
include("../classes/task.php");

// START SESSION AND VALIDATE USER
include("../classes/util.php");
@session_start();
if(!$_SESSION["logged"]){
	goToUrl("../logout.php");
}
//-------------------------------

if(isset($_GET["id"])){
	$objTask = new task($conn);
	$objTask->obtenerPorID($_GET["id"]);
	$objTask->borrar();	
	closeConnection($conn);
	goToUrl("programer.php");
}else{
	closeConnection($conn);
	goToUrl("../logout.php");
	}
?>