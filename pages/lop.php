<?php
include 'objects_xml/lop.php';
$lop = new Lop();
if ($subpage) {
	$lop->id = $subpage;
	$lop->readOne();
}

if ($mode) {
	include $page.'/'.$mode.'.php';
}
else if ($subpage) {
	include $page.'/view.php';
}
else include $page.'/index.php';
