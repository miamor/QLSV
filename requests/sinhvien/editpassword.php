<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/sinhvien.php';

$sinhvien = new SinhVien();

$sinhvien->username = isset($_POST['username']) ? $_POST['username'] : null;
$sinhvien->password = isset($_POST['password']) ? $_POST['password'] : null;
$sinhvien->confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;

if ($sinhvien->username && $sinhvien->password && ($sinhvien->password == $sinhvien->confirm_password)) {
	$edit = $sinhvien->updatePassword();
	echo ($edit ? 1 : 0);
} else echo -1;
