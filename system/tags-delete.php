<?php
include("../classes/conexion.php");
include("../classes/tag.php");

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
	$objTag = new tag($conn);
	$objTag->obtenerPorID($id);
	$name = $objTag->name;
	$objTag->borrar();
	alert("The tag $name and all related Tweets has been removed");
}

goToUrl("tags-view.php");
?>