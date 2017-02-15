<?php
@$act = $_GET['a'];
if ('goa' == $act) {
    $url = './5010/';
} else if ('gweb' == $act) {
    $url = './6010/';
} else if ('test' == $act) {
    $url = './5010/';
} else if ('jmyl' == $act) {
    $url = './3010/';
} else {
    $url = './index.htm';
}

header('location:' . $url);
exit();
?>