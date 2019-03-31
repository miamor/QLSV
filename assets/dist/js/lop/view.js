$(document).ready(function () {
    $('.edit').submit(function () {
        $.post(MAIN_URL+'/requests/lop/edit.php', $(this).serialize(), function (data) {
            console.log(data);
            if (data.status == 'success') {
                //location.href = MAIN_URL+'/sinhvien';
                mtip('', 'success', '', 'Cập nhật thông tin lớp học thành công');
            } else {
                mtip('', 'error', '', data.msg);
            }
        });
        return false;
    });
});
