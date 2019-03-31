<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/sinhvien.php';

$sinhvien = new SinhVien();

$sinhvien->username = isset($_POST['username']) ? $_POST['username'] : null;
//$sinhvien->username = isset($_GET['id']) ? $_GET['id'] : null;
$open = $sinhvien->openaccount();
echo ($open ? 1 : 0);
