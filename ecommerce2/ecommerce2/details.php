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
			
			<span style="float:right; font-size:15px; padding:5px; line-height:40px;">
			
			Welcome <?php echo $_SESSION['fname'];echo " ".$_SESSION['lname'];?>! <b style="color:yellow">! <b style="color:yellow">Shopping Cart-</b>Total Item-<?php $m = new MongoClient();$db = $m->ecommerce;$coll = $db->cart;$cursor=$coll->find();$product_item=$cursor->count();echo $product_item;?> 
			
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
			
			
			
			
			<a href="cart_display.php">Go To Cart</a>
			
			
			</span>
			
			
			</div>

		

				<?php
				
				if(isset($_GET['pro_id'])){
					
					$product_id=$_GET['pro_id'];

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
			if($obj['product id']==$product_id)
			{
			$pro_id=$obj['product id'];
			$pro_name=$obj['product name'];
			$pro_desc=$obj['product desc'];
			$pro_img=$obj['product image'];
			$pro_price=$obj['product price'];
			
			echo "
				<div id='single_product'>
					<h3>$pro_name</h3>
					<img src='product_images/$pro_img' height='180' width='180'/>
					<h4>Price: &#8377; $pro_price</h4>
					<h5>$pro_desc</h5>
					<a href='main.php' style='float:left;'>Go Back</a>
					<a href='cart.php?add_cart=$pro_id&pro_price=$pro_price&pro_name=$pro_name&pro_img=$pro_img'><button style='float:right'>Add To Cart</button></a>
				</div>
			
			";
			}
            
        }
    }
    else
    {
        
        echo "No products found \n";
    }
				}
?>
			
		</div>
		
		</div>
		
	
		<div id="footer">     

			<h2 style="text-align:center; padding-top:30px">&copy; 2016 by www.professionalcipher.blogspot.com </h2>


		</div>
	
	
	</div>
	
	<!--Main Container ends here-->
	
	</body>
	
</html>




		