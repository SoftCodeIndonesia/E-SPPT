var table = dataTablesCreated();
var base_url = base_url;

$(document).on('click','#btn-delete', function (e) { 
    e.preventDefault();
    var menu_id = $(this).data('id');
    var deleted = function () { 
        $.ajax({
            type: "POST",
            url: base_url + 'menu/deleteMenu',
            data: {
                menu_id: menu_id
            },
            dataType: "json",
            success: function (response) {
                if(response > 0){
                    callbackAlert("Success","Data berhasil dihapus!", "success");
                    table.destroy();
                    table = dataTablesCreated();
                }else{
                    failledCallback("Data gagal dihapus!");
                }
            }
        });
    }

    var title = "Apakah kamu yakin?";
    var text = "data akan terhapus secara permanent!";
    var icon = "warning";
    var buttons = true;
    var dangerMode = true;

    alertConfirm(title,text,icon,buttons,dangerMode,deleted,null);

 })

function dataTablesCreated() {
    return $('#DataTables_Table_1').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        "ordering": false,
        "order": [],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false
        }],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": base_url + 'menu/getAllMenu',
            "type": "POST"
        },
    });
}