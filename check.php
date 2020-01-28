<!DOCTYPE html>
<html>
<head>
    <title>response</title>
    <meta charset="utf-8">
</head>
<body>

<?php

$start = microtime(true);

date_default_timezone_set("UTC");
if (array_key_exists("offset", $_POST)) {
    $OFFSET = $_POST["offset"];
} else $OFFSET = 0;
//$time = time() + 3 * 3600;
echo "<p id='time'>Текущее время: " . date("d.m.Y, G:i:s", $start - $OFFSET / 60 * 3600) . "</p>";

if (!isset($_POST['x']) || !isset($_POST['y']) || !isset($_POST['r'])) die ("Вы выбрали не все переменные");

$x = $_POST['x'];
$y = $_POST['y'];
$r = $_POST['r'];

if (!preg_match('/(?<![\.\d])\d+(?![\.\d])/', $x) || !is_numeric($y) || !preg_match('/(?<![\.\d])\d+(?![\.\d])/', $r) || $x < -5 || $x > 3 || $y < -5 || $y > 3 || $r < 1 || $r > 5)
    die ("<p id = 'scriptError'>ATTENTION!</p> <p id = 'scriptError'>X и R должны быть целыми числами, x от -5 до 3, r от 1 до 5. Y числом  от -5 до 3.</p>");

if ($y >= 0 && $x >= 0 && $y ** 2 + $x ** 2 <= $r ** 2 || $y >= 0 && $y <= $r && $x <= 0 && $x >= (-$r / 2) || $y <= 0 && $x <= 0 && $y + $x >= -$r) {
    echo '<p id = "script"> Точка (' . $x . '; ' . $y . ') при параметре R = ' . $r . ' попала в закрашенную область! </p>';
} else {
    echo '<p id = "script"> Точка (' . $x . '; ' . $y . ') при параметре R = ' . $r . ' не попала в закрашенную область! </p>';
}

$t = (float)round((microtime(true) - $start), 4);
if ($t == 0) $t = "менее 0.0001";
echo "Время работы скрипта: " . $t . " сек<br>";

?>
</body>
</html>