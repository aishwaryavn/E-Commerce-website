<?php
session_start();

?>
<!DOCTYPE>

<html>
	<head>
	<title>My Online Shopping Website</title>
	
	<link rel="stylesheet" href="css/style.css" media="all" />
	
	</head>
	
	<body>
	
	<!--Main Container starts here-->
	
	<div class="main_wrapper">
	
	<!--Header Container starts here-->
	<div class="header_wrapper">   
	
		<img id="logo" src="images/logo.png" />
		<img id="banner" src="images/ad_banner.jpg">

	</div>
	<!--Header ends here-->
	
	<!--Navigation starts here-->
	<div class="menubar">
	
		<ul id="menu">
			<li> <a href="main.php">Home</a></li>
			<li> <a href="main.php">All Product</a></li>
			<li> <a href="insert_product.php">Insert a Product</a></li>
			<li> <a href="#">My Account</a></li>
			<li> <a href="#">Sign Up</a></li>
			<li> <a href="#">Shopping Cart</a></li>
			<li> <a href="#">Contact Us</a></li>
		
		</ul>
		
		<div id="form">
		
		<form method="get" action="results.php" enctype="multipart/form-data">
			<input type="text" name="user_query" placeholder="Search a Product"/>
			<input type="submit" name="search" value="Search"/>
		</form>
		
		</div>
		
		
	</div>
	<!--Navigation ends here-->
	
	<!--Content starts here-->
	<div class="content_wrapper">
		
		<!--Sidebar starts here-->
		<div id="sidebar">
		
		<div id="sidebar_title">Product</div>
		
		<ul id="cats">
				<?php

					$m = new MongoClient();
					$db = $m->ecommerce;
					$coll = $db->product;
					$cursor = $coll->find();
					$num_docs = $cursor->count();
					if( $num_docs > 0 )
		{
        // loop over the results
        foreach ($cursor as $obj)
        {
			$pro_id=$obj['product id'];
			$pro_name=$obj['product name'];
			echo "<li><font color='white'><a href='details.php?pro_id=$pro_id'>$pro_name</font></li>";	
		}
		}
		?>
		</ul>
		
		
		
		</div>
		
	
		<div id="content_area"> 

		
		
			<div id="shopping_cart">
			
			<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
			
			Welcome <?php echo $_SESSION['fname'];echo " ".$_SESSION['lname'];?>! <b style="color:yellow">Shopping Cart-</b>
			Total Item-<?php $m = new MongoClient();$db = $m->ecommerce;$coll = $db->cart;$cursor=$coll->find();$product_item=$cursor->count();echo $product_item;?> 
			
			
			Total Price- <?php 
			$m = new MongoClient();
			$db = $m->ecommerce;
			$coll = $db->cart;
			$cursor=$coll->find();
			
			$pro_price=0;
			foreach ($cursor as $obj)
			{

				$pro_price+=$obj['product price'];
				}
				echo $pro_price;
			
			
			
			?>
			
			
			
			<a style="color:yellow" href="cart.php"> &nbsp;Go To Cart</a>
			
			
			</span>
			
			
			</div>
			

			<div id="product_box1">

			
			
			

<?php
		
				
					
					
					$m = new MongoClient();
					$db = $m->ecommerce;
					$coll = $db->cart;
					$cursor = $coll->find();
					echo 'Order Details<br>';
					
					foreach ($cursor as $obj)
				{
					$buyer_fname=$_SESSION['fname'];
					$buyer_lname=$_SESSION['lname'];
					$buyer_address=$_SESSION['address'];
					$buyer_pincode=$_SESSION['pincode'];
					$buyer_phone=$_SESSION['phone'];
					$p_id=$obj['product id'];
					$p_name=$obj['product name'];
					$p_price=$obj['product price'];
					$today = new MongoDate(strtotime(date('Y-m-d 00:00:00')));
					$doc=array(
					'buyer fname'=>$buyer_fname,
					'buyer lname'=>$buyer_lname, 
					'buyer address'=>$buyer_address,
					'buyer pincode'=>$buyer_pincode,
					'buyer phone'=>$buyer_phone,
					'buyer purchase pro_id'=>$p_id,
					'buyer purchase pro_name'=>$p_name,
					'buyer purchase pro_price'=>$p_price,
					'purchase date' => $today
					);
					$m = new MongoClient();
					$db = $m->ecommerce;
					$collection = $db->payment;
					$collection->insert($doc);
				
				}
					
				
				
			
		



				
					$collection = $m->ecommerce->cart;
				$collection->drop();


?>
			<?php
		
				
					
					
					$m = new MongoClient();
					$db = $m->ecommerce;
					$coll = $db->payment;
				
					$cursor = $coll->find();
					$p_id=1;
			
					foreach ($cursor as $obj)
				{
					
					$p_name=$obj['buyer purchase pro_name'];
					$p_price=$obj['buyer purchase pro_price'];
					$buyer_fname=$obj['buyer fname'];
					$buyer_lname=$obj['buyer lname'];
					$buyer_address=$obj['buyer address'];
					$buyer_pincode=$obj['buyer pincode'];
					$buyer_phone=$obj['buyer phone'];
					
					//$p_img=$obj['product img'];
					echo"
					<div id='single_product1'>
					<h4><b>Item Number: $p_id</b></h4>
					<h4><b>Product Name: $p_name</b></h4>
					
					<h4><b>Product Price:&#8377; $p_price</b></h4>
					<h4><b>Full Name:$buyer_fname&nbsp; $buyer_lname<b></h4>
					<h4><b>Address:$buyer_address<br> $buyer_pincode<br>Phone:$buyer_phone<br><b></h4>
					
					
					
					</div>";
					echo 'Purchase Date:'.date(DATE_RFC2822);
					$p_id++;
				}
			
				?>
			
</div>

			</div>
		</div>
		
		</div>
		
	
		<div id="footer">     

			<h2 style="text-align:center; padding-top:30px">&copy; 2016 by www.professionalcipher.blogspot.com </h2>



		</div>
	
	
	</div>
	
	<!--Main Container ends here-->
	
	</body>
	
</html>