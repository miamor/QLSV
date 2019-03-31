<?php
$config->addJS('dist', "{$page}/editcoin.js");
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
    <li class="active">Sửa coin</li>
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
                Điểm (coin)
            </div>
            <div class="col-lg-9">
                <input type="number" class="form-control" name="coin" readonly value="<?php echo $sinhvien->coin ?>"/>
            </div>
            <div class="clearfix"></div>
        </div>

<!--        <div class="form-group">
            <div class="col-lg-3 control-label">
                Cộng/trừ?
            </div>
            <div class="col-lg-9">
                <select name="coin_change_type">
                    <option value="1" selected>Cộng</option>
                    <option value="-1">Trừ</option>
                </select>
            </div>
            <div class="clearfix"></div>
        </div> -->

        <div class="form-group">
            <div class="col-lg-3 control-label">
                Số tiền thay đổi
            </div>
            <div class="col-lg-9">
                <input type="number" class="form-control" name="coin_change" value=""/>
                <div style="margin-top:3px">* Giá trị dương để cộng thêm tiền, giá trị âm để trừ tiền</div>
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
