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
<body><center>
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
 <td><form name="form5" action="buy.php" method="post">
 <input type="submit" name="refresh" value="Refresh">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 <input type="hidden" name="buy" value="<?echo $_POST['buy'];?>">
 </form></td>
 <td><form name="form6" action="login.php" method="post">
 <input type="submit" name="logout" value="Logout">
 </form></td>
 </tr></table> <hr>

 <? 
 if(date("Hi",time())<1000||date("Hi",time())>=1530 || date("w",time())==0 || date("w",time())==6)
 {
  echo "You cannot trade now.";?><br><?
  echo "Trading time is between 10:00 & 15:30 from Monday to Friday.";?><br><?
  echo "No trading on Saturdays & Sundays.";
 }
 else
 {
  if(isset($_POST['buy']))
  {?>
   <b>BUY / SHORT SELL</b><br><br>
   <form name="buy_share" action="submit_buy.php" method="post">
   <table border="1"><tr>
   <td>Company</td>
   <td>
   <select name="company">
   <?
   $temp1=mysql_query("SELECT Name,Current_price FROM `stock_data` 
ORDER BY Name"); 
   while($temp2=mysql_fetch_array($temp1))
   {
    ?>
    <option value="<?echo $temp2[0];?>"><?printf("%s (Price: Rs.%.2f)",$temp2[0],$temp2[1]);?></option>
    <?
   }
   ?>
   </select>
   </td></tr>
   <tr>
   <td>Quantity</td>
   <td><input type="text" name="quantity" style="width:240px;"></td>
   </tr>
   <tr>
   <td>Buy / Short Sell</td>
   <td>
   <select name="b_ss">
   <option value="Buy">Buy</option>
   <option value="Short Sell">Short Sell</option>
   </select></td></tr>
   </table><br>
   <b>PENDING ORDER</b><br>
   (leave blank if not applicable)<br><br>
   <table border="1">
   <tr><td>Desired Price (Rs.)</td>
   <td><input type="text" name="pending"></td></tr>
   </tr></table><br>
   <input type="submit" name="submit_buy" value="Place Order"> 
   <input type="hidden" name="excelid" value="<?echo $excelid;?>">
   <input type="hidden" name="password" value="<?echo $password;?>">
   </form>
   <?
  }
 }
 mysql_close($con);
}
?><br>
<hr><br><br>
&copy; Copyright 2009 @ Model Engineering College<br><br><br><br>
</body>
</center>
</html>
