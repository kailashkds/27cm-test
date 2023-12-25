<?php

/** @noinspection DuplicatedCode */
ini_set('error_reporting', E_ALL);
ini_set('memory_limit', '1024M');

require_once __DIR__ . '/vendor/autoload.php';

try {
    $parser = new FileParser($argv[1] ?? null);
} catch (Exception $e) {
    echo "Error!";
    return;
}

// TODO: Solve problem 1
$startPoint = 0;
if(!count($parser->getData())) {
    return $startPoint;
}
$data = $parser->getData();
$shortestPoint = "CR";
$shortestDistance = 0;
foreach($data['CR']  as $key => $dest)
{
    if($key == 'CR' || strpos($key, 2) !== false) {
        continue;
    }
    if($shortestDistance == 0) {
        $shortestPoint = $key;
        $shortestDistance = $dest;
    } elseif($shortestDistance > $dest) {
        $shortestDistance = $dest;
        $shortestPoint = $key;
    }
}
echo $shortestPoint;
