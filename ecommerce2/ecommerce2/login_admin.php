<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>LOGIN</title>
<link rel="stylesheet" href="css/style.css" media="all" />
</head>
<body>
<header>
<div class="main_wrapper">
<!--Header Container starts here-->
	<div class="header_wrapper">   
	
	
		<img id="banner" src="images/ad_banner.jpg">

	</div>
</div>
<b><center><h1>LOGIN</h1></center></b>
<br>
</header>

<center>
<form method="POST">
<table>
<tr>
<th>USERNAME : </th>
<td><input type="text" name="user" id="user"></td>
</tr>
<tr>
<th>PASSWORD : </th>
<td><input type="password" name="pass" id="pass"></td>
</tr>
<tr>
<th></th>
<td><input type="submit" name="submit" value="LOGIN"><input type="reset" name="reset" value="CLEAR"></td>
</tr>
</table>
</form>
</center>
<?php 
$m = new MongoClient();
$db = $m->ecommerce;
$coll = $db->cart;



				$coll->drop();
?>

<?php $name=$pass="";

if(isset($_POST["submit"]))
{
$user=$_POST["user"];
$pass=$_POST["pass"];
if(empty($user) && empty($pass))
{
echo "<script>alert('PLEASE ENTER USERNAME & PASSWORD ..... !!!');</script>";
}
else if(empty($user))
{
echo "<script>alert('PLEASE ENTER USERNAME ..... !!!');</script>";
}
else if(empty($pass))
{
echo "<script>alert('PLEASE ENTER PASSWORD ..... !!!');</script>";
}
else
{
$m = new MongoClient();
$db = $m->ecommerce;
$coll = $db->login;
$cursor = $coll->find();
$user_name="cipher";
$password="cipher";

if($user_name==$user && $password==$pass && $_GET['id']==1)
{
echo "<script>window.location.assign('insert_product.php')</script>";
}
if($user_name==$user && $password==$pass && $_GET['id']==2)
{
echo "<script>window.location.assign('remove_product.php')</script>";
}

}
echo "<script>alert('WRONG USERNAME & PASSWORD ..... !!!');</script>";
}


?>
</body>
</html>