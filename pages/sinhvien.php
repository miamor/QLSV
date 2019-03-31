<?php
include 'objects_xml/sinhvien.php';
$sinhvien = new SinhVien();
if ($subpage) {
	$sinhvien->username = $subpage;
	$sinhvien->readOne();
}

if ($mode) {
	include $page.'/'.$mode.'.php';
}
else if ($subpage) {
    include $page.'/view.php';
}
else include $page.'/index.php';
