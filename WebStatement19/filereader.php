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

function processDepo() {
    $depoArr = [];
    // $depoArr[0][0] = "dátum";
    // $depoArr[0][1] = "depó";
    // $depoArr[0][2] = "költség";
    // $depoArr[0][3] = "osztalék";

    $tempDate = 0;
    $tempDepo = 0;
    $tempFee = 0;
    $tempDiv = 0;

    $counter = 0;

    $first = true;
     if (($handle = fopen('mt4data/depoHistory.csv', 'r')) !== FALSE) { // Check the resource is valid
         
         while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { // Check opening the file is OK!

            if($first) {
                $first=false;
            } else {
                if($tempDate == substr($data[0], 0, -6)) {
                    //echo  substr($data[0], 0, -6).'<br>';
                    //echo  $data[1].'<br>';
                    //echo  substr($data[2], 0, 3).'<br>';
                    if(substr($data[2], 0, 3) == 'Tra' || substr($data[2], 0, 3) == 'Dep') {
                        $tempDepo += $data[1];  
                    } else if (substr($data[2], 0, 3) == 'Fee') {
                        $tempFee += $data[1];
                    } else if (substr($data[2], 0, 3) == 'Adj') {
                        $tempDiv += $data[1];
                    }
                } else {
                    array_push($depoArr,[$tempDate, $tempDepo, $tempFee, $tempDiv]);
                    $tempDate =  substr($data[0], 0, -6);

                    if(substr($data[2], 0, 3) == 'Tra' || substr($data[2], 0, 3) == 'Dep') {
                        $tempDepo += $data[1];  
                    } else if (substr($data[2], 0, 3) == 'Fee') {
                        $tempFee += $data[1];
                    } else if (substr($data[2], 0, 3) == 'Adj') {
                        $tempDiv += $data[1];
                    }
                }
            }
       }
         fclose($handle);
     }
     
     var_dump($depoArr);
}

//processDepo();