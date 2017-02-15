<?php
$id = isset($id) ? intval($id) : '';

$sql="SELECT * FROM `{$dbpre}arcticle` WHERE id = '$id'";
$query=$db->query($sql);
$news=$db->fetch_array($query);






xm_assign(
		   array(
				 'news',

				 ),
		   array(
				 $news,

				 )
		   );

?>