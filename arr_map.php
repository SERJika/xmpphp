<?php

$data = [
    'id' => 1,
    'name' => 'Bob',
    'position' => '22',
];

$data = [
    'id' => 2,
    'name' => 'Nick',
    'position' => '33',
];


$arr = array_map(
    function($value) {
        return ['name' => $value['name']];
    }, $data
);


var_dump($data, $arr);



uasort

