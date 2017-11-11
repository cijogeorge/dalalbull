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
 <td><form name="form5" action="history.php" method="post">
 <input type="submit" name="refresh" value="Refresh">
 <input type="hidden" name="excelid" value="<?echo $excelid;?>">
 <input type="hidden" name="password" value="<?echo $password;?>">
 <input type="hidden" name="history" value="<?echo $_POST['history'];?>">
 </form></td>
 <td><form name="form6" action="login.php" method="post">
 <input type="submit" name="logout" value="Logout">
 </form></td>
 </tr></table> <hr>
 <b>TRANSACTION HISTORY</b><br><br>
 <? 
 $temp1=mysql_query("SELECT excelid FROM `history` WHERE excelid='$excelid'");
 $temp2=mysql_fetch_array($temp1);
 if(!$temp2)
 {
  echo "You have no transaction history.";?><br><?
 }
 else
 {
  if(!isset($_POST['prev']) && !isset($_POST['next']))
  {
   $start=0;
   $temp1=mysql_query("SELECT * FROM `history` WHERE excelid='$excelid'");
   $end=mysql_num_rows($temp1);?><?
  }
  else if(isset($_POST['prev'])||isset($_POST['next']))
  {
   $start=$_POST['start'];
   $end=$_POST['end'];
   if(isset($_POST['prev']))
   {
    $start-=100;
   }
   else if(isset($_POST['next']))
   {
    $start+=100;
   }
  }?> 
  
  <table border="1"> 
  <tr><td>Order No.</td>
  <td>Date & Time</td>
  <td>Company</td>
  <td>Type Of Order</td>
  <td>Quantity</td>
  <td>Price (Rs.)</td>
  <td>Total Price (Rs.)</td></tr>
  <?
  $temp1=mysql_query("SELECT * FROM `history` WHERE excelid='$excelid' LIMIT $start, 100");
  while($temp2=mysql_fetch_array($temp1))
  {?>
   <tr><td><?echo $temp2[0];?></td>
   <td><?echo $temp2[2];?></td>
   <td><?echo $temp2[3];?></td>
   <td><?echo $temp2[4];?></td>
   <td><?echo $temp2[5];?></td>
   <td><?echo $temp2[6];?></td>
   <td><?echo $temp2[5]*$temp2[6];?></tr><? 
  }?>
  </table>
  <table>
  <form name="nextprev" action="history.php" method="post">
  <tr><br>
  <?
  if(($start-100)>=0)
  {?>
   <td><input type="submit" name="prev" value="Prev"></td><?
  }
  if(($start+100)<$end)
  {?>
   <td><input type="submit" name="next" value="Next"></td><?
  }?>
  <input type="hidden" name="excelid" value="<?echo $excelid;?>">
  <input type="hidden" name="password" value="<?echo $password;?>">
  <input type="hidden" name="start" value="<?echo $start;?>">
  <input type="hidden" name="end" value="<?echo $end;?>">
  </form></table><?
 }
 mysql_close($con);
}
?><br>
<hr><br><br>
&copy; Copyright 2009 @ Model Engineering College<br><br><br><br>
</body>
</center>
</html>

