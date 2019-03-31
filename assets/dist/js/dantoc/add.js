$(document).ready(function () {
    $('.add').submit(function () {
        $.post(MAIN_URL+'/requests/dantoc/add.php', $(this).serialize(), function (data) {
            console.log(data);
            if (data.status == 'success') {
                //location.href = MAIN_URL+'/sinhvien';
                mtip('', 'success', '', 'Thêm thông tin dân tộc thành công');
            } else {
                mtip('', 'error', '', data.msg);
            }
        });
        return false;
    });
});
