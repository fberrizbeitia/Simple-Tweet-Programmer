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

if(isset($_POST["name"]) and isValid($_POST["name"])){
	if(isValid($_POST["beginDate"]) and isValid($_POST["endDate"]) and isValid($_POST["interval"])){
		$objTask = new task($conn);
		$objTask->crear($_POST["name"],$_POST["beginDate"],$_POST["endDate"],$_POST["interval"]);
		alert("The task has been created");
	}else{
		alert("Please fill all the field");	
	}
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
    	<form action="task-create.php" method="post">
        	<table border="0" cellspacing="0" cellpadding="5" align="center">
              <tr>
                <td colspan="2"><h1>Create a new task</h1></td>
              </tr>
              <tr>
                <td align="left">Name</td>
                <td><label for="name"></label>
                <input type="text" name="name" id="name" /></td>
              </tr>
              <tr>
                <td align="left">Begin Date (YYYY-MM-DD)</td>
                <td><input type="text" name="beginDate" id="beginDate" /></td>
              </tr>
              <tr>
                <td align="left">End Date  (YYYY-MM-DD)</td>
                <td><input type="text" name="endDate" id="endDate" /></td>
              </tr>
              <tr>
                <td align="left">Interval</td>
                <td><input type="text" name="interval" id="interval" /></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Create Task" />
                <input type="button" name="C" id="C" value="Cancel" onclick="window.location.href='programer.php'"/></td>
              </tr>
            </table>

       	</form>
  </div>
</div>
<?php require("../footer.php");?>

</body>
</html>