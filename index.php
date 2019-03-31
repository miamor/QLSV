<?php
// config file
$use_xml = true;
if ($use_xml) {
    include_once 'include/config.xml.php';
    $objectsDir = 'objects_xml';
} else {
    include_once 'include/config.php';
    $objectsDir = 'objects';
}

if (!$config->u) {
	$page = 'login';
} else {
	if (!isset($page) || !$page) $page = 'index';

	if ($page != 'index' && !file_exists('pages/'.$page.'.php')) $page = 'error';
}

$page_title = 'AdminCP';

if (!$do && !$v && !$temp) include 'header.php';
if ($page == 'index') echo '<script>location.href = "'.MAIN_URL.'/sinhvien";</script>';
if ($page) {
	include 'pages/'.$page.'.php';
}
if (!$do && !$v && !$temp) include 'footer.php';
