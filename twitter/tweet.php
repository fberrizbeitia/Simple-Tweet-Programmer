<?php
require_once("../classes/conexion.php");
require_once("../config.php");
require_once("./twitteroauth-master/twitteroauth/twitteroauth.php");
require_once("../classes/task.php");
require_once("../classes/quenue.php");
require_once("../classes/tweet.php");

$oath = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
	
$objTask = new task($conn);
$objTask->obtenerActuales();

$objQuenue= new quenue($conn);
$objTweet = new tweet($conn);
 
for($i = 0; $i < $objTask->total;$i++){
	$objTask->ir($i);
	$objQuenue->obtenerNoEnviadosPorID($objTask->id);
	$objTweet->obtenerPorID($objQuenue->idTweet);
	if($objTweet->total > 0){
		$message = rawurlencode($objTweet->text);
		$query = "https://api.twitter.com/1.1/statuses/update.json?status=".$message;
		echo($query);
		$json = $oath->post($query);	
		$objQuenue->posted = 1;
		$objQuenue->guardar();
	}
}

closeConnection($conn);

?>