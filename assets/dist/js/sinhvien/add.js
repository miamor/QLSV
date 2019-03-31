$(document).ready(function () {
    $('.add').submit(function () {
        $.post(MAIN_URL+'/requests/sinhvien/add.php', $(this).serialize(), function (data) {
            console.log(data);
            if (data.status == 'success') {
                //location.href = MAIN_URL+'/sinhvien';
                mtip('', 'success', '', 'Thêm sinh viên thành công');
            } else {
                mtip('', 'error', '', data.msg);
            }
        });
        return false;
    });
});
