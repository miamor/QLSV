<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/sinhvien.php';

$sinhvien = new SinhVien();

$sinhvien->username = isset($_POST['username']) ? $_POST['username'] : null;
$sinhvien->status = isset($_POST['status']) ? $_POST['status'] : 0;
$sinhvien->timelife = null;
if ($sinhvien->status == 0) {
	$sinhvien->lock_time = isset($_POST['lock_time']) ? $_POST['lock_time'] : null;
	if ($sinhvien->lock_time) {
		$sinhvien->timelife = Date('Y-m-d', strtotime("+{$sinhvien->lock_time} days"));
		$sinhvien->status = 1;
	}
}
if ($sinhvien->username && $sinhvien->timelife) {
	$edit = $sinhvien->lock();
	echo ($edit ? 1 : 0);
} else echo -1;

