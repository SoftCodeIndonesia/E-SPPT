var index = 1;
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
    


    var kecamatan = "sd";
    var desa;
    

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

    $(document).on('click',`.delete-table`, function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id);
        $(`#table-row-${id}`).remove();
    })

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
                            $(this).parent().parent().parent().children(0).val($(this).html());
                            
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

    $(document).on('keyup', '#njkp', function(e){
       

        var value = $(this).val();

        console.log(value);
        var valueFormat = formatRupiah(value);
        $(this).val(valueFormat);
    });

    

    $.ajax({
        type: "GET",
        url: base_url + 'esppt/getAllOwner',
        dataType: "json",
        success: function (response) {
            
            if(response)
            {
                // $('#list-owner').append(content);
            
                $.each(response, function (i, value) { 
                    
                    var content = '';
                    content += `<option value="${value.owner_id}">${value.name}</option>`;
                    $('#list-owner').append(content);
                });
            }
        }
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




    $(document).on('change', '#list-owner', function (e) { 
        e.preventDefault();
        $('#address').html(`<div class="app-spinner loading"></div>`);
        var address_id = $(this).val();
        var kecamatan = '';
        var rt = '';
        var rw = '';
        var desa = '';
        var htmlAddress = '';
        $.ajax({
            type: "POST",
            url: base_url + 'esppt/getAddress',
            data: {
                address_id: address_id
            },
            dataType: "json",
            success: function (response) {
                rt = response.rt;
                rw = response.rw;

                $.ajax({
                    type: "GET",
                    url: "https://dev.farizdotid.com/api/daerahindonesia/kecamatan/" + response.district_id,
                    dataType: "json",
                    success: function (response) {
                        kecamatan = response.nama;
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "https://dev.farizdotid.com/api/daerahindonesia/kelurahan/" + response.village_id,
                    dataType: "json",
                    success: function (response) {
                        desa = response.nama;
                        console.log(desa);
                    }
                });
                console.log(desa);
                // console.log(response.district_id);
                // var kecamatan = getKecamatan(response.district_id);
                // console.log(kecamatan);
                setTimeout(() => {
                    $("#address").html(`
                    <span>RT ${response.rt}/${response.rw}</span>
                    <br>
                    <span>${response.address},${desa},${kecamatan}, kabupaten pekalongan</span>`);
                }, 3000);
                
                
            }
        });
    });

    // $('#form-create').submit(function (e) { 
    //     e.preventDefault();
    //     $(".btn-submit").prop('disabled', true);
    //     var dataForm = $(this).serializeArray();
    //     console.log(dataForm);
    // });

});