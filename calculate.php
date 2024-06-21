<?php
function mappe_function($x, $y, $sc) {
    $dic_4 = array(1 => "A", 11 => "B", 0 => "C", 10 => "D");
    $dic_16 = array(3 => "a", 13 => "b", 23 => "c", 33 => "d", 2 => "e", 12 => "f", 22 => "g", 32 => "h", 1 => "i", 11 => "j", 21 => "k", 31 => "l", 0 => "m", 10 => "n", 20 => "o", 30 => "p");

    $qx_20000 = floor($x / 18000);
    $qy_20000 = floor($y / 12000);
    $org_20000 = array($qx_20000 * 18000, $qy_20000 * 12000);

    $x_10000 = $x - $org_20000[0];
    $y_10000 = $y - $org_20000[1];
    $qx_10000 = floor($x_10000 / 9000);
    $qy_10000 = floor($y_10000 / 6000);
    $res_10000 = 10 * $qx_10000 + $qy_10000;

    $x_5000 = $x_10000;
    $y_5000 = $y_10000;
    $qx_5000 = floor($x_5000 / 4500);
    $qy_5000 = floor($y_5000 / 3000);
    $res_5000 = 10 * $qx_5000 + $qy_5000;

    $x_2000 = $x_10000;
    $y_2000 = $y_10000;
    $qx_2000 = floor($x_2000 / 1800);
    $qy_2000 = floor($y_2000 / 1200);
    $res_2000 = 10 * (9 - $qy_2000) + $qx_2000 + 1;

    $x_1000 = $x - $org_20000[0] - $qx_2000 * 1800;
    $y_1000 = $y - $org_20000[1] - $qy_2000 * 1200;
    $qx_1000 = floor($x_1000 / 900);
    $qy_1000 = floor($y_1000 / 600);
    $res_1000 = 10 * $qx_1000 + $qy_1000;

    $x_500 = $x_1000;
    $y_500 = $y_1000;
    $qx_500 = floor($x_500 / 450);
    $qy_500 = floor($y_500 / 300);
    $res_500 = 10 * $qx_500 + $qy_500;

    $x_200 = $x_1000;
    $y_200 = $y_1000;
    $qx_200 = floor($x_200 / 180);
    $qy_200 = floor($y_200 / 120);
    $res_200 = 10 * (9 - $qy_200) + $qx_200 + 1;

    $x_100 = $x - $org_20000[0] - $qx_2000 * 1800 - $qx_200 * 180;
    $y_100 = $y - $org_20000[1] - $qy_2000 * 1200 - $qy_200 * 120;
    $qx_100 = floor($x_100 / 90);
    $qy_100 = floor($y_100 / 60);
    $res_100 = 10 * $qx_100 + $qy_100;

    if ($sc == 20000) {
        $mappe_ = sprintf("%02d-%02d", $qy_20000 + 1, $qx_20000 + 1);
    } elseif ($sc == 10000) {
        $mappe_ = sprintf("%02d-%02d-%s", $qy_20000 + 1, $qx_20000 + 1, $dic_4[$res_10000]);
    } elseif ($sc == 5000) {
        $mappe_ = sprintf("%02d-%02d-%s", $qy_20000 + 1, $qx_20000 + 1, $dic_16[$res_5000]);
    } elseif ($sc == 2000) {
        $mappe_ = sprintf("%02d-%02d-%02d", $qy_20000 + 1, $qx_20000 + 1, $res_2000);
    } elseif ($sc == 1000) {
        $mappe_ = sprintf("%02d-%02d-%02d-%s", $qy_20000 + 1, $qx_20000 + 1, $res_2000, $dic_4[$res_1000]);
    } elseif ($sc == 500) {
        $mappe_ = sprintf("%02d-%02d-%02d-%s", $qy_20000 + 1, $qx_20000 + 1, $res_2000, $dic_16[$res_500]);
    } elseif ($sc == 200) {
        $mappe_ = sprintf("%02d-%02d-%02d-%02d", $qy_20000 + 1, $qx_20000 + 1, $res_2000, $res_200);
    } elseif ($sc == 100) {
        $mappe_ = sprintf("%02d-%02d-%02d-%02d-%s", $qy_20000 + 1, $qx_20000 + 1, $res_2000, $res_200, $dic_4[$res_100]);
    }

    return $mappe_;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $x = intval($_POST['x']);
    $y = intval($_POST['y']);
    $sc = intval($_POST['sc']);

    $result = mappe_function($x, $y, $sc);
    echo json_encode(array("result" => $result));
}
?>
