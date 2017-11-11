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
 <td><form name="form5" action="sell.php" method="post">
 <input type="submit" name="refresh" value="Refresh">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 <input type="hidden" name="sell" value="<?echo $_POST['sell'];?>">
 </form></td>
 <td><form name="form6" action="login.php" method="post">
 <input type="submit" name="logout" value="Logout">
 </form></td>
 </tr></table><hr>
 <? 
 if(date("Hi",time())<1000||date("Hi",time())>=1530 || date("w",time())==0 || date("w",time())==6)
 {
  echo "You cannot trade now.";?><br><?
  echo "Trading time is between 10:00 & 15:30 from Monday to Friday.";?><br><?
  echo "No trading on Saturdays & Sundays.";
 }
 else
 {
  if(isset($_POST['sell']))
  {
   ?>
   <b>SELL / SHORT COVER</b><br><br>
   <?$temp1=mysql_query("SELECT company,buy_ss,quantity FROM `transactions` WHERE excelid='$excelid'")or die  (mysql_error());
   $temp2=mysql_fetch_array($temp1);
   if(!$temp2) {echo "You have no stock holdings.";?><br><?}
   else
   { ?>
    <table border="1">
    <tr>
    <td>Company</td>
    <td>Buy / Short Sell</td>
    <td>Quantity In Stock</td>
    <td>Quantity To Sell / Short Cover</td>
    <td>Current Price (Rs.)</td>
    <td>Expected Gain % Per Share</d>
    <td>Pending Order At Price</td>
    <td>Action</td></tr>
    <?
    while($temp2)
    {?>
     <tr>
     <form name="sell_share" action="submit_sell.php" method="POST">
     <input type="hidden" name="company" value="<?echo $temp2[0];?>">
     <td><?echo $temp2[0];?></td>
     <td><?echo $temp2[1];?></td>
     <td><?echo $temp2[2];?></td>
     <td><input type="text" name="quantity" style="width:75px;" value="<?echo $temp2[2];?>"></td>
     <td><?
     $temp3=mysql_query("SELECT Current_price FROM `stock_data` WHERE Name='$temp2[0]'") or die (mysql_error()); 
     $temp4=mysql_fetch_array($temp3);
     if(!$temp4)
     {
      echo "Not Listed";
     }
     else
     {
      printf("%.2f",$temp4[0]);
     }?>
     </td>
     <td>
     <?
     if(!$temp4[0])
     {
      printf("%.2f",0);
     }
     else
     {
      $temp5=mysql_query("SELECT quantity,value FROM `transactions` WHERE excelid='$excelid' AND company='$temp2[0]' AND buy_ss='$temp2[1]'") or die(mysql_error());
      $temp6=mysql_fetch_array($temp5);
      $old_quantity=$temp6[0];
      $old_val=$temp6[1];
      if($temp2[1]=="Buy")
      {
       $profit=$temp4[0]-($old_val/$old_quantity);
      }
      else
      {
       $profit=($old_val/$old_quantity)-$temp4[0];
      }
      $prof_per=($profit/($old_val/$old_quantity))*100;
      printf("%.2f",$prof_per);
     }?>
     </td>
     <td><input type="text" name="pending" style="width:75px;"></td>
     <td><input type="submit" name="s_sc" value="<?if($temp2[1]=="Buy"){echo "Sell";} else {echo "Short Cover";}?>"></td>
     <input type="hidden" name="excelid" value="<?echo $excelid;?>">
     <input type="hidden" name="password" value="<?echo $password;?>">
     </form></tr>
     <?
     $temp2=mysql_fetch_array($temp1);
    } ?>
    </table>
    </form>
    <?
   }
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
