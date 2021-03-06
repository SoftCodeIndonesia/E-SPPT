function initMap() {
    const myLatlng = { lat: -7.0418597, lng: 109.5009834 };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 11,
        center: myLatlng,
    });
    // Create the initial InfoWindow.
    let infoWindow = new google.maps.InfoWindow({
        content: "Klik untuk mendapatkan garis latitude dan longitude",
        position: myLatlng,
    });
    infoWindow.open(map);
    // Configure the click listener.
    map.addListener("click", (mapsMouseEvent) => {
        // Close the current InfoWindow.
        infoWindow.close();
        // Create a new InfoWindow.
        infoWindow = new google.maps.InfoWindow({
            position: mapsMouseEvent.latLng,
        });
        infoWindow.setContent(
            JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
        );

        infoWindow.open(map);

        var jsonLatLang = mapsMouseEvent.latLng.toJSON();
        console.log(mapsMouseEvent.latLng.toJSON().lat);
        $('#lat').val(jsonLatLang.lat)
        $('#lng').val(jsonLatLang.lng)

    });
}

$(document).ready(function () {
    index = 0;
    var owner;
    var nop;
    var pbb_terhutang;
    var date;
    var payment_id;
    var payment_name;
    var lat;
    var lng;
    var njkp;

    $.ajax({
        type: "POST",
        url: base_url + 'esppt/getCountObjectTax',
        data: {
            sppt_id: $('input[name="sppt_id"]').val()
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            index = response + 1;
        }
    });

    $('#add-new-colom').click(function (e) { 
        e.preventDefault();
        var content = `
        <tr role="row" class="odd" id="table-row-${index}">
            <td class="">
                <a href="" class="btn btn-default btn-icon btn-danger text-white delete-table" data-id="${index}"><span
                        class="icon-trash2 color-white"></span></a>
            </td>
            <td class="">
                <input type="text" name="nama_object_pajak[${index}]" data-index="${index}" id="fild_object_pajak_${index}"
                    class="form-control nama-object-pajak" placeholder="Nama object pajak" autocomplete="off">
                    <div id="nama_object_pajak_${index}"></div>
            </td>
            <td class="sorting_1">
                <input type="text" name="luas[${index}]" id="luas_${index}" data-index="${index}" class="form-control luas" placeholder="0"
                    autocomplete="off">
            </td>
            <td>
                <input type="text" name="kelas[${index}]" id="kelas_${index}" data-index="${index}" class="form-control kelas" placeholder="0"
                    autocomplete="off">
            </td>
            <td>
                <input type="text" name="njop[${index}]" id="njop_${index}" data-index="${index}" class="form-control njop" placeholder="0"
                    autocomplete="off">
            </td>
            <td>
                <input type="text" name="total_njop[${index}]" id="total_njop_${index}" data-index="${index}" class="form-control total_njop" placeholder="0"
                    autocomplete="off">
            </td>
    </tr>
        `;
        index = index + 1;
        $('#tbody').append(content);
    });
    
    var table = dataTablesCreated();

    $.ajax({
        type: "POST",
        url: base_url + 'esppt/getById',
        data: {
            e_sppt: $('input[name="sppt_id"]').val()
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            owner_id = response.owner_id;
            nop = response.nop;
            pbb_terhutang = response.pbb_terhutang;
            payment_id = response.payment_id;
            payment_name = response.payment;
            lat = response.lat;
            lng = response.lng;
            njkp = response.njkp;
            // date = ;
        }
    });

   
    

    
    $('#payment_bank').keyup(function (e) { 
        $(`#payment_option_list`).html(`<div class="app-spinner loading text-center"></div>`);
        $.ajax({
            type: "POST",
            url: base_url + 'esppt/searchPayment',
            data: {
                keyword: $(this).val()
            },
            dataType: "json",
            success: function (response) {
                if(response !== '<div class="list-group" style="z-index: 99999"></div>'){
                    setTimeout(() => {
                    $(`#payment_option_list`).fadeIn();  
                    $(`#payment_option_list`).html(response);  
                    
                    $(document).on('click', '.list-payment', function(e){
                        console.log('ok');
                        e.preventDefault();
                        $('input[name="payment_bank"]').val($(this).html());
                        
                        $(`#payment_option_list`).fadeOut();
                    });
                    }, 3000);
                }else{
                    $(`#payment_option_list`).fadeOut();
                }
            }
        });
    });
    

    $.ajax({
        type: "GET",
        url: base_url + 'esppt/getAllOwner',
        dataType: "json",
        success: function (response) {
            
            $('input[name="nop"]').val(nop);
            $('input[name="pbb_terhutang"]').val(pbb_terhutang);
            $('#payment_bank').val(payment_name);
            $('#lat').val(lat);
            $('#lng').val(lng);
            $('#njkp').val(formatRupiah(njkp));
            if(response)
            {
                // $('#list-owner').append(content);
            
                $.each(response, function (i, value) { 
                    
                    var content = '';
                    if(value.owner_id == owner_id)
                    {
                        content += `<option value="${value.owner_id}" selected>${value.name}</option>`;
                    }else{
                        content += `<option value="${value.owner_id}">${value.name}</option>`;
                    }
                    $('#list-owner').append(content);
                });
            }
        }
    });

    $(document).on('click',`.delete-table`, function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id);
        $(`#table-row-${id}`).remove();
    })

    $(document).on('click', ".btn-delete-object",function (e) {
        e.preventDefault();
        var tax_id = $(this).data('id');

        var deleted = function () { 
            $.ajax({
                type: "POST",
                url: base_url + 'esppt/delete_tax',
                data: {
                    tax_id: tax_id
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
            })
         };

        var title = "Apakah kamu yakin?";
        var text = "data akan terhapus secara permanent!";
        var icon = "warning";
        var buttons = true;
        var dangerMode = true;

        alertConfirm(title,text,icon,buttons,dangerMode,deleted,null);
        console.log();
    })

    $(document).on('keyup', '#njkp', function(e){
       

        var value = $(this).val();

        console.log(value);
        var valueFormat = formatRupiah(value);
        $(this).val(valueFormat);
    });

    $(document).on('keyup', '.luas', function(e){
        var index = $(this).data('index');

        var value = $(this).val();

        console.log(value);
        var valueFormat = formatRupiah(value);
        $(`#luas_${index}`).val(valueFormat);
    });

    $(document).on('keyup', '.njop', function(e){
        var index = $(this).data('index');

        var value = $(this).val();

        console.log(value);
        var valueFormat = formatRupiah(value);
        $(`#njop_${index}`).val(valueFormat);
    });

    $(document).on('keyup', '.total_njop', function(e){
        var index = $(this).data('index');

        var value = $(this).val();

        console.log(value);
        var valueFormat = formatRupiah(value);
        $(`#total_njop_${index}`).val(valueFormat);
    });

    function formatRupiah(angka){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }

    $(document).on('keyup', '.nama-object-pajak', function (e) {
        var index = $(this).data('index');
        var fild = $(this);
        $(`#nama_object_pajak_${index}`).html(`<div class="app-spinner loading text-center"></div>`);
        console.log(index);
        if($(this).val() !== ''){
            $.ajax({
                type: "POST",
                url: base_url + 'esppt/searchObject',
                data: {
                    keyword: $(this).val()
                },
                dataType: "json",
                success: function (response) {
                    if(response !== '<div class="list-group" style="z-index: 99999"></div>'){
                        setTimeout(() => {
                        $(`#nama_object_pajak_${index}`).fadeIn();  
                        $(`#nama_object_pajak_${index}`).html(response);  
                        
                        $(document).on('click', '.list-object', function(e){
                            
                            e.preventDefault();
                            $(`input[name="nama_object_pajak[${index}]"`).val($(this).html());
                            // $(this).parent().parent().parent().children(0).val($(this).html());
                            
                            $(`#nama_object_pajak_${index}`).fadeOut();
                        });
                        }, 3000);
                    }else{
                        $(`#nama_object_pajak_${index}`).fadeOut();
                    }
                }
            });
        }
        
    })

    $('#form-create').submit(function (e) { 
       
        if($('input[name="due_date"]').val() == ''){
            e.preventDefault();
            $('.validate_due_date').html('Tanggal jatuh tempo tidak boleh kosong!');
        }else if($("#lat").val() == ''){
            $('.validate_lat').html('latitude tidak boleh kosong!');
            e.preventDefault();
        }else if($("#lng").val() == ''){
            $('.validate_lat').html('longitude tidak boleh kosong!');
            e.preventDefault();
        }
        
        
    });
});

function dataTablesCreated() {
    return $('#DataTables_Table_1').DataTable({
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