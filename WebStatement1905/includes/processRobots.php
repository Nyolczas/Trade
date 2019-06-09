<?php
require 'routes.php';
$admLiveRobotSyms = robotDirs($admLivePath);
$admDemoRobotSyms = robotDirs($admDemoPath);
$admRobotSyms = array_union($admLiveRobotSyms, $admDemoRobotSyms);

$xmLiveRobotSyms = robotDirs($xmLivePath);
$xmDemoRobotSyms = robotDirs($xmDemoPath);
$xmRobotSyms = array_union($xmLiveRobotSyms, $xmDemoRobotSyms);


print_r($admLiveRobotSyms);
print_r($admDemoRobotSyms);
print_r($admRobotSyms);

print_r($xmLiveRobotSyms);
print_r($xmDemoRobotSyms);
print_r($xmRobotSyms);

//--- napi csv adatok beolvasása és chart adattá alakítása

//======--- Funkciók
//--- Könyvtár szűrés (a robotok által kereskedett instrumentumokat adja vissza)
function dirFilter($var)
{
    if ($var == '.' || $var == '..' || $var == 'strategies' || $var == 'robot' || $var == 'manual' || substr($var, -4) == '.csv') {
        return false;
    } else {
        return true;
    }
}

//--- Robot instrumentumok meghatározása számlánként
function robotDirs($path)
{
    $destRobots = array();
    $accountDirs = scandir($path, 2);

//--- robots:
    $tempDirs = array_filter($accountDirs, "dirFilter");

//---üres elemek kiszűrése
    foreach ($tempDirs as $i) {
        array_push($destRobots, $i);
    }

    return $destRobots;
}

//---tömbök összefésülése
function array_union($x, $y)
{
    $res = array();
    $aunion = array_merge(
        array_intersect($x, $y),
        array_diff($x, $y),
        array_diff($y, $x)
    );
    asort($aunion);

    foreach ($aunion as $i) {
        array_push($res, $i);
    }

    return $res;
}