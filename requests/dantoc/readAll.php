<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/dantoc.php';

$dantoc = new DanToc();

$data = array('data' => $dantoc->readAll());

echo json_encode($data, JSON_UNESCAPED_UNICODE);
