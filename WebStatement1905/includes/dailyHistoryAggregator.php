<?php
// napra szűrt adatok kiegészítése a teljes range-ben szereplő napokra és tömbösítése hónapokra
function dailyHistoryAggregator()
{
    global $dayArr;
    global $dayFilteredHistory;
    global $dailyHistory;
    global $startDay;

    $filterCnt = 0;
    $dCnt = 0;

    for ($i = 0; $i < count($dayArr); $i++) {
        if ($filterCnt < count($dayFilteredHistory) - 1) { // vége az adatnak.
            if ($dayFilteredHistory[$filterCnt + 1]['date'] == $dayArr[$i]) {

                $filterCnt++;
            }
        }

        if (date_create($dayArr[$i]) >= date_create($startDay)) {
            $dailyHistory['date'][$dCnt] = '"' . str_replace("-", ".", $dayArr[$i]) . '"';
            $dailyHistory['fullDepo'][$dCnt] = $dayFilteredHistory[$filterCnt]['fullDepo'];
            $dailyHistory['fee'][$dCnt] = $dayFilteredHistory[$filterCnt]['fee'];
            $dailyHistory['dividend'][$dCnt] = $dayFilteredHistory[$filterCnt]['dividend'];
            $dailyHistory['balance'][$dCnt] = $dayFilteredHistory[$filterCnt]['balance'];
            $dailyHistory['manual'][$dCnt] = $dayFilteredHistory[$filterCnt]['manual'];
            $dailyHistory['robot'][$dCnt] = $dayFilteredHistory[$filterCnt]['robot'];
            $dailyHistory['hozam'][$dCnt] = $dayFilteredHistory[$filterCnt]['hozam'];
            $dCnt++;
        }
    }
}
