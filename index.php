<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Simple Tweet Programer</title>

<link href="stiles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php require("header.php");?>	

<div id ="main">
  <div id="box">
    	<form action="login.php" method="post">
        <table border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
            <td>Please login</td>
          </tr>
          <tr>
            <td><input name="login" type="text" /></td>
          </tr>
          <tr>
            <td><input name="pwd" type="password" /></td>
          </tr>
          <tr>
            <td><input name="Submit" type="submit" value="Log in" /></td>
          </tr>
        </table>
   	</form>
  </div>

</div>
<?php require("footer.php");?>

</body>
</html>