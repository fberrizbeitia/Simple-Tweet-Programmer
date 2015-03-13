<?php
include("../classes/conexion.php");
include("../classes/task.php");
include("../classes/tweet.php");
include("../classes/tag.php");
include("../classes/quenue.php");


// START SESSION AND VALIDATE USER
include("../classes/util.php");
@session_start();
if(!$_SESSION["logged"]){
	goToUrl("../logout.php");
}
//-------------------------------

$objTask = new task($conn);
$taskId = 0;
if(isset($_GET["id"])){
	$taskId = $_GET["id"];
}

//----------------------------------------------
//-------------- SAVE THE TASK PROPERTIES
if(isset($_POST["save"])){
	if(isValid($_POST["beginDate"]) and isValid($_POST["endDate"]) and isValid($_POST["interval"]) and isValid($_POST["name"])){
		$taskId = $_POST["id"];
		$objTask->obtenerPorID($taskId);
		$objTask->name = $_POST["name"];
		$objTask->beginDate = $_POST["beginDate"];
		$objTask->endDate = $_POST["endDate"];
		$objTask->interval = $_POST["interval"];
		$objTask->guardar();
		alert("Changes has been saved");
	}else{
		alert("Plese fill all the fields correctly");	
	}
}

//-------------------------- ADD THE TWEETS

if(isset($_POST["add"])){
	$taskId = $_POST["id"];
	$objTweet = new tweet($conn);
	$objTweet->obtenerPorTag($_POST["tag"]);
	$objQuenue = new quenue($conn);
	for($i = 0; $i < $objTweet->total; $i++){
		$objTweet->ir($i);
		$objQuenue->crear($taskId,$objTweet->id);
	}
}

//---------------------------- SAVE ORDER
if(isset($_POST["Save_Order"])){
	$taskId = $_POST["id"];
	$objQuenue = new quenue($conn);
	$objQuenue->obtenerPorID($taskId);
	for($i = 0; $i < $objQuenue->total; $i++){
		$objQuenue->ir($i);
		$textFieldName = "pos_$i";
		if(isset($_POST[$textFieldName])){
			if(is_numeric($_POST[$textFieldName])){
				$objQuenue->pos =  $_POST[$textFieldName];
				$objQuenue->guardar();
			}
		}
	}//for($i = 0; $i < $objQuenue->total; $i++){
}//if(isset($_POST["Save_Order"])){

$objTask->obtenerPorID($taskId);

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
    	<form action="task-edit.php" method="post">
        	<table border="0" cellspacing="0" cellpadding="5" align="center">
              <tr>
                <td colspan="2" align="center"><h1>Edit the task properties</h1></td>
              </tr>
              <tr>
                <td align="left">Name</td>
                <td valign="top"><label for="name"></label>
                <input name="name" type="text" id="name" value="<?php echo($objTask->name)?>" /></td>
              </tr>
              <tr>
                <td align="left">Begin Date</td>
                <td valign="top"><input name="beginDate" type="text" id="beginDate" value="<?php echo($objTask->beginDate)?>" /></td>
              </tr>
              <tr>
                <td align="left">End Date</td>
                <td valign="top"><input name="endDate" type="text" id="endDate" value="<?php echo($objTask->endDate)?>" /></td>
              </tr>
              <tr>
                <td align="left">Interval</td>
                <td valign="top"><input name="interval" type="text" id="interval" value="<?php echo($objTask->interval)?>" /></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input type="submit" name="save" id="save" value="Save Changes" />
                <input type="button" name="button2" id="button2" value="Done" onclick="window.location.href='programer.php'"/>
                <input name="id" type="hidden" id="id" value="<?php echo($objTask->id)?>" /></td>
              </tr>
            </table>
    	</form>
    	<form method="post" action="task-edit.php">
    	  <p>
         	    <input name="id" type="hidden" id="id" value="<?php echo($objTask->id)?>" />
         	    
       	    </p>
    	  <p>&nbsp;</p>
       	    <table width="50%" border="0" cellspacing="0" cellpadding="5" align="center">
              <tr>
                <td align="center"><h1>Add Tweets to the quenue</h1></td>
              </tr>
              <tr>
                <td align="center" bgcolor="#CCCCCC"><b>Please select a tag to add the tweets to the quenue</b></td>
              </tr>
              <tr>
                <td align="center">
                	<select name="tag" size="5">
                	<?php 
						$objTag = new tag($conn);
						$objTag->obtenerTodos();
						for($i = 0; $i < $objTag->total;$i++){
							$objTag->ir($i);
					?>               
                	  <option value="<?php echo($objTag->id)?>"><?php echo($objTag->name)?></option>
                    <?php
						} //for($i = 0; $i < $objTag->total;$i++){
					?>
                	</select>
                </td>
              </tr>
              <tr>
                <td align="center"><input name="add" type="submit" value="add" id="add"/></td>
              </tr>
            </table>
   	  </form>
    	<form action="task-edit.php" method="post">
       	<input name="id" type="hidden" id="id" value="<?php echo($taskId)?>" />
    	<table width="50%" border="0" align="center" cellpadding="5" cellspacing="0">
    	  <tr>
    	    <td colspan="4" align="center">&nbsp;</td>
   	      </tr>
    	  <tr>
    	    <td width="64%" align="left" bgcolor="#CCCCCC"><strong>Tweet text</strong></td>
    	    <td width="18%" bgcolor="#CCCCCC"><strong>Order</strong></td>
    	    <td width="9%" bgcolor="#CCCCCC"><strong>Posted</strong></td>
    	    <td width="9%" bgcolor="#CCCCCC">&nbsp;</td> 
          </tr>
        <?php
        $objTQ = new quenue($conn);
		$objTI = new tweet($conn);
		$objTQ->obtenerPorID($taskId);
		for($i=0; $i < $objTQ->total;$i++){
			$objTQ->ir($i);
			$objTI->obtenerPorID($objTQ->idTweet);
		?>
    	  <tr>
    	    <td align="left"><?php echo($objTI->text)?></td>
    	    <td>
   	        <input name="pos_<?php echo($i)?>" type="text" id="pos_<?php echo($i)?>" size="2" maxlength="2" value="<?php echo($objTQ->pos)?>"/></td>
    	    <td><?php echo($objTQ->posted)?></td>
    	    <td><a href="task-remove-tweet.php?idTask=<?php echo($objTQ->idTask)?>&idTweet=<?php echo($objTQ->idTweet)?>"><img src="../img/icon-delete.png" width="29" height="30" /></a></td>
  	      </tr>
        <?php
		}//for($i=0; $i < $objTQ->total;$i++){
		?> 
        <tr>
        <td colspan="4">
        	<input name="Save Order" type="submit" value="Save Order" id="Save_Order" />
        </td>
        </tr> 
      </table>
      </form>

  </div>
</div>
<?php require("../footer.php");?>

</body>
</html>