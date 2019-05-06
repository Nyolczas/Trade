<?php

// --- robot stratégiák kiszedése
$a = ['classic', 'tsq', 'zoom', 'classic', 'tsq', 'tsq', 'zoom', 'msr', 'msr'];

$res = array_unique($a);
sort($res);

print_r($res);

// --- hónapok listázása
$startDate = date_create('2019-03-25');

$month = intval(date_format($startDate, "m"));

var_dump($month);