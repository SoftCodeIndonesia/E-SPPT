$('#add-permission').submit(function (e) { 
    e.preventDefault();
    
    var dataForm = $(this).serializeArray();
    var menu_id = $('#menu_id').val();

    console.log(dataForm[0]);
    var permission_name = dataForm[0].value;
    var description_permission = dataForm[1].value;
    $.ajax({
        type: "POST",
        url: base_url + 'menu/storePermission',
        data: {
            menu_id: menu_id,
            permission_name: permission_name,
            description_permission: description_permission
        },
        dataType: "json",
        success: function (response) {
            if(response){
                callbackAlert("Success","Data berhasil ditambahkan!", "success");
                $('#permission_name').val('');
                $('#description_permission').val('');
            }
        }
    });
    
    
});