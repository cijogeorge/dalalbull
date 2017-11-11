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
<b>REGISTER</b><br><br>
<?
if(isset($_POST['submitreg']))
{
 $excelid=$_POST['excelid'];
 $password1=$_POST['password1'];
 $password2=$_POST['password2'];
 $email=$_POST['email'];
 $firstname=$_POST['firstname'];
 $lastname=$_POST['lastname'];
 $college=$_POST['college'];
 $phone=$_POST['phone'];
 mysql_real_escape_string($excelid);
 mysql_real_escape_string($email);
 mysql_real_escape_string($firstname);
 mysql_real_escape_string($lastname);
 mysql_real_escape_string($college);
 $temp1=mysql_query("SELECT excelid FROM `portfolio` WHERE excelid='$excelid'") or die(mysql_error());
 $flag=mysql_fetch_array($temp1);
}

if(isset($_POST['submitreg'])&&$excelid&&$password1&&$password2&&$email&&$firstname&&$lastname&&$college&&!$flag&&strpos($excelid," ")==FALSE&&strpos($email," ")==FALSE&&strpos($firstname," ")==FALSE&&strpos($lastname," ")==FALSE&&strpos($excelid,"'")==FALSE&&strpos($excelid,"'")==FALSE&&strpos($excelid,"\"")==FALSE&&strpos($excelid,"`")==FALSE&&strpos($excelid,")")==FALSE&&strpos($excelid,"(")==FALSE&&strpos($excelid,"$")==FALSE&&strpos($excelid,"--")==FALSE&&strpos($excelid,",")==FALSE&&strpos($excelid,";")==FALSE)
{
 if((($phone && is_numeric($phone))||!$phone) && ($password1==$password2))
 {
  $password=md5($password1);
  mysql_query("INSERT INTO `portfolio` (excelid,password,email,firstname,lastname,college) VALUES ('$excelid','$password','$email','$firstname','$lastname','$college')") or die(mysql_error());
  if($phone && is_numeric($phone))
  {
   mysql_query("UPDATE `portfolio` SET phone='$phone' WHERE excelid='$excelid'")or die(mysql_error());
  }
  echo "Registration Successful!";?><br><?
  $temp=1;
 }
}

if(isset($_POST['submitreg']) && $flag && !$temp)
{
 echo "The ID '",$excelid,"' already exists. Choose another one.";?><br><br><?
}
else if(isset($_POST['submitreg']) && (!$excelid||!$password1||!$password2||!$email||!$firstname||!$lastname||!$college) && !$temp)
{
 echo "You have not filled all fields marked with '*'.";?><br><br><?
}
else if(isset($_POST['submitreg']) && $password1!=$password2 && !$temp)
{
 echo "The Passwords do not match.";?><br><br><?
}
else if(isset($_POST['submitreg']) && $phone && !is_numeric($phone) && !$temp)
{
 echo "Use only numbers in the Phone No. field.";?><br><br><?
}
else if(isset($_POST['submitreg'])&&(strpos($excelid,"'")!=FALSE||strpos($excelid,"'")!=FALSE||strpos($excelid,"\"")!=FALSE||strpos($excelid,"`")!=FALSE||strpos($excelid,")")!=FALSE||strpos($excelid,"(")!=FALSE||strpos($excelid,"$")!=FALSE||strpos($excelid,"--")!=FALSE||strpos($excelid,",")!=FALSE||strpos($excelid,";")!=FALSE)&&!$temp)
{
 echo "Invalid input in 'Dalal ID'.";?><br><br><?
}
else if(isset($_POST['submitreg'])&&(strpos($excelid," ")!=FALSE||strpos($email," ")!=FALSE||strpos($firstname," ")!=FALSE||strpos($lastname," ")!=FALSE)&&!$temp)
{
 echo "You cannot use 'Space' in 'Dalal ID', 'Email ID', 'First Name', 'Last Name' & 'College'.";?><br><br><?
} 
else if(!$temp)
{
 echo "All fields marked with '*' are compulsory.";?><br><br><?
}
if(!$temp)
{
 ?>
 <form name="regform" action="register.php" method="post">
 <table border="1">
 <tr><td>Dalal ID*</td>
 <td><input type="text" name="excelid" maxlength="50" style="width:250" value="<?if($excelid && !$flag){echo  $excelid;}?>"></td></tr> 
 <tr><td>Password*</td>
 <td><input type="password" name="password1" maxlength="50" style="width:250"></td></tr>
 <tr><td>Confirm Password*</td>
 <td><input type="password" name="password2" maxlength="50" style="width:250"></td></tr>
 <tr><td>Email ID*</td>
 <td><input type="text" name="email" maxlength="50" style="width:250" value="<?if($email){echo $email;}?>"></td></tr>
 <tr><td>First Name*</td>
 <td><input type="text" name="firstname" maxlength="20" style="width:250" value="<?if($firstname){echo $firstname;}?>"></td></tr>
 <tr><td>Last Name*</td>
 <td><input type="text" name="lastname" maxlength="20" style="width:250" value="<?if($lastname){echo  $lastname;}?>"></td></tr>
 <tr><td>College*</td>
 <td><input type="text" name="college" maxlength="50" style="width:250" value="<?if($college){echo  $college;}?>"></td></tr>
 <tr><td>Phone No.</td>
 <td><input type="text" name="phone" style="width:250" value="<?if($phone && is_numeric($phone)){echo $phone;}?>"></td></tr>
 </table><br>
 <input type="submit" name="submitreg" value="Register">
 </form>
</center><br>
<b>NOTE:</b> Your personal details once entered cannot be changed. Prize will be given only after verification of the  personal details given by the participant. Participants entering invalid information or junk data will be disqualified.
<center><br>
<?
}?>
<br>
<hr><br><br>
&copy; Copyright 2009 @ Model Engineering College<br><br><br><br>
</body>
</center>
</html>
