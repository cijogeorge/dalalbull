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
<h1>DALAL BULL @ e<font color="red">X</font>cel 2k9</h1></center>
<?
$excelid=$_POST['excelid'];
$password=$_POST['password'];
mysql_real_escape_string($excelid);
mysql_real_escape_string($password);
$amt=1000000;
$f=0;
$temp1=mysql_query("SELECT `type`,`quantity`,`price`,`time` FROM `history` where `excelid`='stockerjee'");
while($temp2=mysql_fetch_array($temp1))
{
 if($temp2[0]=="Sell")
  $m=1;
 if($temp2[0]=="Buy")
   $m=-1;
 $a=$m*$temp2[1]*$temp2[2];
 $amt=$amt+$a;
 echo "$temp2[3]## $amt<BR>";
if($amt<0)
{
 $f+=$amt;
 $amt=0;
}
}
echo "Final:$f";?>
