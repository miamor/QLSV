<?php
$config->addJS('dist', "{$page}/view.js");
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
    <?php echo $sinhvien->name ?>
  </h1>
  <?php if (!$v) { ?>
  <ol class="breadcrumb">
    <li><a href="<?php echo MAIN_URL ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo MAIN_URL ?>/sinhvien">Sinh viên</a></li>
    <li class="active"><?php echo $sinhvien->name ?></li>
  </ol>
  <?php } else {
      echo '<script src="'.JS.'/sinhvien/view.js"></script>';
  } ?>
</section>

<!-- section.content Main content -->
<section class="content">

    <form class="edit">
        <!--<div class="form-group">
            <div class="col-lg-3 control-label">
                Username (fixed)
            </div>
            <div class="col-lg-9">
                
                <a href="?mode=editpassword">Sửa mật khẩu</a>
            </div>
            <div class="clearfix"></div>
        </div>


        <div class="divider"></div>-->
        <input type="text" class="form-control hidden" name="username" readonly value="<?php echo $sinhvien->username ?>"/>

        <div class="form-group">
            <div class="col-lg-3 control-label">
                Tên
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="name" value="<?php echo $sinhvien->name ?>"/>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 control-label">
                Số điện thoại
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="phone" value="<?php echo $sinhvien->phone ?>"/>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 control-label">
                Ngày sinh
            </div>
            <div class="col-lg-9">
                <input type="date" class="form-control" name="birthday" value="<?php echo $sinhvien->birthday ?>"/>
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
                        if ($sinhvien->class == $lO['id']) 
                            echo '<option selected value="'.$lO['id'].'">'.$lO['name'].'</option>';
                        else 
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
                <!--<input type="text" class="form-control" name="ethnic" value="<?php echo $sinhvien->ethnic ?>"/>-->
                <select class="form-control" name="ethnic">
                    <?php foreach ($ethnics as $eO) {
                        if ($sinhvien->ethnic == $eO['id']) 
                            echo '<option selected value="'.$eO['id'].'">'.$eO['name'].'</option>';
                        else 
                            echo '<option value="'.$eO['id'].'">'.$eO['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>


<?php if ($sinhvien->status == 0) { ?>
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Khóa tài khoản (số ngày)
            </div>
            <div class="col-lg-9">
                <input type="hidden" name="status" value="<?php echo $sinhvien->status ?>"/>
                <input type="number" class="form-control" value="<?php echo $sinhvien->lock_time ?>" name="lock_time"/>
            </div>
            <div class="clearfix"></div>
        </div>
<?php } else { ?>
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Thời gian còn lại mở tài khoản
            </div>
            <div class="col-lg-9">
                <input type="hidden" name="openday" value="<?php echo $sinhvien->timelife ?>"/>
                <input type="hidden" name="status" value="<?php echo $sinhvien->status ?>"/>
                <input type="text" class="form-control" readonly value="" id="clockdiv"/>
                <div class="btn btn-success open-account">Mở ngay</div>
            </div>
            <div class="clearfix"></div>
        </div>
<?php } ?>
        <div class="add-form-submit center">
            <input type="reset" value="Reset"/>
            <input type="submit" value="Submit"/>
        </div>
    </form>

</section><!-- /.content -->

<div class="clear"></div>
