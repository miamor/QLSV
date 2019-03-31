function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}

var timeinterval;

function initializeClock(id, endtime) {
    var clock = document.getElementById(id);
    timeinterval = setInterval(function () {
        var t = getTimeRemaining(endtime);
        console.log(t);
        $('#' + id).val(t.days + 'd ' + t.hours + 'h ' + t.minutes + 'm ' + t.seconds + 's');
        if (t.total <= 0) {
            clearInterval(timeinterval);
        }
    }, 1000);
}

function loadEdit() {
    if ($('[name="status"]').val() == 1) {
        initializeClock('clockdiv', $('[name="openday"]').val());
    }
    $('.open-account').click(function () {
        $.post(MAIN_URL + '/requests/sinhvien/openaccount.php', {
            username: $('[name="username"]').val()
        }, function (data) {
            if (data == 1) {
                //location.reload();
                mtip('', 'success', '', 'Mở khóa tài khoản thành công');
                $('#clockdiv').closest('.form-group').html('<div class="col-lg-3 control-label">\
                      Khóa tài khoản (số ngày)\
                  </div>\
                  <div class="col-lg-9">\
                      <input type="hidden" name="status" value="0">\
                      <input type="number" class="form-control" value="" name="lock_time">\
                  </div>\
                  <div class="clearfix"></div>');
            }
        })
    })
    $('.edit').submit(function () {
        console.log($(this).serialize());
        $.post(MAIN_URL + '/requests/sinhvien/lock.php', $(this).serialize(), function (data) {
            console.log(data);
            if (data == 1) {
                //location.reload();
                mtip('', 'success', '', 'Khoá tài khoản thành công');
                clearInterval(timeinterval);
                $('section.content > .edit').load(MAIN_URL + '/sinhvien/' + $('[name="username"]').val() + '?mode=lock section.content > .edit', function (data) {
                    //console.log(data);
                    loadEdit();
                });
            } else if (data == -1) {
                mtip('', 'error', '', 'Input error')
            } else if (data == 0) {
                mtip('', 'error', '', 'System error')
            }
        })
        return false
    })
}

$(document).ready(function () {
    loadEdit()
})