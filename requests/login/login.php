<?php
include_once '../../include/config.xml.php';
if (!$_SESSION['username']) {
    include_once '../../objects_xml/login.php';
    $login = new Login();

    $login->username = isset($_POST['username']) ? $_POST['username'] : null;
    $login->password = isset($_POST['password']) ? $_POST['password'] : null;

//    echo $_POST['username'];

    if ($login->username && $login->password) {
        $do = $login->login();
        if ($do) {
            $_SESSION['username'] = $login->username;
            //$_SESSION['user_id'] = $login->id;
            echo 1;
        } //else echo 0;
        else echo json_encode(md5($login->password));
        //echo ($do ? 1 : 0);
    } else echo -1;
} else echo -2;
