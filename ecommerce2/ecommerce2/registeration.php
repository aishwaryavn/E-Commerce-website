<!DOCTYPE html>
<html>
<head>
<title>Registeration for Online Shopping</title>
<link rel="stylesheet" href="css/style.css" media="all" />
</head>
<body>
<div class="main_wrapper">
<!--Header Container starts here-->
	<div class="header_wrapper">   
	
		
		<img id="banner" src="images/ad_banner.jpg">

	</div>
</div>
<header>

<b><center><h1>Professional Cipher Shopping Website Registeration</h1></center></b><br>
</header>

<center>
<form method="POST">
<table>
<tr>
<th>FIRST NAME : </th>
<td><input type="text" name="fname" id="fname"></td>
</tr>
<tr>
<th>LAST NAME : </th>
<td><input type="text" name="lname" id="lname"></td>
</tr>
<tr>
<th>ADDRESS : </th>
<td><input type="text" name="address" id="address"></td>
</tr>
<tr>
<th>PINCODE : </th>
<td><input type="text" name="pincode" id="pincode"></td>
</tr>
<tr>
<th>PHONE NUMBER : </th>
<td><input type="text" name="phone" id="phone"></td>
</tr>
<tr>
<th>USERNAME : </th>
<td><input type="text" name="user" id="user"></td>
</tr>
<tr>
<th>PASSWORD : </th>
<td><input type="password" name="pass" id="pass"></td>
</tr>
<tr>
<th>CONFIRM PASSWORD : </th>
<td><input type="password" name="cpass" id="pass"></td>
</tr>
<tr>
<th></th>
<td><input type="submit" name="submit" value="Register">   <input type="reset" name="reset" value="CLEAR"></td>
</tr>
<tr>
<th></th>
<td><a href="login.php">ALREADY REGISTERED?</a></td>
</tr>
</table>
</form>
</center>

<?php $name=$pass=$cpass="";






if(isset($_POST["submit"]))
{
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$address=$_POST["address"];
$pincode=$_POST["pincode"];
$phone=$_POST["phone"];
$user=$_POST["user"];
$pass=$_POST["pass"];
$cpass=$_POST["cpass"];
$flag=0;
if(empty($user) && empty($pass) && empty($cpass))
{
echo "<script>alert('PLEASE ENTER USERNAME & PASSWORD ..... !!!');</script>";
$flag=1;
}
else if(empty($user))
{
echo "<script>alert('PLEASE ENTER USERNAME ..... !!!');</script>";
$flag=1;
}
else if(empty($pass))
{
echo "<script>alert('PLEASE ENTER PASSWORD ..... !!!');</script>";
$flag=1;
}
else if(empty($cpass))
{
echo "<script>alert('PLEASE ENTER CONFIRM PASSWORD ..... !!!');</script>";
$flag=1;
}
else if($pass != $cpass)
{
echo "<script>alert('PLEASE CONFIRM THE PASSWORD ..... !!!');</script>";
$flag=1;
}
else
{
$m = new MongoClient();
$db = $m->ecommerce;
$coll = $db->login;
$cursor = $coll->find();
foreach ($cursor as $obj)
{
if($obj['user']==$user)
{
echo "<script>alert('USERNAME ALREADY EXISTS ..... !!!');</script>";
$flag=1;
}
}
if($flag==0)
{
$doc=array('user'=>$user,'pass'=>$pass, 'fname'=>$fname,'lname'=>$lname, 'address'=>$address,'pincode'=>$pincode,'phone'=>$phone);
$coll->insert($doc);
echo "<script>alert('REGISTERATION SUCCESSFUL ..... !!!'); window.location.assign('login.php')</script>";
}
}
}
?>
</body>
</html>