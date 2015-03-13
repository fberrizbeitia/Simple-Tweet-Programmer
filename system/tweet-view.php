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

$objTweet= new tweet($conn);


if(isset($_GET["op"])){
	$op = $_GET["op"];
	switch ($op){
		case "buscar":
			$objTweet->buscar($_GET["query"]);
		break;	
		
		case "filtrar":
			if($_GET["tag"] > 0){
				$objTweet->obtenerPorTag($_GET["tag"]);
			}else{
				$objTweet->obtenerTodos();
				}
		break;	
		
	}
}else{
	// GET ALL TWEET
	$objTweet->obtenerTodos();	
}

?>

<script language="javascript">
	function borrar(id){
		var r = confirm("You're about to delete the tweet. This operation cannot be undone");
		if (r == true) {
			url = "tweet-delete.php?id="+id;
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
            <td colspan="3" align="center"><h1>Manage Tweets</h1></td>
            <td colspan="2"><a href="tweet-create.php"><img src="../img/icon-new.png" width="29" height="30" alt="Create new tag" /></a></td>
          </tr>
          <tr>
          	<td colspan="5" align="center">
            <form action="tweet-view.php" method="get">
            <input name="op" type="hidden" value="buscar" /><input name="query" type="text" /> <input name="Search" type="submit" value="Search" />
            </form>
            </td>
          </tr>
          <tr bgcolor="#CCCCCC">
            <form action="tweet-view.php" method="get">
            <td align="left">Tweet text</td>
            <td colspan= align="left" valign="bottom">
            <?php 
				$objTag = new tag($conn);
				$objTag->obtenerTodos();
			?>
            <input name="op" type="hidden" value="filtrar" />
            	 <select name="tag" onChange="submit()">
                 <option value="-1">Select</option>
                 <option value="0">All Tags</option>
				 <?php for($i = 0; $i < $objTag->total; $i++){
					$objTag->ir($i); 
				?>
            	   <option value="<?php echo($objTag->id)?>"><?php echo($objTag->name)?></option>
                  <?php
				 }
				  ?>
                 </select>
            
            </td>
          <td></td>
          <td></td>
          <td></td>
          </form>
          </tr>
		
        
    	<?php
        
			
			$objTag = new tag($conn);
			for($i = 0; $i< $objTweet->total; $i++){
				$objTweet->ir($i);
				$objTag->obtenerPorID($objTweet->tag);
				?>
 			<tr>
            <td><?php echo($objTweet->text)?></td>
            <td><?php echo($objTag->name) ?></td>
            <td><a href="tweet-edit.php?id=<?php echo($objTweet->id) ?>"><img src="../img/icon-edit.png" width="29" height="30" /></a></td>
            <td><a href="#" onClick="borrar(<?php echo($objTweet->id)?>)"><img src="../img/icon-delete.png" width="29" height="30" /></a></td>
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