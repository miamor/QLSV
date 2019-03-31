<?php
include_once '../../include/config.xml.php';
include_once '../../objects_xml/dantoc.php';

$dantoc = new DanToc();

$dantoc->id = isset($_POST['id']) ? $_POST['id'] : null;
$dantoc->name = isset($_POST['name']) ? $_POST['name'] : null;

$data = array();
if ($dantoc->name) {
	$edit = $dantoc->update();
    //echo ($edit ? 1 : 0);
    if ($edit) $data = array('status'=>'success');
    else $data = array('status'=>'error', 'msg'=>'System error');
} else {
    $data = array('status'=>'error', 'msg'=>'Input error');
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
