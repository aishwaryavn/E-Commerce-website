<?php
if(isset($_GET['id'])){
$m = new MongoClient();
					$db = $m->ecommerce;
					$coll = $db->cart;
$id = $_GET['id'];

// will work:
$coll->remove(array('_id' => new MongoId($id)));
echo "Succussfully removed ".$id;
}
?>
