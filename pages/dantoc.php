<?php
include 'objects_xml/dantoc.php';
$dantoc = new DanToc();
if ($subpage) {
	$dantoc->id = $subpage;
	$dantoc->readOne();
}

if ($mode) {
	include $page.'/'.$mode.'.php';
}
else if ($subpage) {
	include $page.'/view.php';
}
else include $page.'/index.php';
