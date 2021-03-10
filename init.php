<?php

require 'vendor/autoload.php';
include_once 'src/PromoImage.php';

setlocale(LC_TIME, "pl_PL");

$data = [
    'title' => 'TITLE',
    'show' => 'SHOW TITLE',
    'date' => strftime("%A, %d.%m", strtotime("2021-03-21")),
    'time' => '11:00 — 12:00',
    'image' => __DIR__ . '/example/flowers.jpg',
];

$img = new PromoImage();
$img->compose($data)->save();
