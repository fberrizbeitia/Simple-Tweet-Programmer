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
if(isset($_POST["id"])){
	$id = $_POST["id"];
}

if(isset($_GET["id"])){
	$id = $_GET["id"];
	}
	
if($id != ""){
	$objTag = new tag($conn);
	$objTag->obtenerPorID($id);
}else{
	goToUrl("../logout.php");
}

if(isset($_POST["name"]) and isValid($_POST["name"]) ){
	$objTag->name = $_POST["name"];
	$objTag->guardar();
	goToUrl("tags-view.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Simple Tweet Programer</title>

<link href="../stiles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php require("header.php");?>	

<div id ="main">
	<div id="box">
    	<form action="tags-edit.php" method="post">
        	<table border="0" cellspacing="0" cellpadding="5" align="center">
              <tr>
                <td><h1> Edit the Tag's name and save changes to return </h1></td>
              </tr>
              <tr>
             
                <td><input name="name" type="text" value="<?php echo($objTag->name)?>" />
                <input type="hidden" name="id" id="id" value="<?php echo($objTag->id)?>" /></td>
              </tr>
              <tr>
                <td><input name="input" type="submit" value="Save changes" />
                <input name="cancel" type="button" value="Cancel" onclick="window.location.href='tags-view.php'"/></td>
              </tr>
            </table>
        </form>
    </div>
</div>
<?php require("../footer.php");?>

</body>
</html>