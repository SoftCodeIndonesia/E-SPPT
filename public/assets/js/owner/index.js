var table = dataTablesCreated();
$(document).on('click','.name-title',function (e) { 
    e.preventDefault();
    $('.content-address').html('');
    var owner_id = $(this).data('id');
    $('#modal-backdrop-disable').modal('show');
    $.ajax({
        type: "POST",
        url: base_url + 'owner/getDetail',
        data: {
            owner_id: owner_id
        },
        dataType: "json",
        success: function (response) {
            $("#title-name").html(`${response.name}`);
            $('#address').html(`${response.address}`)
            $('.content-address').append(`<div>RT ${response.rt} RW ${response.rw}</div>`)
            getDetailKecamatan(response.district_id);
            getDetailVillage(response.village_id);
            
        }
    });
});

function getDetailKecamatan(district_id) { 
    $.ajax({
        type: "GET",
        url: "https://dev.farizdotid.com/api/daerahindonesia/kecamatan/" + district_id,
        
        dataType: "json",
        success: function (response) {
            $('.content-address').append(`<div>Kecamatan : ${response.nama}</div>`)
        }
    });
}

function getDetailVillage(village_id) { 
    
    $.ajax({
        type: "GET",
        url: "https://dev.farizdotid.com/api/daerahindonesia/kelurahan/" + village_id,
        
        dataType: "json",
        success: function (response) {
            $('.content-address').append(`<div>Desa : ${response.nama}</div>`)
        }
    });
}

$(document).on('click','#btn-delete', function (e) { 
    e.preventDefault();
    var owner_id = $(this).data('id');
    var deleted = function () { 
        $.ajax({
            type: "POST",
            url: base_url + 'owner/deleteOwner',
            data: {
                owner_id: owner_id
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
    return $('#tableOwner').DataTable({
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
            "url": base_url + 'owner/getAllOwner',
            "type": "POST"
        },
    });
}