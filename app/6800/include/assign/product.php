<?php
$id = isset($id) ? intval($id) : '';

$sql="SELECT * FROM `{$dbpre}product` WHERE id = '$id'";
$query=$db->query($sql);
$product=$db->fetch_array($query);






xm_assign(
		   array(
				 'product',

				 ),
		   array(
				 $product,

				 )
		   );

?>