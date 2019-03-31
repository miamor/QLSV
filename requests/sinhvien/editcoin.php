<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/sinhvien.php';

$sinhvien = new SinhVien();

$sinhvien->username = isset($_POST['username']) ? $_POST['username'] : null;
//$sinhvien->coin = isset($_POST['coin']) ? $_POST['coin'] : null;
$sinhvien->readOne();
$coin_change = isset($_POST['coin_change']) ? $_POST['coin_change'] : null;
//$sinhvien->coin_change_type = isset($_POST['coin_change_type']) ? $_POST['coin_change_type'] : null;

if ($coin_change && $sinhvien->username) {
	$edit = $sinhvien->updateCoin($coin_change);
	echo ($edit ? 1 : 0);
} else echo -1;
