<?php
// mt4 jelentés betöltése a historyArray tömbbe
function readMt4Data($file)
{
    global $historyArray;
    $first = true;
    if (($handle = fopen($file, 'r')) !== false) { // Check the resource is valid

        while (($data = fgetcsv($handle, 1000, ";")) !== false) { // Check opening the file is OK!

            if ($first) {
                $first = false;
            } else {
                $row = [];
                foreach ($data as $value) {
                    array_push($row, $value);
                }
                array_push($historyArray, $row);
            }
        }
        fclose($handle);
    }
}
