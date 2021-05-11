var menu_id = $('#menu_id').val();
setUI();
$.ajax({
    type: "POST",
    url: base_url + 'menu/getDetail',
    data: {
        menu_id: menu_id
    },
    dataType: "json",
    success: function (response) {
        $('.panel-title').children().removeClass('icon-pencil-ruler2');
        $('.panel-title').addClass(response['icon']);
        $('.title-menu').html(response['name']);
    }
});


function setUI() { 
    $('.list-permission').html('');
    $.ajax({
        type: "POST",
        url: base_url + 'menu/getPermissionByIdAndMenu',
        data: {
            menu_id: menu_id
        },
        dataType: "json",
        success: function (response) {
            
            $.each(response, function (i, value) { 
                 var html = '';
                    html += `<div class="row">`;
                    html += `<div class="col-sm-6">`;
                    html += `<div class="app-checkbox"> `;
                     if(value.checked == 0){
                        html += `<label><input class="checkPermission" type="checkbox" name="app-checkbox-1" value="${value.permission_id}"> ${value.name}<span></span></label> `;
                     }else{
                        html += `<label><input class="checkPermission" type="checkbox" name="app-checkbox-1" value="${value.permission_id}" checked> ${value.name}<span></span></label> `;
                     }
                     
                    html += `</div>`;
                    html += `</div>`;
                    html += `<div class="col-sm-6 text-right">`;
                    html += `<button type="button" data-id="${value.permission_id}" class="btn btn-sm btn-default btn-icon btn-delete-permission"><span `;
                    html += `class="icon-trash2"></span></button>`;
                    html += `</div>`;
                    html += `</div>`;
                     
                    
    
                $('.list-permission').append(html);
            });
        }
    });
 }


$(document).on('click','.checkPermission', function (e) { 
    var permission_id = $(this).val();
    
    $.ajax({
        type: "POST",
        url: base_url + 'menu/setPermission',
        data: {
            permission_id: permission_id
        },
        dataType: "json",
        success: function (response) {
            if(response){
                setUI();
            }else{
                setUI();
            }

            window.location.href = base_url + 'menu/detail/' + menu_id
        }
    });
    e.preventDefault();
 })


$(document).on('click', '.btn-delete-permission', function (e) { 
    e.preventDefault();

    var permission_id = $(this).data('id');

    var title = "Apakah kamu yakin?";
    var text = "data akan terhapus secara permanent!";
    var icon = "warning";
    var buttons = true;
    var dangerMode = true;
    var deleted = function () { 
        $.ajax({
            type: "POST",
            url: base_url + 'menu/deletePermission',
            data: {
                permission_id: permission_id
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if(response > 0){
                    callbackAlert("Success","Data berhasil ditambahkan!", "success");
                    setUI();
                }else{
                    failledCallback("Data gagal dihapus!");
                }
            }
        });
    }

    alertConfirm(title,text,icon,buttons,dangerMode,deleted,null);
})

