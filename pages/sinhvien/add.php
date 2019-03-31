<?php
$config->addJS('dist', "{$page}/{$mode}.js");
include 'objects_xml/dantoc.php';
$eth = new DanToc();
$ethnics = $eth->readAllSimple();

include 'objects_xml/lop.php';
$cls = new Lop();
$lops = $cls->readAllSimple();
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Thêm sinh viên
  </h1>
  <?php if (!$v) { ?>
  <ol class="breadcrumb">
    <li><a href="<?php echo MAIN_URL ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo MAIN_URL ?>/sinhvien">Sinh viên</a></li>
    <li class="active">Thêm sinh viên</li>
  </ol>
  <?php } else {
      echo '<script src="'.JS.'/sinhvien/add.js"></script>';
  } ?>
</section>

<!-- section.content Main content -->
<section class="content">

    <form class="add">
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Username
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="username"/>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Mật khẩu
            </div>
            <div class="col-lg-9">
                <input type="password" class="form-control" name="password"/>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Mật khẩu (xác nhận)
            </div>
            <div class="col-lg-9">
                <input type="password" class="form-control" name="confirm_password"/>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 control-label">
                Tên
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="name"/>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Số điện thoại
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="phone"/>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 control-label">
                Ngày sinh
            </div>
            <div class="col-lg-9">
                <input type="date" class="form-control" name="birthday"/>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Lớp
            </div>
            <div class="col-lg-9">
                <select class="form-control" name="class">
                    <?php foreach ($lops as $lO) {
                        echo '<option value="'.$lO['id'].'">'.$lO['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Dân tộc
            </div>
            <div class="col-lg-9">
                <!--<input type="text" class="form-control" name="ethnic"/>-->
                <select class="form-control" name="ethnic">
                    <?php foreach ($ethnics as $eO) {
                        echo '<option value="'.$eO['id'].'">'.$eO['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 control-label">
                Trạng thái
            </div>
            <div class="col-lg-9">
                <select class="form-control" name="status">
                    <option selected value="0">Open</option>
                    <option value="1">Lock</option>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group lock_time_form">
            <div class="col-lg-3 control-label">
                Khóa tài khoản (số ngày)
            </div>
            <div class="col-lg-9">
                <input type="number" class="form-control" name="lock_time" min="0"/>
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
