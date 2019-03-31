<?php
$config->addJS('dist', "{$page}/lock.js");
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Khóa tài khoản sinh viên <?php echo $sinhvien->name ?>
  </h1>
  <?php if (!$v) { ?>
  <ol class="breadcrumb">
    <li><a href="<?php echo MAIN_URL ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo MAIN_URL ?>/sinhvien">Sinh viên</a></li>
    <li class="active"><?php echo $sinhvien->name ?></li>
  </ol>
  <?php } else {
      echo '<script src="'.JS.'/sinhvien/lock.js"></script>';
  } ?>
</section>

<!-- section.content Main content -->
<section class="content">

    <form class="edit">
        <input type="hidden" class="form-control hidden" name="username" readonly value="<?php echo $sinhvien->username ?>"/>

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
