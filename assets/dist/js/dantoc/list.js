var table;

function del (itemID) {
    $a = $('a[attr-id="'+itemID+'"]');
    var title = $a.closest('tr').find('td:nth-child(1)').text();
    if (itemID) {
        if (confirm("Are you sure want to remove item "+title+" permanently?")) {
            /*var row = table.row($a.closest('tr'));
            var rowNode = row.node();
            row.remove();*/

            $.get(MAIN_URL+'/requests/dantoc/delete.php?id='+itemID, function (data) {
                console.log(data);
                if (data == 1) $a.closest('tr').remove();
            })

        }
    }
    return false
}

function update (itemID) {
    $('.the-board').load(MAIN_URL + '/dantoc/'+itemID+'?v=window', function (data) {
        popup();
        $('.popup-content [role="close"], .popup-inner > div:not(".popup-content")').click(function () {
            table.ajax.reload();
        })
    })
}

$(document).ready(function () {
    table = $('#buyList').DataTable({
		"ajax": MAIN_URL+'/requests/dantoc/readAll.php',
		"columns": [
			{ "data": "name" },
			{ "data": "created",
                render : function (data, type, row) {
                    return '<div class="row-btns"> <a attr-id="'+row.id+'" class="row-btn-edit" href="#" onclick="javascript:update(\''+row.id+'\'); return false"><i class="fa fa-pencil"></i></a> <a attr-id="'+row.id+'" class="row-btn-del text-danger" href="#" onclick="javascript:del(\''+row.id+'\'); return false"><i class="fa fa-trash"></i></a></div>'
                }
            }
		]
    });
    
    $('.btn-add').click(function () {
        $('.the-board').load(MAIN_URL + '/dantoc?mode=add&v=window', function (data) {
            popup();
            $('.popup-content [role="close"], .popup-inner > div:not(".popup-content")').click(function () {
                table.ajax.reload();
            })
        })
    })
})
