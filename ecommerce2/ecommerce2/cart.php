<?php
session_start();
?>
<?php
		
			if(isset($_GET['add_cart'])){
				$product_id=$_GET['add_cart'];
				$m = new MongoClient();
					$db = $m->ecommerce;
					$coll = $db->product;
					$cursor = $coll->find();
					foreach ($cursor as $obj)
				{
				
					
				
					$product_name=$_GET['pro_name'];
					$product_desc=$_GET['pro_desc'];
					$product_img=$_GET['pro_img'];
				}
			
			
			
			
			}
		
			
				if(isset($_GET['add_cart'])){
					
					$product_id=$_GET['add_cart'];
					$product_price=$_GET['pro_price'];
					$product_name=$_GET['pro_name'];
					$product_desc=$_GET['pro_desc'];
					$product_img=$_GET['pro_img'];
					$m = new MongoClient();
					$db = $m->ecommerce;
					$coll = $db->cart;
					
					$insert_pro=array('product id'=>$product_id,'product name'=> $product_name,'product desc'=>$product_desc,'product price'=> $product_price,'product img'=> $product_img);
				$coll->insert($insert_pro);
				
				
				}
				?>
				<?php    
header('Location: main.php');    
?>