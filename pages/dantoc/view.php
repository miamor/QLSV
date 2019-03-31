<?php
$config->addJS('dist', "{$page}/view.js");
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Sửa thông tin dân tộc <?php echo $dantoc->name ?>
  </h1>
  <?php if (!$v) { ?>
  <ol class="breadcrumb">
    <li><a href="<?php echo MAIN_URL ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo MAIN_URL ?>/dantoc">Dân tộc</a></li>
    <li class="active"><?php echo $dantoc->name ?></li>
  </ol>
  <?php } else {
      echo '<script src="'.JS.'/dantoc/view.js"></script>';
  } ?>
</section>

<!-- section.content Main content -->
<section class="content">

    <form class="edit">
        <div class="form-group">
            <div class="col-lg-3 control-label">
                Tên
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="name" value="<?php echo $dantoc->name ?>"/>
            </div>
            <div class="clearfix"></div>
        </div>
        <input type="hidden" readonly class="hidden form-control" name="id" value="<?php echo $dantoc->id ?>"/>

        <div class="add-form-submit center">
            <input type="reset" value="Reset"/>
            <input type="submit" value="Submit"/>
        </div>
    </form>

</section><!-- /.content -->

<div class="clear"></div>
