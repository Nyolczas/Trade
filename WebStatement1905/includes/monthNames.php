<?php

function monthNames($mn, $isShort = true)
{
    switch ($mn) {
        case 1:
            if ($isShort) {
                return "jan";
            } else {
                return "Január";
            }
            break;

        case 2:
            if ($isShort) {
                return "febr";
            } else {
                return "Február";
            }
            break;

        case 3:
            if ($isShort) {
                return "márc";
            } else {
                return "Március";
            }
            break;

        case 4:
            if ($isShort) {
                return "ápr";
            } else {
                return "Április";
            }
            break;

        case 5:
            if ($isShort) {
                return "máj";
            } else {
                return "Május";
            }
            break;

        case 6:
            if ($isShort) {
                return "júni";
            } else {
                return "Június";
            }
            break;

        case 7:
            if ($isShort) {
                return "júli";
            } else {
                return "Július";
            }
            break;

        case 8:
            if ($isShort) {
                return "aug";
            } else {
                return "Augusztus";
            }
            break;

        case 9:
            if ($isShort) {
                return "szept";
            } else {
                return "Szeptember";
            }
            break;

        case 10:
            if ($isShort) {
                return "okt";
            } else {
                return "Október";
            }
            break;

        case 11:
            if ($isShort) {
                return "nov";
            } else {
                return "November";
            }
            break;

        case 12:
            if ($isShort) {
                return "dec";
            } else {
                return "December";
            }
            break;
    }
}
