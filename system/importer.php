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

if(isset($_FILES["file"])){
	// ---------------- perform some security checks
	$fileName =  "uploads/" . $_FILES["file"]["name"];
	move_uploaded_file($_FILES["file"]["tmp_name"], $fileName);
	
	$tweetFile = fopen($fileName,"r");
	$objTweet= new tweet($conn);
	$objTag = new tag($conn);
	$objTag->obtenerTodos();
	while(! feof($tweetFile))
	  {
	  $row = fgetcsv($tweetFile,1000,';');
	  $tweet = $row[0];
	  $tag = $row[1];
	  if($tweet != "" and $tag != ""){
		  $objTag->obtenerTodos();
		  $idTag = $objTag->existe($tag);
		  if($idTag > 0){
			$objTweet->crear($tweet,$idTag);
			}else{
				$objTag->crear2($tag);
				$objTweet->crear($tweet,$objTag->id);
			}
	  }
	}
	
	fclose($tweetFile);
	
	alert("Tweets created");
}// if(isset($_FILES["file"])){

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
	  <form action="importer.php" method="post" enctype="multipart/form-data">
      <table border="0" align="center" cellpadding="5" cellspacing="0">
	    <tr>
	      <td colspan="2" align="center"><h1>Import tweets from CSV</h1></td>
        </tr>
	    <tr>
	      <td width="56%"><input name="file" type="file" /></td>
	      <td width="44%"><input name="input" type="submit" value="Upload File" /></td>
        </tr>
	    <tr>
	      <td colspan="2">&nbsp;</td>
        </tr>
      </table>
      </form>
    </div>
</div>
<?php require("../footer.php");?>

</body>
</html>