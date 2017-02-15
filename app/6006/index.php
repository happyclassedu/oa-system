<?php
@$act = $_GET['a'];
if ('act' == $act) {
    $url = './act/';
} else {
    $url = './www/';
}

header('location:' . $url);
exit();
?>