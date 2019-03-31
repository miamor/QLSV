<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/dantoc.php';

$dantoc = new DanToc();

$dantoc->id = isset($_GET['id']) ? $_GET['id'] : null;

if ($dantoc->id) echo $dantoc->delete();
else echo -1;
