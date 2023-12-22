<!DOCTYPE>

<html>
	<head>
		<title>Remove Product</title>
		
		<style>
				.header_wrapper{
							width:1000px;
							height:100px;
							margin:auto;
								}
				.main_wrapper{
							width:1000px;
							height:auto;
							margin:auto;
							}
		</style>
	</head>
	<body bgcolor="skyblue">
	

	<div class="main_wrapper">
	<!--Header Container starts here-->
	<div class="header_wrapper">   
	
		<img id="banner" src="images/ad_banner.png">

	</div>
	</div>
	<div>
		
		<table align="center" width="700" border="8" bgcolor="pink">
		<tr align="center">
				<td><form action="main.php"><button type="submit">Home</button></form></td>
			</tr>
		</table>
	</div>
	
	</body>

</html>

<?php

$m = new MongoClient();
$db = $m->ecommerce;
$coll = $db->product;
$cursor=$coll->find();
$product_id=$cursor->count();
$product_id++;

		
foreach ($cursor as $obj)
        {
			$id=$obj['_id'];
			$pro_id=$obj['product id'];
			$pro_name=$obj['product name'];
			$pro_desc=$obj['product desc'];
			$pro_img=$obj['product image'];
			$pro_stock=$obj['product stock'];
			$pro_price=$obj['product price'];

	echo "
		<form>
		<table align='center' width='700' border='2' bgcolor='white'>
			
			
			<tr align='center'>
				<td colspan='8'><h2>Inserted Product Details</h2></td>
			</tr>
			
			<tr>
				<td align='right'><b>Product ID:</b></td>
				<td>$pro_id</td>
			</tr>
			<tr>
				<td align='right'><b>Product Name:</b></td>
				<td>$pro_name</td>
			</tr>
			<tr>
				<td align='right'><b>Product Description:</b></td>
				<td>$pro_desc</td>
			</tr>
			<tr>
				<td align='right'><b>Product Image:</b></td>
				<td><img src='product_images/$pro_img' height='180' width='180'/><td/>
			</tr>
			<tr>
				<td align='right'><b>Product Price:</b></td>
				<td>$pro_price<td/>
			</tr>
			<tr>
				<td align='right'><b>Product Stock:</b></td>
				<td>$pro_stock<td/>
			</tr>
		
				
			
		</table>
	
		</form> 
		<center><a href='remove1.php?id=$id'><button>Remove</button></a></center>
		";
	
		}
	
	

?>

