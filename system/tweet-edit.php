<?php
include("../classes/conexion.php");
include("../classes/tag.php");
include("../classes/tweet.php");


// START SESSION AND VALIDATE USER
include("../classes/util.php");
@session_start();
if(!$_SESSION["logged"]){
	goToUrl("../logout.php");
}
//-------------------------------

$objTweet = new tweet($conn);

if(isset($_POST["text"]) and isValid($_POST["text"])){
	if($_POST["tag"] != 0){
		
		$objTweet->obtenerPorID($_POST["id"]);
		$objTweet->text = $_POST["text"];
		$objTweet->tag = $_POST["tag"];
		$objTweet->guardar();
		alert("Changes has been saved");
	}else{
		alert("Plese select a tag for the tweet");	
	}
}

if(isset($_GET["id"])){
	$objTweet->obtenerPorID($_GET["id"]);
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
    	<form action="tweet-edit.php" method="post">
        	<table border="0" cellspacing="0" cellpadding="5" align="center">
              <tr>
                <td colspan="2" align="center"><h1>Edit the tweet</h1></td>
              </tr>
              <tr>
                <td><textarea name="text" cols="" rows=""><?php echo($objTweet->text)?></textarea></td>
                <td valign="top">
            	 <select name="tag">
                 <option value="0" >Select</option>
				 <?php 
				 $objTag = new tag($conn);
				 $objTag->obtenerTodos();
				 for($i = 0; $i < $objTag->total; $i++){
					$objTag->ir($i);
					$selected = "";
					if($objTag->id == $objTweet->tag){
						$selected = "selected = 'selected'";
					} 
				?>
                <option <?php echo($selected)?> value="<?php echo($objTag->id)?>"> <?php echo($objTag->name)?> </option>
                  <?php
				 }
				  ?>
                 </select>
			
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Save Changes" />
                <input type="button" name="button2" id="button2" value="Done" onclick="window.location.href='tweet-view.php'"/>
                <input name="id" type="hidden" id="id" value="<?php echo($objTweet->id)?>" /></td>
              </tr>
            </table>

       	</form>
  </div>
</div>
<?php require("../footer.php");?>

</body>
</html>