<?php

/** @noinspection DuplicatedCode */
ini_set('error_reporting', E_ALL);
ini_set('memory_limit', '1024M');

require_once __DIR__ . '/vendor/autoload.php';

$parser = new FileParser($argv[1] ?? null);

$parcels = $parser->getData();

$pathArray = [];
$totalDistance = 0;
$nextMandatoryRoute = [];
$tempRoutes['mandatory'] = [];
$tempRoutes['ignore'] = ['CR'];
$array = array_keys($parcels);
$totalRoutes = count($array);
$totalSteps = 0;
while ($totalSteps < $totalRoutes) {
    $shortestPoint = "";
    $shortestDistance = 0;
    if($totalSteps == 0) {
        $nextPoint = $array[0];
    } else {
        $nextPoint = end($pathArray);
    }

    foreach($parcels[$nextPoint]  as $key => $dest)
    {
        $shortPath = 0;
        if(in_array($key, $tempRoutes['ignore'])) {
            continue;
        }
        $arrayKeys = array_keys($tempRoutes['mandatory']);
        if(count($arrayKeys) == 2) {
            $firstDropPoint = $parcels[$nextPoint][$arrayKeys[0]];
            $secondDropPoint = $parcels[$nextPoint][$arrayKeys[1]];

            if($firstDropPoint > $secondDropPoint) {
                $shortestPoint = $arrayKeys[1];
                $shortestDistance = $secondDropPoint;
            } else {
                $shortestPoint = $arrayKeys[0];
                $shortestDistance = $firstDropPoint;
            }

            break;
        }

        if(!endsWith($key, '2') || in_array($key, $arrayKeys)) {
            if($shortestDistance == 0) {
                $shortestPoint = $key;
                $shortestDistance = $dest;
            } elseif($shortestDistance > $dest) {
                $shortestDistance = $dest;
                $shortestPoint = $key;
            }
        }

    }

    $tempRoutes = getNextLabels($shortestPoint,$tempRoutes);
    $pathArray[] = $shortestPoint;
    $totalDistance += $shortestDistance;
    $totalSteps++;
}

var_dump(implode(" ", $pathArray));
var_dump($totalDistance);
exit;
function endsWith($haystack, $needle)
{
    return substr($haystack, -strlen($needle)) === $needle;
}
function getNextLabels($labels, $tempRoutes)
{
    $result = [];

    if(count($tempRoutes['mandatory']) == 0) {
        $tempRoutes['mandatory'][substr($labels, 0, -1) . '2'] = true;
        $tempRoutes['ignore'][] = $labels;
        return  $tempRoutes;
    }

    if(count($tempRoutes['mandatory']) >= 1) {
        if(endsWith($labels, '2')) {
            unset($tempRoutes['mandatory'][$labels]);
            return $tempRoutes;
        } else {
            $tempRoutes['mandatory'][substr($labels, 0, -1) . '2'] = true;
            $tempRoutes['ignore'][] = $labels;
            return  $tempRoutes;
        }
    }

    return $result;
}



// TODO: Solve problem 2
