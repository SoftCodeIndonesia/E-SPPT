var table = dataTablesCreated();
$('.btn-create').click(function (e) { 
    e.preventDefault();
    $('#modal-backdrop-disable').modal('show');
    $('input[name="name"]').val('');
});

$('#form-create').submit(function (e) { 
    $(".btn-submit").prop('disabled', true);
    e.preventDefault();
    var dataForm = $(this).serializeArray();
    
    var payment_id = $('#payment_id').val();
    console.log(payment_id);

    var name = dataForm[1].value;

    var url = '';

    if(payment_id == ''){
        url = base_url + 'payment/storeCreated';
    }else{
        url = base_url + 'payment/storeUpdate';
    }
    $.ajax({
        type: "POST",
        url: url,
        data: {
            payment_id: payment_id,
            name: name,
        },
        dataType: "json",
        success: function (response) {
            
            if(response > 0){
                $('#modal-backdrop-disable').modal('hide');
                if(payment_id == ''){
                    callbackAlert("Success","Data berhasil diubah!", "success");
                }else{
                    callbackAlert("Success","Data berhasil ditambahkan!", "success");
                }
            }else{
                if(payment_id == ''){
                    failledCallback("Data gagal diubah!");
                }else{
                    failledCallback("Data gagal ditambahkan!");
                }
                
            }
            $(".btn-submit").prop('disabled', false);
            table.destroy();
            table = dataTablesCreated();
            
            
        }
    });
    
});

$(document).on('click','#btn-delete', function (e) { 
    e.preventDefault();
    var payment_id = $(this).data('id');
    var deleted = function () { 
        $.ajax({
            type: "POST",
            url: base_url + 'payment/delete',
            data: {
                payment_id: payment_id
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

 });

 $(document).on('click', '#btn-ubah', function(e) {
    e.preventDefault();
    var payment_id = $(this).data('id');
    $('#modal-backdrop-disable').modal('show');
    $('#payment_id').val(payment_id);
    $.ajax({
        type: "POST",
        url: base_url + 'payment/getDetail',
        data: {
            payment_id: payment_id
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            $('input[name="name"]').val(response.name);
        }
    });
 })

function dataTablesCreated() {
    return $('#tablePayment').DataTable({
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
            "url": base_url + 'payment/getAll',
            "type": "POST"
        },
    });
}