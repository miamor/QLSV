<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/sinhvien.php';

$sinhvien = new SinhVien();

$sinhvien->username = isset($_GET['id']) ? $_GET['id'] : null;

if ($sinhvien->username) echo $sinhvien->delete();
else echo -1;
