<?php
function act_date($date0) {

    $date0 = str_replace(' ', '', $date0);
    $date0 = str_replace('　', '', $date0);
    $date0 = str_replace(',', '-', $date0);
    $date0 = str_replace('，', '-', $date0);
    $date0 = str_replace('．', '-', $date0);
    $date0 = str_replace('。', '-', $date0);
    $date0 = str_replace('.', '-', $date0);
    $date0 = str_replace('/', '-', $date0);

    if ($date0 == '') {
        $year  = '00';
        $month = '00';
        $day   = '00';
    } else if (stristr($date0, '-')) {
        $array = explode('-', $date0);
        $year  = $array[0];
        $month = $array[1];
        $day   = @$array[2];
    } else if (stristr($date0, '年')) {
        $array = explode('年', $date0);
        $year  = $array[0];
        $month = $array[1];
        $array = explode('月', $month);
        $month = $array[0];
        $day   = $array[1];
        $array = explode('日', $day);
        $day   = $array[0];
    } else if (strlen($date0) == 8) {
        $year  = substr($date0, 0, 4);
        $month = substr($date0, 4, 2);
        $day   = substr($date0, 6, 2);
    } else if (strlen($date0) == 6) {
        $year  = substr($date0, 0, 2);
        $month = substr($date0, 2, 2);
        $day   = substr($date0, 4, 2);
    } else if (strlen($date0) == 4) {
        $year  = $date0;
        $month = '01';
        $day   = '01';
    } else {
        $year  = '00';
        $month = '00';
        $day   = '00';
    }

    if (strlen($year) == 2 && is_int($year)) {
        $year  = '19' . $year;
    }

    if (!$month) {
        $month = '01';
    } else if (strlen($month) == 1) {
        $month = "0".$month;
    }
    if($month<01 || $month>12) {
        $month = '01';
    }

    if (!$day) {
        $day = '01';
    } else if (strlen($day) == 1) {
        $day = "0".$day;
    }
    if($day<01 || $day>31) {
        $day = '01';
    }

    $timestamp = mktime('00', '00', '00', $month, $day, $year);
    $date1 = date("Y-m-d",$timestamp);
    return $date1;
}
?>
