<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/lop.php';

$lop = new Lop();

$data = array('data' => $lop->readAll());

echo json_encode($data, JSON_UNESCAPED_UNICODE);
