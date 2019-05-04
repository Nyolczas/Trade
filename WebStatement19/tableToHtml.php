<?php
function tableToHtml($file) {
    $first = true;
     if (($handle = fopen($file, 'r')) !== FALSE) { // Check the resource is valid
        echo ('<table>'); 
         while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { // Check opening the file is OK!
            echo('<tr>');
            if($first) {
                foreach ($data as $value) {
                    echo('<th>'.$value.'</th>');
                }
                $first=false;
            } else {
                foreach ($data as $value) {
                    echo('<td>'.$value.'</td>');
                }
            }
            echo('</tr>');
             //print_r($data); // Array
       }
       echo ('</table>'); 
         fclose($handle);
     }
}

tableToHtml('mt4data/FullHistory_27019217.csv');