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
 <td><form name="form6" action="login.php" method="post">
 <input type="submit" name="logout" value="Logout">
 </form></td>
 </tr></table> 
 <hr>
 <? 

 if(isset($_POST['s_sc']))
 {
  $company=$_POST['company'];
  $quantity=$_POST['quantity'];
  $pending_price=$_POST['pending'];
  $s_sc=$_POST['s_sc'];
  mysql_real_escape_string($s_sc);
  if($s_sc=="Sell") { $b_ss="Buy"; }
  else { $b_ss="Short Sell"; }
  $temp1=mysql_query("SELECT Current_price FROM `stock_data` WHERE Name='$company'") or die(mysql_error());
  $current_price=mysql_fetch_array($temp1);
  if(!$current_price)
  {
   echo "The company '",$company,"' is not listed.";
  }
  else
  {
   $temp1=mysql_query("SELECT quantity,value FROM `transactions` WHERE excelid='$excelid' AND   company='$company' AND buy_ss='$b_ss'") or die(mysql_error());
   $temp2=mysql_fetch_array($temp1);
   $old_quantity=$temp2[0];
   if(!is_numeric($quantity)||$quantity<0)
   { echo "Invalid Input"; }
   else if(($pending_price!="") && ($current_price[0]!=$pending_price))
   { 
    if(!is_numeric($pending_price) || $pending_price<0)
    { echo "Invalid input."; }
    else if($s_sc=="Short Cover" && $pending_price>$current_price[0])
    {
     echo "Pending price for short covering should be less than current price.";
    }
    else if($s_sc=="Sell" && $pending_price<$current_price[0])
    {
     echo "Pending price for selling should be greater than current price.";
    }
    else
    {
     mysql_query("INSERT INTO `pending` (excelid,company,quantity,price,type) VALUES ('$excelid','$company','$quantity','$pending_price','$s_sc')") or die(mysql_error());
     echo "You have made a pending order to ",$s_sc," ",$quantity," shares of '",$company,"' at a desired price of Rs.",$pending_price,".";
    }
   }
   else if($quantity>$old_quantity)
   {
    echo "There is no enough number of shares for this transaction.";
   }
   else
   {
    $old_val=$temp2[1];
    $new_quantity=$old_quantity-$quantity;
    $old_total=($old_val/$old_quantity)*$quantity;
    $new_val=$old_val-$old_total;
    if($new_quantity==0)
    {
     mysql_query("DELETE FROM `transactions` WHERE excelid='$excelid' AND  company='$company' AND   buy_ss='$b_ss'");
    }
    else
    {
     mysql_query("UPDATE `transactions` SET quantity='$new_quantity',value='$new_val' WHERE  excelid='$excelid'  AND company='$company' AND buy_ss='$b_ss'") or die(mysql_error());
    } 
    $temp1=mysql_query("SELECT cash_bal,margin FROM `portfolio` WHERE excelid='$excelid'") or die(mysql_error());
    $old_cash_bal=mysql_fetch_array($temp1);
    $margin=$old_cash_bal[1];
    if($s_sc=="Short Cover")
    {
     $sc_profit=$old_total-($quantity*$current_price[0]);
     $cash_bal=$old_cash_bal[0]+$sc_profit;
     $margin=($old_cash_bal[1]-($old_val/2))+($new_val/2);
    }
    else if($s_sc=="Sell")
    {
     $cash_bal=$old_cash_bal[0]+($quantity*$current_price[0]);
    }  
    mysql_query("UPDATE `portfolio` SET cash_bal='$cash_bal',margin='$margin' WHERE excelid='$excelid'") or die(mysql_error());
    $temp1=mysql_query("SELECT cash_bal,no_trans FROM `portfolio` WHERE excelid='$excelid'") or die (mysql_error ());
    $temp2=mysql_fetch_array($temp1);
    $cash_bal=$temp2[0];
    $no_trans=$temp2[1]+1; 
    if($no_trans<=100)
    {
     $brokerage=((0.1/100)*$current_price[0])*$quantity;
    }
    else if($no_trans<=1000)
    {
     $brokerage=((0.2/100)*$current_price[0])*$quantity;
    }
    else
    {
     $brokerage=((0.5/100)*$current_price[0])*$quantity;
    }
    $cash_bal=$cash_bal-$brokerage;
    mysql_query("UPDATE `portfolio` SET cash_bal='$cash_bal',no_trans='$no_trans' WHERE excelid='$excelid'");
    $time=date("d/m/Y, H:i:s",time());
    mysql_query("INSERT INTO `history` (excelid,time,company,type,quantity,price) VALUES ('$excelid','$time','$company','$s_sc','$quantity','$current_price[0]')");
    if($s_sc=="Sell")
    {
     echo "You have successfully sold ",$quantity," shares of '",$company,"' at Rs.",$current_price[0]," per   share.";
    }
    else
    {
     echo "You have successfully short covered ",$quantity," shares of '",$company,"' at Rs.",$current_price  [0]," per share.";
    }
    ?><br><?
    echo "You have paid Rs.",$brokerage," as brokerage for the transaction.";
   }
  }
 }
 mysql_close($con);
}
?><br>
<hr><br><br>
&copy; Copyright 2009 @ Model Engineering College<br><br><br><br>
</center>
</body>
</html>

