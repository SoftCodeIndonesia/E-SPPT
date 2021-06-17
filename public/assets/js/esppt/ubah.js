$(document).ready(function () {
    index = 0;
    var owner;
    var nop;
    var pbb_terhutang;
    var date;
    var payment_id;

    


    $.ajax({
        type: "POST",
        url: base_url + 'esppt/getById',
        data: {
            e_sppt: $('input[name="sppt_id"]').val()
        },
        dataType: "json",
        success: function (response) {
            owner_id = response.owner_id;
            nop = response.nop;
            pbb_terhutang = response.pbb_terhutang;
            payment_id = response.payment_id;
            // date = ;
        }
    });

   
    var table = dataTablesCreated();





    $.ajax({
        type: "GET",
        url: base_url + 'esppt/getPayment',
        dataType: "json",
        success: function (response) {
            console.log("payment response : " + response);
            if(response)
            {
                // $('#list-owner').append(content);
            
                $.each(response, function (i, value) { 
                    
                    var content = '';

                    if(value.payment_id == payment_id){
                        content += `<option value="${value.payment_id}" selected>${value.name}</option>`;
                    }else{
                        content += `<option value="${value.payment_id}">${value.name}</option>`;
                    }
                    
                    $('#list-payment').append(content);
                });
            }
        }
    });

    

    $.ajax({
        type: "GET",
        url: base_url + 'esppt/getAllOwner',
        dataType: "json",
        success: function (response) {
            console.log(owner_id);
            $('input[name="nop"]').val(nop);
            $('input[name="pbb_terhutang"]').val(pbb_terhutang);
            if(response)
            {
                // $('#list-owner').append(content);
            
                $.each(response, function (i, value) { 
                    
                    var content = '';
                    if(value.owner_id == owner_id)
                    {
                        content += `<option value="${value.address_id}" selected>${value.name}</option>`;
                    }else{
                        content += `<option value="${value.address_id}">${value.name}</option>`;
                    }
                    $('#list-owner').append(content);
                });
            }
        }
    });
});

function dataTablesCreated() {
    return $('#data_object').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        "destroy": true,
        "ordering": false,
        "order": [],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false
        }],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "type": "POST",
            "url": base_url + 'esppt/getObjectTax',
            "data": {
                sppt_id: $('input[name="sppt_id"]').val()
            },
        },
    });
}