var table;

function del (itemID) {
    $a = $('a[attr-id="'+itemID+'"]');
    var title = $a.closest('tr').find('td:nth-child(2)').text();
    if (itemID) {
        if (confirm("Are you sure want to remove student "+itemID+" permanently?")) {
            /*var row = table.row($a.closest('tr'));
            var rowNode = row.node();
            row.remove();*/

            $.get(MAIN_URL+'/requests/sinhvien/delete.php?id='+itemID, function (data) {
                console.log(data);
                if (data == 1) $a.closest('tr').remove();
            })

        }
    }
    return false
}

function openAcc (itemID) {
    $a = $('a[attr-id="'+itemID+'"]');
    var title = $a.closest('tr').find('td:nth-child(2)').text();
    if (itemID) {
        $.post(MAIN_URL+'/requests/sinhvien/openaccount.php', {username: itemID}, function (data) {
            if (data == 1) {
                //location.reload();
                mtip('', 'success', '', 'Mở khóa tài khoản thành công');
                $a.closest('tr').removeClass('lock').find('.row-btn-confirm').attr('onclick', "javascript:lockAcc('"+itemID+"'); return false").html('<i class="fa fa-lock"></i>');
            }
        })
    }
    return false
}

function lockAcc (itemID) {
    $('.the-board').load(MAIN_URL + '/sinhvien/'+itemID+'?mode=lock&v=window', function (data) {
        popup();
        $('.popup-content [role="close"], .popup-inner > div:not(".popup-content")').click(function () {
            table.ajax.reload();
        })
    })
}

function update (itemID) {
    $('.the-board').load(MAIN_URL + '/sinhvien/'+itemID+'?v=window', function (data) {
        popup();
        $('.popup-content [role="close"], .popup-inner > div:not(".popup-content")').click(function () {
            table.ajax.reload();
        })
    })
}

$(document).ready(function () {
    table = $('#buyList').DataTable({
		"ajax": MAIN_URL+'/requests/sinhvien/readAll.php',
		"columns": [
			{ "data": "username" },
			{ "data": "name" },
			{ "data": "phone" },
			{ "data": "birthday" },
			{ "data": "class" },
			{ "data": "ethnic" },
			{ "data": "status",
                render : function (data, type, row) {
                    approveCls = '';
                    cls = 'lock';
                    html = '<a attr-id="'+row.id+'" class="row-btn-confirm '+approveCls+'" href="#" onclick="javascript:lockAcc(\''+row.id+'\'); return false"><i class="fa fa-'+cls+'"></i></a>';
                    if (row.status == 1) {
                        cls = 'unlock';
                        //approveCls = 'text-success';
                        html = '<a attr-id="'+row.id+'" class="row-btn-confirm '+approveCls+'" href="#" onclick="javascript:openAcc(\''+row.id+'\'); return false"><i class="fa fa-'+cls+'"></i></a>';
                    }
                    return '<div class="row-btns"> '+html+' <a attr-id="'+row.id+'" class="row-btn-edit" href="#" onclick="javascript:update(\''+row.id+'\'); return false"><i class="fa fa-pencil"></i></a> <a attr-id="'+row.id+'" class="row-btn-del text-danger" href="#" onclick="javascript:del(\''+row.id+'\'); return false"><i class="fa fa-trash"></i></a></div>'
                }
            }
		],
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            console.log(aData);
            if (aData.status == 1) {
                $(nRow).addClass('lock');
            }
        }
    });
    
    $('.btn-add').click(function () {
        $('.the-board').load(MAIN_URL + '/sinhvien?mode=add&v=window', function (data) {
            popup();
            $('.popup-content [role="close"], .popup-inner > div:not(".popup-content")').click(function () {
                table.ajax.reload();
            })
        })
    })
})
