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
 </form></td>
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
 <td><form name="form5" action="ranklist.php" method="post">
 <input type="submit" name="refresh" value="Refresh">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 <input type="hidden" name="ranklist" value="<?echo $_POST['ranklist'];?>">
 </form></td>
 <td><form name="form6" action="login.php" method="post">
 <input type="submit" name="logout" value="Logout">
 </form></td>
 </tr></table> 
 <hr>
 <?
 if(isset($_POST['ranklist']))
 {
  $temp1=mysql_query("SELECT excelid,cash_bal FROM `portfolio`");
  while($temp2=mysql_fetch_array($temp1))
  {
   $net_worth=$temp2[1];
   $temp3=mysql_query("SELECT company,quantity FROM `transactions` WHERE excelid='$temp2[0]' AND buy_ss='buy'")  or die(mysql_error());
   while($company=mysql_fetch_array($temp3))
   {
    $temp4=mysql_query("SELECT Current_price FROM `stock_data` WHERE Name='$company[0]'") or die(mysql_error());
    $current_price=mysql_fetch_array($temp4);
    $net_worth+=$current_price[0]*$company[1];
   }
   mysql_query("UPDATE `portfolio` SET net_worth='$net_worth' WHERE excelid='$temp2[0]'")  or die(mysql_error());
  }
  ?><b>TOP 10 RANKS</b><br><br><?
  $temp_net_worth=0;
  $rank=1;
  $temp1=mysql_query("SELECT excelid,net_worth FROM `portfolio` ORDER BY net_worth DESC") or die(mysql_error());
  ?><table border="1">
  <tr><td>Rank</td><td>Dalal ID</td><td>Net Worth (Rs.)</td></tr><?
  while($temp2=mysql_fetch_array($temp1))
  {
   if($temp2[1]<$temp_net_worth) 
   { 
    $rank++; 
    if($rank==11) { break; }
   }
   $temp_net_worth=$temp2[1];?>
   <tr><td><?echo $rank;?></td><td><?echo $temp2[0];?></td><td><?printf("%.2f",$temp2[1]);?></td></tr><?
  }
  ?></table><?
 }
 mysql_close($con);
}
?><br>
<hr><br><br>
&copy; Copyright 2009 @ Model Engineering College<br><br><br><br>
</body>
</center>
</html>

