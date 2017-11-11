<?php
$con=mysql_connect("localhost","inexcel_excel","excel2k9");
if (!$con)
{
 die('Could not connect: ' . mysql_error());
} 
mysql_select_db("inexcel_excel",$con);
?>
<html>
<head>
<link rel="shortcut icon" href="small.gif" mce_href="favicon.ico" >
<title>DALAL BULL</title>
</head>
<body>
<center>
<h1>DALAL BULL @ e<font color="red">X</font>cel 2k9</h1>
<table>
<tr>
<td><form name="form1" action="index.php" method="post">
<input type="submit" name="index" value="Home">
</form></td>
<td><form name="form4" action="http://www.excelmec.org/" method="post">
<input type="submit" name="excel2k9" value="eXcel 2k9">
</form></td>
<td><form name="form6" action="about.php" method="post">
<input type="submit" name="about" value="About">
</form></td>
<td><form name="form2" action="register.php" method="post">
<input type="submit" name="register" value="Register">
</form></td>
<td><form name="form3" action="login.php" method="post">
<input type="submit" name="login" value="Login">
</form></td>
<td><form name="form4" action="contact.php" method="post">
<input type="submit" name="contact" value="Contact">
</form></td>
</tr></table> 
<hr>
<br>
<form name="login" action="portfolio.php" method="post">
<table border="1">
<tr><td>Dalal ID</td>
<td><input type="text" name="excelid" maxlength="50"></td></tr>
<tr><td>Password</td>
<td><input type="password" name="password" maxlength="50"></td></tr>
</table><br>
<input type="submit" name="submitlogin" value="Login">
<input type="hidden" name="portfolio" value="Login">
</form><br>
<p>[ You have to register for this event separately. You cannot login 
using your eXcel ID & password. ]</p>
<?
mysql_close($con);
?>
<br>
<hr><br><br>
&copy; Copyright 2009 @ Model Engineering College<br><br><br><br>
</body>
</center>
</html>
