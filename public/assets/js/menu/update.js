var menu_id = $("#menu_id").val();
setUI();

$('#form-create').submit(function (e) { 
    $(".btn-submit").prop('disabled', true);
    e.preventDefault();
    var dataForm = $(this).serializeArray();


    
    $.ajax({
        type: "POST",
        url: base_url + 'menu/storeUpdate',
        data: {
            menu: dataForm,
            menu_id: menu_id
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if(response > 0){
                callbackAlert("Success","Data berhasil diubah!", "success");
            }else{
                failledCallback("Data gagal diubah!");
            }

            // window.location.href = base_url + 'menu';
        }
    });

    $(".btn-submit").prop('disabled', false);
});



function setUI() { 
    $('.btn-icon').click(function (e) { 
        $('.modal').modal("hide");
        var icon = $(this).children().attr('class');
        $('.icon_menu').val(icon);
        
        e.preventDefault();
        
    });

    $.ajax({
        type: "POST",
        url: base_url + 'menu/getDetail',
        data: {
            menu_id: menu_id
        },
        dataType: "json",
        success: function (response) {
            $('#name').val(response.name);
            $('#label').val(response.label);
            $('#route').val(response.route);
            $('#description').val(response.description);
            $('.icon_menu').val(response.icon);
            console.log(response);
        }
    });

    $.ajax({
        type: "POST",
        url: base_url + 'menu/getParent',
        dataType: "json",
        success: function (response) {
            $('#option-parent').html('');

            $.each(response, function (i, value) { 
                var html = '';
                 if(i == 0){
                    html += `<option value="0">This parent</option>`;
                    if(value.menu_id == menu_id){
                        html += `<option value="${value.menu_id}" selected>${value.name}</option>`;
                    }else{
                        html += `<option value="${value.menu_id}" selected>${value.name}</option>`; 
                    }
                    
                 }else{
                    if(value.menu_id == menu_id){
                        html += `<option value="${value.menu_id}" selected>${value.name}</option>`;
                    }else{
                        html += `<option value="${value.menu_id}" selected>${value.name}</option>`; 
                    }
                 }

                 $('#option-parent').append(html);
            });
        }
    });
}
