<?php

$getText = file_get_contents('firstText.txt');
var_dump($getText);

$parts = explode("\n\n", $getText);
ksort($parts);
$file = 'result.txt';
file_put_contents($file, $parts);