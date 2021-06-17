var owner_id = $("#owner_id").val();

$.ajax({
    type: "POST",
    url: base_url + 'owner/getDetail',
    data: {
        owner_id: owner_id
    },
    dataType: "json",
    success: function (response) {
        $("#address_id").val(response.address_id);
        $('#name').val(response.name);
        $('#alamat').val(response.address);
        $('#rt').val(response.rt);
        $('#rw').val(response.rw);
        setDistrict(response.district_id);
        setVillage(response.district_id,response.village_id);
    }
});

function setDistrict(responseDistrictId)
{
    $.ajax({
        type: "GET",
        url: "https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=3326",
        
        dataType: "json",
        success: function (response) {
            $("#option-kecamatan").append('');
            $.each(response.kecamatan, function (i, value) { 
                
                 var content = '';
                 if(value.id == responseDistrictId){
                    content += `<option value="${value.id}" selected>${capitalize(value.nama)}</option>`;
                 }else{
                    content += `<option value="${value.id}">${capitalize(value.nama)}</option>`;
                 }
                 
                 $("#option-kecamatan").append(content);
            });
        }
    });
}

function setVillage(responseDistrictId,responseVillageId) { 
    $.ajax({
        type: "GET",
        url: "https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=" + responseDistrictId,
        dataType: "json",
        success: function (response) {
            $("#option-kelurahan").html('');
            $.each(response.kelurahan, function (i, value) { 
                
                var content = '';
                if(value.id == responseVillageId){
                    content += `<option value="${value.id}" selected>${capitalize(value.nama)}</option>`;
                }else{
                    content += `<option value="${value.id}">${capitalize(value.nama)}</option>`;
                }
                 
                 $("#option-kelurahan").append(content);
            });
        }
    });
}
$('#option-kecamatan').change(function (e) { 
    e.preventDefault();
    var id = $(this).val();
    $.ajax({
        type: "GET",
        url: "https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=" + id,
        dataType: "json",
        success: function (response) {
            $("#option-kelurahan").html('');
            $.each(response.kelurahan, function (i, value) { 
                
                 var content = '';
                 content += `<option value="${value.id}">${capitalize(value.nama)}</option>`;
                 $("#option-kelurahan").append(content);
            });
        }
    });
});
$('#form-create').submit(function (e) { 
    $(".btn-submit").prop('disabled', true);
    e.preventDefault();
    var dataForm = $(this).serializeArray();
    console.log(dataForm);
    console.log(dataForm[0].value);

    var name = dataForm[0].value;
    var district_id = dataForm[1].value;
    var village_id = dataForm[2].value;
    var rt = dataForm[3].value;
    var rw = dataForm[4].value;
    var address = dataForm[5].value;
    var address_id = $('#address_id').val();
    var owner_id = $('#owner_id').val();

    $.ajax({
        type: "POST",
        url: base_url + 'owner/storeUpdated',
        data: {
            owner_id: owner_id,
            address_id: address_id,
            name: name,
            district_id: district_id,
            village_id: village_id,
            rt: rt,
            rw: rw,
            address: address,
        },
        dataType: "json",
        success: function (response) {
            if(response > 0){
                callbackAlert("Success","Data berhasil diubah!", "success");
            }else{
                failledCallback("Data gagal diubah!");
            }
            setTimeout(function(){ 
                window.location.href = base_url + 'owner';
            }, 3000);
            

            
        }
    });
    
});