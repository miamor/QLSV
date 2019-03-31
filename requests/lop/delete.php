<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/lop.php';

$lop = new Lop();

$lop->id = isset($_GET['id']) ? $_GET['id'] : null;

if ($lop->id) echo $lop->delete();
else echo -1;
