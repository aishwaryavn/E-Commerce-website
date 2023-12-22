<?php
if(isset($_GET['id'])){
$m = new MongoClient();
					$db = $m->ecommerce;
					$coll = $db->product;
$id = $_GET['id'];

// will work:
$coll->remove(array('_id' => new MongoId($id)));
echo "Succussfully removed ".$id;
}
?>
<?php    
header('Location: remove_product.php');    
?>
