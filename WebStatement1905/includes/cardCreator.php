<?php

function singleCardRow($category, $value, $isNeutral = false){
    $profitClass = "neutral";
    if(!$isNeutral){
        if($value > 0){$profitClass = "profit";}
        if($value < 0){$profitClass = "loss";}
    }
    $value = number_format($value, 0, ',', ' ');
    echo ("<div class=\"stat-row\">
            <div class=\"category\">$category:</div>
            <h4 class=\"value $profitClass\">$value<span class=\"ft $profitClass\">Ft</span></h4>
        </div>");
}