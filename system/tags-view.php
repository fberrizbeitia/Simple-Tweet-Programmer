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

if(isset($_GET["op"])){
	$op = $_GET["op"];
	switch ($op){
		case "crear":
			$objTag = new tag($conn);
			$objTag->crear();
		break;
			
		
	}
}

?>

<script language="javascript">
	function borrar(id){
		var r = confirm("You're about to delete the tag and all related tweets. This operation cannot be undone");
		if (r == true) {
			url = "tags-delete.php?id="+id;
			window.location.href = url;
		}
	}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Simple Tweet Programer</title>

<link href="../stiles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php require("header.php"); ?>	

<div id ="main">
	<div id="box">
    	<table border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td colspan="2"><h1>Manage Tags</h1></td>
            <td colspan="2"><a href="tags-view.php?op=crear"><img src="../img/icon-new.png" width="29" height="30" alt="Create new tag" /></a></td>
          </tr>
          <tr>
            <td bgcolor="#CCCCCC">Tag Name</td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
            <td colspan="2" bgcolor="#CCCCCC">&nbsp;</td>
          </tr>

    	<?php
        	$objTag = new tag($conn);
			$objTag->obtenerTodos();
			for($i = 0; $i< $objTag->total; $i++){
				$objTag->ir($i);
				?>
 			<tr>
            <td><?php echo($objTag->name)?></td>
            <td><a href="tags-edit.php?id=<?php echo($objTag->id) ?>"><img src="../img/icon-edit.png" width="29" height="30" /></a></td>
            <td><a href="#" onClick="borrar(<?php echo($objTag->id)?>)"><img src="../img/icon-delete.png" width="29" height="30" /></a></td>
          </tr>
			<?php
			}
			?>
         </table>
  </div>
</div>
<?php require("../footer.php");?>

</body>
</html>