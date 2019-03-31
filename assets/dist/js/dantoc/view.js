$(document).ready(function () {
    $('.edit').submit(function () {
        $.post(MAIN_URL+'/requests/dantoc/edit.php', $(this).serialize(), function (data) {
            console.log(data);
            if (data.status == 'success') {
                //location.href = MAIN_URL+'/sinhvien';
                mtip('', 'success', '', 'Cập nhật thông tin dân tộc thành công');
            } else {
                mtip('', 'error', '', data.msg);
            }
        });
        return false;
    });
});
