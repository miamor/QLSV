<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/sinhvien.php';

$sinhvien = new SinhVien();

$sinhvien->username = isset($_POST['username']) ? $_POST['username'] : null;
$sinhvien->password = isset($_POST['password']) ? $_POST['password'] : null;
$sinhvien->confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
$sinhvien->name = isset($_POST['name']) ? $_POST['name'] : null;
$sinhvien->phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$sinhvien->birthday = isset($_POST['birthday']) ? $_POST['birthday'] : null;
$sinhvien->class = isset($_POST['class']) ? $_POST['class'] : null;
$sinhvien->ethnic = isset($_POST['ethnic']) ? $_POST['ethnic'] : null;
$sinhvien->status = isset($_POST['status']) ? $_POST['status'] : 0;
$sinhvien->lock_time = isset($_POST['lock_time']) ? $_POST['lock_time'] : 0;
if ($sinhvien->lock_time && $sinhvien->lock_time != 0) {
	$sinhvien->timelife = Date('Y-m-d', strtotime("+{$lock_time} days"));
	$sinhvien->status = 1;
} else {
	$sinhvien->timelife = NULL;
	$sinhvien->status = 0;
}

$data = array();
if ($sinhvien->password && ($sinhvien->password == $sinhvien->confirm_password) && $sinhvien->username && $sinhvien->name && $sinhvien->phone && $sinhvien->ethnic && $sinhvien->birthday) {
	$add = $sinhvien->create();
    //echo ($add ? 1 : 0);
    if ($add) $data = array('status'=>'success');
    else $data = array('status'=>'error', 'msg'=>'System error');
} else {
    $data = array('status'=>'error', 'msg'=>'Input error');
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
