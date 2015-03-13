<?php
session_start();
require("classes/util.php");
$_SESSION["logged"] = false;
session_destroy();
goToUrl("index.php");
?>