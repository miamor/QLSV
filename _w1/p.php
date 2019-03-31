<?php
$string = $_GET['input'];

$valid = strpos($string, ' ');
var_dump($valid);

$valid = filter_var($string, FILTER_VALIDATE_IP);
var_dump($valid);

$valid = preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $string);
var_dump($valid);
