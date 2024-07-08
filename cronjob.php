<?php
//connect to the database
require ("mysqli_connect.php");
//download the history.csv
$history = shell_exec("curl -s -b cookies.txt https://travelynx.de/history.csv");

if (str_starts_with($history, 'Zugtyp,Linie,Nummer,Start,Ziel,"Start (DS100)","Ziel (DS100)","Abfahrt (soll)","Abfahrt (ist)","Ankunft (soll)","Ankunft (ist)",Kommentar,ID')) {
    //escape everything surrounded by double quotes 
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
    unset($str); //$str is no longer needed so we destroy it
//take each row out of the csv string and add them to a array
    $history = str_getcsv($history, "\n");
    //remove the first row containing only headings
    array_shift($history);

    array_walk(
        $history,
        function (&$row) {
            //add every field an a row to an array
            $row = str_getcsv($row, ",");
            //all the conversion is done, so we can return the escaped caracters to a readable format
            $row = str_replace("\rC", ',', $row);
            $row = str_replace("\rQ", '"', $row);
            $row = str_replace("\rN", "\n", $row);
            $row = str_replace("\rR", "\r", $row);
            return $row;
        }
    );
    unset($row); //$row is no longer needed so we destroy it
//create a string of placeholders for the query 
    $place_holders = implode(',', array_fill(1, 13, '?'));
    //prepare the query 
    $query = $conn->prepare("INSERT IGNORE INTO `$table` VALUES ($place_holders)");
    //add each journey to the database 
    foreach ($history as $journey) {
        $query->execute($journey);
    }
} else {
    file_put_contents(
        "logfile.txt",
        "fatal Error: received File is not a travelynx csv export \n If you see a html webpage your login cookie has most likely expired \n recreate the cookies.txt to resolve \n Data received: \n" . $history
    );
    die("fatal Error: received file is not a travelynx csv export \n check logfile.txt for more details");
}