<?php

function alert($mensaje){
	echo("<script language='javascript'> alert('$mensaje')</script>" );	
}

function goToUrl($url){
	echo("<script language='javascript'> window.location.href='$url'</script>");
}

function isValid($text){
	$return = true;
		
	return $return;	
}

?>