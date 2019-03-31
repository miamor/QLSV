<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/sinhvien.php';

$sinhvien = new SinhVien();

$sinhvien->username = isset($_POST['username']) ? $_POST['username'] : null;
$sinhvien->name = isset($_POST['name']) ? $_POST['name'] : null;
$sinhvien->phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$sinhvien->birthday = isset($_POST['birthday']) ? $_POST['birthday'] : null;
$sinhvien->class = isset($_POST['class']) ? $_POST['class'] : null;
$sinhvien->ethnic = isset($_POST['ethnic']) ? $_POST['ethnic'] : null;
$sinhvien->status = isset($_POST['status']) ? $_POST['status'] : 0;
$sinhvien->timelife = null;
if ($sinhvien->status == 0) {
	$sinhvien->lock_time = isset($_POST['lock_time']) ? $_POST['lock_time'] : null;
	if ($sinhvien->lock_time) {
		$sinhvien->timelife = Date('Y-m-d', strtotime("+{$sinhvien->lock_time} days"));
		$sinhvien->status = 1;
	}
}

if ($sinhvien->username && $sinhvien->name && $sinhvien->phone && $sinhvien->birthday && $sinhvien->class && $sinhvien->ethnic) {
	$edit = $sinhvien->update();
	echo ($edit ? 1 : 0);
} else echo -1;
