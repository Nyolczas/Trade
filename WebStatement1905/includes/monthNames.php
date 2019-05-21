<?php

function monthNames($mn, $isShort = true){
    switch($mn){
        case 1:
        if($isShort){
            return "jan";
        }else{
            return "Január";
        }
        break;
    }
    switch($mn){
        case 2:
        if($isShort){
            return "febr";
        }else{
            return "Február";
        }
        break;
    }
    switch($mn){
        case 3:
        if($isShort){
            return "márc";
        }else{
            return "Március";
        }
        break;
    }
    switch($mn){
        case 4:
        if($isShort){
            return "ápr";
        }else{
            return "Április";
        }
        break;
    }
    switch($mn){
        case 5:
        if($isShort){
            return "máj";
        }else{
            return "Május";
        }
        break;
    }
    switch($mn){
        case 6:
        if($isShort){
            return "júni";
        }else{
            return "Június";
        }
        break;
    }
    switch($mn){
        case 7:
        if($isShort){
            return "júli";
        }else{
            return "Július";
        }
        break;
    }
    switch($mn){
        case 8:
        if($isShort){
            return "aug";
        }else{
            return "Augusztus";
        }
        break;
    }
    switch($mn){
        case 9:
        if($isShort){
            return "szept";
        }else{
            return "Szeptember";
        }
        break;
    }
    switch($mn){
        case 10:
        if($isShort){
            return "okt";
        }else{
            return "Október";
        }
        break;
    }
    switch($mn){
        case 11:
        if($isShort){
            return "nov";
        }else{
            return "November";
        }
        break;
    }
    switch($mn){
        case 12:
        if($isShort){
            return "dec";
        }else{
            return "December";
        }
        break;
    }
}