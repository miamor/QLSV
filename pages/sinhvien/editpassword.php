<?php
$config->addJS('dist', "{$page}/editpassword.js");
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $sinhvien->name ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo MAIN_URL ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo MAIN_URL ?>/taxi">Đối tác</a></li>
    <li><a href="<?php echo MAIN_URL ?>/taxi/<?php echo $sinhvien->name ?>"><?php echo $sinhvien->name ?></a></li>
    <li class="active">Sửa mật khẩu</li>
  </ol>
</section>

<!-- section.content Main content -->
<section class="content">

    <form class="edit">
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Username (fixed)
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="username" readonly value="<?php echo $sinhvien->username ?>"/>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 control-label">
                Mật khẩu
            </div>
            <div class="col-lg-9">
                <input type="password" class="form-control" name="password" value=""/>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Mật khẩu (xác nhận)
            </div>
            <div class="col-lg-9">
                <input type="password" class="form-control" name="confirm_password" value=""/>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="add-form-submit center">
            <input type="reset" value="Reset"/>
            <input type="submit" value="Submit"/>
        </div>
    </form>

</section><!-- /.content -->

<div class="clear"></div>
