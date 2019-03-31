<?php
$config->addJS('dist', "{$page}/{$mode}.js");
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Thêm lớp
  </h1>
  <?php if (!$v) { ?>
  <ol class="breadcrumb">
    <li><a href="<?php echo MAIN_URL ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo MAIN_URL ?>/lop">Lớp</a></li>
    <li class="active">Thêm lớp</li>
  </ol>
  <?php } else {
      echo '<script src="'.JS.'/lop/add.js"></script>';
  } ?>
</section>

<!-- section.content Main content -->
<section class="content">

    <form class="add">
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Tên
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="name"/>
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
