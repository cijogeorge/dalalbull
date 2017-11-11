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
 <td><form name="form5" action="stockinfo.php" method="post">
 <input type="submit" name="refresh" value="Refresh">
 <?if(isset($_POST['showall'])) 
 { ?><input type="hidden" name="showall"><? }?>
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 </form></td>
 <td><form name="form6" action="login.php" method="post">
 <input type="submit" name="logout" value="Logout">
 </form></td>
 </tr></table>
 <hr> 
 <b>COMPANY STOCK INFO</b><br><br>
 <?
 if(isset($_POST['getinfo']))
 {
  $company=$_POST['company'];
  $temp1=mysql_query("SELECT * FROM `stock_data` WHERE Name='$company'");
  $temp2=mysql_fetch_array($temp1);?>
  <table border="1">
  <tr><td>Company</td><td><?echo $temp2[0]?></td></tr>
  <tr><td>Current Price (Rs)</td><td><?echo $temp2[1]?></td></tr>
  <tr><td>Open (Rs)</td><td><?echo $temp2[4]?></td></tr>
  <tr><td>High (Rs)</td><td><?echo $temp2[2]?></td></tr>
  <tr><td>Low (Rs)</td><td><?echo $temp2[3]?></td></tr>
  <tr><td>Prev. Close (Rs)</td><td><?echo $temp2[5]?></td></tr>
  <tr><td>% Change</td><td><?echo $temp2[6]?></td></tr>
  <tr><td>Total Traded Quantity</td><td><?echo $temp2[7]?></td></tr>
  <tr><td>Turnover (Rs.Lakhs)</td><td><?echo $temp2[8]?></td></tr>
  </table><br>
  <form name="backform" action="stockinfo.php" method="post">
  <input type="hidden" name="excelid" value="<?echo $excelid;?>">
  <input type="hidden" name="password" value="<?echo $password;?>">
  <input type="submit" name="back" value="Back">
  </form>
 <?}
 else if(isset($_POST['showall']))
 {?>
  <table border="1">
  <tr>
  <td>Company</td>
  <td>Current Price (Rs)</td>
  <td>Open (Rs)</td>
  <td>High (Rs)</td>
  <td>Low (Rs)</td>
  <td>Prev. Close (Rs.)</td>
  <td>% Change</td>
  <td>Total Traded Quantity</td>
  <td>Turnover (Rs.Lakhs)</td>
  </tr>
  <? 
  $temp1=mysql_query("SELECT * FROM `stock_data` ORDER BY Name");
  while($temp2=mysql_fetch_array($temp1))
  {?>
   <tr>
   <td><?echo $temp2[0];?></td>
   <td><?echo $temp2[1];?></td>
   <td><?echo $temp2[4];?></td>
   <td><?echo $temp2[2];?></td>
   <td><?echo $temp2[3];?></td>
   <td><?echo $temp2[5];?></td>
   <td><?echo $temp2[6];?></td>
   <td><?echo $temp2[7];?></td>
   <td><?echo $temp2[8];?></td>
   </tr><?
  }?> 
  </table>
  <?
 }

 else
 {?>
  <form name="info" action="stockinfo.php" method="post">
  <select name="company">
  <?
  $temp1=mysql_query("SELECT Name FROM `stock_data` ORDER BY Name"); 
  while($temp2=mysql_fetch_array($temp1))
  {
   ?>
   <option value="<?echo $temp2[0];?>"><?echo $temp2[0];?></option>
   <?
  }
  ?>
  </select><br><br>
  <input type="hidden" name="excelid" value="<?echo $excelid;?>">
  <input type="hidden" name="password" value="<?echo $password;?>">
  <input type="submit" name="getinfo" value="Get info">
  <input type="submit" name="showall" value="Show all">
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

