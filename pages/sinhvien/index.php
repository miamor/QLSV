<?php
$config->addJS('plugins', 'DataTables/datatables.min.js');
$config->addJS('dist', "{$page}/list.js");
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Danh sách sinh viên
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo MAIN_URL ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Sinh viên</li>
  </ol>
</section>

<!-- section.content Main content -->
<section class="content">

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Danh sách sinh viên</h3>
        <div class="right btns">
            <div class="btn btn-success btn-add">Thêm</div>
        </div>
    </div>
    <div class="box-body">
        <table id="buyList" class="table table-bordered table-striped">
            <thead>
                <tr>
                  <th>Tên đăng nhập</th>
                  <th>Tên thật</th>
                  <th>Số điện thoại</th>
                  <th>Ngày sinh</th>
                  <th>Lớp</th>
                  <th>Dân tộc</th>
                  <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

</section><!-- /.content -->

<div class="clear"></div>
