<?php
include("../classes/conexion.php");
require("../classes/task.php");

// START SESSION AND VALIDATE USER
include("../classes/util.php");
@session_start();
if(!$_SESSION["logged"]){
	goToUrl("../logout.php");
}
//-------------------------------

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
    	
        <table width="50%" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td colspan="5"><h1>Manage Tasks</h1></td>
            <td><a href="task-create.php"><img src="../img/icon-new.png" width="29" height="30" /></a></td>
          </tr>
          <tr>
            <td bgcolor="#CCCCCC"><b>Name</b></td>
            <td bgcolor="#CCCCCC"><b>Begin Date</b></td>
            <td bgcolor="#CCCCCC"><b>End Date</b></td>
            <td bgcolor="#CCCCCC"><b>Interval</b></td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
        <?php
        $objTask= new task($conn);
		$objTask->obtenerTodos();
		for($i = 0; $i < $objTask->total;$i++){
			$objTask->ir($i);
		?>
          <tr>
            <td><?php echo($objTask->name)?></td>
            <td><?php echo($objTask->beginDate)?></td>
            <td><?php echo($objTask->endDate)?></td>
            <td><?php echo($objTask->interval)?></td>
            <td><a href="task-edit.php?id=<?php echo($objTask->id)?>"><img src="../img/icon-edit.png" width="29" height="30" /></a></td>
            <td><a href="task-remove.php?id=<?php echo($objTask->id)?>"><img src="../img/icon-delete.png" width="29" height="30" /></a></td>
          </tr>
        <?php
		}//for($i = 0; $i < $objTask->total;$i++){
		?>
        </table>
    </div>
</div>
<?php require("../footer.php");?>

</body>
</html>