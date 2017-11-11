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
if(isset($_POST['submitlogin']))
{
 $password=md5($_POST['password']);
 $temp1=mysql_query("SELECT password FROM `portfolio` WHERE excelid='$excelid'");
 $pass=mysql_fetch_array($temp1);
}
$temp1=mysql_query("SELECT excelid FROM `portfolio` WHERE excelid='$excelid' AND password='$password'");
$temp2=mysql_fetch_array($temp1);
if(!$temp2||(isset($_POST['submitlogin'])&&(!$pass||$pass[0]!=$password)))
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
 <td><form name="form5" action="portfolio.php" method="post">
 <input type="submit" name="refresh" value="Refresh">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 <input type="hidden" name="portfolio" value="<?echo $_POST['portfolio'];?>">
 </form></td>
 <td><form name="form6" action="login.php" method="post">
 <input type="submit" name="logout" value="Logout">
 </form></td>
 </tr></table> 
 <hr>
 <?
 if(isset($_POST['cancel']))
 {
  $company=$_POST['company'];
  $quantity=$_POST['quantity'];
  $price=$_POST['price'];
  $type=$_POST['type'];
  $temp1=mysql_query("SELECT id FROM `pending` WHERE excelid='$excelid' AND company='$company' AND quantity='$quantity' AND price='$price' AND type='$type'") or die(mysql_error());
  $id=mysql_fetch_array($temp1);
  mysql_query("DELETE FROM `pending` WHERE id='$id[0]' AND excelid='$excelid' AND company='$company' AND quantity='$quantity' AND price='$price' AND type='$type'") or die(mysql_error());
 }
 if(isset($_POST['portfolio']))
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
  $temp1=mysql_query("SELECT excelid FROM `portfolio` WHERE excelid='$excelid'") or die(mysql_error());
  $temp2=mysql_fetch_array($temp1);
  $temp1=mysql_query("SELECT excelid,cash_bal,margin,net_worth,no_trans FROM `portfolio` WHERE excelid='$excelid'") or die(mysql_error());
  $temp2=mysql_fetch_array($temp1);
  ?>
  <b>PORTFOLIO</b><br><br>
  <table border="1"><tr>
  <td>Dalal ID: </td><td><?echo $temp2[0];?></td></tr>
  <tr><td>Cash Balance: </td><td><?printf("Rs.%.2f",$temp2[1]);?></td></tr>
  <tr><td>Cash In Hand: </td><td><?printf("Rs.%.2f",$temp2[1]-$temp2[2]);?></td></tr>
  <tr><td>Margin: </td><td><?printf("Rs.%.2f",$temp2[2]);?></td></tr>
  <?$net_worth=$temp2[3];?>
  <tr><td>Net Worth: </td><td>Rs.<?printf("%.2f",$net_worth);?></td></tr>
  <tr><td>No. Of Transactions: </td><td><?echo $temp2[4];?></td></tr>
  <?
  $rank=1;
  $temp_net_worth=0;
  $temp1=mysql_query("SELECT net_worth FROM `portfolio` ORDER BY net_worth DESC") or die(mysql_error());
  while($temp2=mysql_fetch_array($temp1))
  {
   if($temp2[0]>$net_worth && $temp2[0]!=$temp_net_worth) { $rank++; }
   $temp_net_worth=$temp2[0];
  }?>
  <tr><td>Rank: </td><td><?echo $rank;?></td></tr></table><br>
  <b>STOCK HOLDINGS</b><br><?
  $temp1=mysql_query("SELECT company,buy_ss,quantity FROM `transactions` WHERE excelid='$excelid'") or die  (mysql_error());
  $temp2=mysql_fetch_array($temp1);
  if(!$temp2) {?><br><?echo "You have no stock holdings.";?><br><?}
  else
  {?>
   <table border="1">
   <tr>
   <td>Company</td><br>
   <td>Buy / Short Sell</td>
   <td>Quantity in stock</td>
   <td>Current price (Rs.)</td>
   </tr>
   <?
   while($temp2)
   {
    ?><tr><?
    for($j=0;$j<3;$j++)
    {
     ?><td><?
     echo $temp2[$j];
     ?></td><?
    }
    ?><td><?
    $temp3=mysql_query("SELECT Current_price FROM `stock_data` WHERE Name='$temp2[0]'") or die (mysql_error()); 
    $temp4=mysql_fetch_array($temp3);
    if(!$temp4)
    {
     echo "Not Listed";
    }
    else
    {
     printf("%.2f",$temp4[0]);
    }
    ?>
    </td>
    </tr>
    <?
    $temp2=mysql_fetch_array($temp1);
   }
   ?></table><?
  }
  ?><br>
  <b>PENDING ORDERS</b><br><br><?
  $temp1=mysql_query("SELECT company,quantity,price,type FROM `pending` WHERE excelid='$excelid'");
  $temp2=mysql_fetch_array($temp1);
  if(!$temp2)
  {
   echo "You have no pending orders.";?><br><?
  }
  else
  {?>
   <table border="1">
   <tr>
   <td>Company</td><td>Type Of Order</td><td>Quantity</td><td>Current Price (Rs.)</td>
   <td>Desired Price (Rs.)</td><td>Action</td></tr><?
   while($temp2)
   {?>
    <tr><td><?echo $temp2[0];?></td>
    <td><?echo $temp2[3];?></td>
    <td><?echo $temp2[1];?></td><?
    $temp3=mysql_query("SELECT Current_price FROM `stock_data` WHERE Name='$temp2[0]'") or die (mysql_error()); 
    $temp4=mysql_fetch_array($temp3);?>
    <td><?
    if(!$temp4)
    {
     echo "Not Listed";
    }
    else
    {
     printf("%.2f",$temp4[0]);
    }?></td>
    <td><?printf("%.2f",$temp2[2]);?></td>
    <form name="cancel" action="portfolio.php" method="post">
    <td><input type="submit" name="cancel" value="Cancel Order"></td>
    <input type="hidden" name="excelid" value="<?echo $excelid;?>">
	<input type="hidden" name="password" value="<?echo $password;?>">
    <input type="hidden" name="company" value="<?echo $temp2[0];?>">
    <input type="hidden" name="quantity" value="<?echo $temp2[1];?>">
    <input type="hidden" name="price" value="<?echo $temp2[2];?>">
    <input type="hidden" name="type" value="<?echo $temp2[3];?>">
    <input type="hidden" name="portfolio">
    </form>
    <tr><?
    $temp2=mysql_fetch_array($temp1);
   }
   ?></table><?
  }
 }
}
mysql_close($con);
?><br>
<hr><br><br>
&copy; Copyright 2009 @ Model Engineering College<br><br><br><br>
</body>
</center>
</html>
