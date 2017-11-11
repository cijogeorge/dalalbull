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
<center><h1>DALAL BULL @ e<font color="red">X</font>cel 2k9</h1>
<?

$excelid=$_POST['excelid'];
$password=$_POST['password'];
mysql_real_escape_string($excelid);
mysql_real_escape_string($password);
$temp1=mysql_query("SELECT excelid FROM `portfolio` WHERE excelid='$excelid' AND password='$password'");
$temp2=mysql_fetch_array($temp1);
if(!$temp2)
{
 ?><form name="form" action="login.php" method="post">
 <hr>Authentication failure.<br><br>
 <input type="submit" name="back" value="Login">
 </form><?
}
else
{
 
 ?>
 <table>
 <tr>
 <td><form name="form2" action="portfolio.php" method="post">
 <input type="submit" name="portfolio" value="Portfolio">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">

 </form></td>
 <td><form name="form1" action="stockinfo.php" method="post">
 <input type="submit" name="stockinfo" value="Stock Info">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form3" action="buy.php" method="post">
 <input type="submit" name="buy" value="Buy / Short Sell">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td></body>
 <td><form name="form4" action="sell.php" method="post">
 <input type="submit" name="sell" value="Sell / Short Cover">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form8" action="history.php" method="post">
 <input type="submit" name="history" value="History">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form7" action="ranklist.php" method="post">
 <input type="submit" name="ranklist" value="Top Ranks">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form10" action="change_pass.php" method="post">
 <input type="submit" name="change_pass" value="Change Pass">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form9" action="help.php" method="post">
 <input type="submit" name="help" value="Help">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form5" action="change_pass.php" method="post">
 <input type="submit" name="refresh" value="Refresh">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form6" action="login.php" method="post">
 <input type="submit" name="logout" value="Logout">
 </form></td>
 </tr></table>
 <hr><br><? 
 if(isset($_POST['submitnewpass']) && (!$_POST['oldpass'] || !$_POST['newpass1'] || !$_POST['newpass2']))
 {
  echo "You have not filled in all the required fields.";?><br><br><?
 }
 else if(isset($_POST['submitnewpass']) && md5($_POST['oldpass'])!=$password)
 {
  echo "The 'Current Password' you entered is wrong."?><br><br><?
 }
 else if(isset($_POST['submitnewpass']) && $_POST['newpass1']!=$_POST['newpass2'])
 {
  echo "The 'New Password' entries do not match.";?><br><br><?
 }

 if(isset($_POST['submitnewpass']) && md5($_POST['oldpass'])==$password && $_POST['newpass1']==$_POST['newpass2'])
 {
  $newpass=md5($_POST['newpass1']);
  mysql_query("UPDATE `portfolio` SET password='$newpass' WHERE excelid='$excelid' AND password='$password'");
  echo "Password change successful."?><br><? 
  echo "Press the 'Login' button below to login."?><br><br>
  <form name="submit2" action="portfolio.php" method="post">
  <input type="hidden" name="password" value="<?echo $newpass;?>">
  <input type="hidden" name="portfolio">
  <input type="hidden" name="excelid" value="<?echo $excelid;?>">
  <input type="submit" name="loginagain" value="Login"><br><br><?
 }
 else
 {?>
  <form name="submit" action="change_pass.php" method="post">
  <table border="1">
  <tr>
  <td>Current Password</td>
  <td><input type="password" name="oldpass"></td></tr>
  <tr><td>New Password</td>
  <td><input type="password" name="newpass1"></td></tr>
  <tr><td>Confirm New Password</td>
  <td><input type="password" name="newpass2"></td></tr></table><br><br>
  <input type="submit" name="submitnewpass" value="Change Password">
  <input type="hidden" name="excelid" value="<?echo $excelid;?>">
  <input type="hidden" name="password" value="<?echo $password;?>">
  </form>
  <?
 }
}
mysql_close($con);
?><br>
<hr> <br><br>
&copy; Copyright 2009 @ Model Engineering College<br><br><br><br>
</center>
</body>
</html>

