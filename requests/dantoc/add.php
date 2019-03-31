<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/dantoc.php';

$dantoc = new DanToc();

$dantoc->name = isset($_POST['name']) ? $_POST['name'] : null;

$data = array();
if ($dantoc->name) {
	$add = $dantoc->create();
    //echo ($add ? 1 : 0);
    if ($add) $data = array('status'=>'success');
    else $data = array('status'=>'error', 'msg'=>'System error');
} else {
    $data = array('status'=>'error', 'msg'=>'Input error');
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
