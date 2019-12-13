<?php

$input = file_get_contents('php://input');
var_dump($input);
$json = json_decode($input);
var_dump($json);