<?php
$table = "travelynx";
require ("mysqli_connect.php");

$history = shell_exec("curl -s -b cookies.txt https://travelynx.de/history.csv");

$history = preg_replace_callback('/([^"]*)("((""|[^"])*)"|$)/s', function ($matches) {
    $str = "";
    if (isset($matches[3])) {
        $str = str_replace("\r", "\rR", $matches[3]);
        $str = str_replace("\n", "\rN", $str);
        $str = str_replace('""', "\rQ", $str);
        $str = str_replace(',', "\rC", $str);

    }
    return preg_replace('/\r\n?/', "\n", $matches[1]) . $str;
}, $history);
unset($str);
$history = str_getcsv($history, "\n");

array_shift($history);

array_walk(
    $history,
    function (&$row) {
        $row = str_getcsv($row, ",");
        $row = str_replace("\rC", ',', $row);
        $row = str_replace("\rQ", '"', $row);
        $row = str_replace("\rN", "\n", $row);
        $row = str_replace("\rR", "\r", $row);
        return $row;
    }
);
unset($row);

$place_holders = implode(',', array_fill(1, 13, '?'));
$query = $conn->prepare("INSERT IGNORE INTO `$table` VALUES ($place_holders)");

foreach ($history as $journey) {
    $query->execute($journey);
}