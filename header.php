<?php //echo date("Y-m-d H:i:s");
//$config = new Config();
$config->addJS('plugins', 'bootstrapValidator/bootstrapValidator.min.js');
$config->addJS('plugins', 'select2/select2.full.min.js');
$config->addJS('plugins', 'sceditor/minified/jquery.sceditor.bbcode.min.js');
$config->addJS('dist', 'app.min.js');
$config->addJS('dist', 'main.js'); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Trang quản lý Sinh Viên</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo ASSETS ?>/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo CSS ?>/font.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo PLUGINS ?>/iCheck/all.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo PLUGINS ?>/select2/select2.min.css">
	<!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo PLUGINS ?>/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo PLUGINS ?>/daterangepicker/daterangepicker-bs3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo CSS ?>/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo CSS ?>/skins/skin-red.min.css">

	<script src="<?php echo MAIN_URL ?>/assets/jquery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo MAIN_URL ?>/assets/jquery/jquery-ui.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>var MAIN_URL = '<?php echo MAIN_URL ?>'; </script>
  </head>
  <body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo MAIN_URL ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>miamor</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>miamor</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Tìm kiếm...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Giao diện quản lý</li>
            <li>
              <a href="<?php echo MAIN_URL ?>/sinhvien">
                <i class="fa fa-users"></i> <span>Sinh viên</span>
              </a>
            </li>
            <li>
              <a href="<?php echo MAIN_URL ?>/dantoc">
                <i class="fa fa-dashboard"></i> <span>Dân tộc</span>
              </a>
            </li>
            <li>
              <a href="<?php echo MAIN_URL ?>/lop">
                <i class="fa fa-dashboard"></i> <span>Lớp</span>
              </a>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

	<div id="main-content" class="content-wrapper page-<?php echo $page ?>">
