<?php
include 'objects_xml/login.php';
$login = new Login();
$config->addJS('dist', "{$page}/login.js");

include $page.'/index.php';
?>
<style>html,body{background:#f9f9f9!important}</style>
