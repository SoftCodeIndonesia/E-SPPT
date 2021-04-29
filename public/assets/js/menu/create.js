var index = 0;
setParent();
iconClick();
function iconClick() { 
    $('li').click(function (e) {
        e.preventDefault();
        
        if($(this).hasClass('border-icon')){
            $(this).removeClass('border-icon');
        }else{
            $('li').removeClass('border-icon');
            $(this).addClass('border-icon');
        }
        
    });
 }

function setParent() { 
    $.ajax({
        type: "POST",
        url: base_url + 'menu/getParent',
        dataType: "json",
        success: function (response) {
            $("#option-parent").append('');
            $.each(response, function (i, value) { 
                 var content = '';
                 content += `<option value"${value.menu_id}">${capitalize(value.menu)}</option>`;
                 $("#option-parent").append(content);
            });
        }
    });
 }



$('#add-permission').click(function (e) { 
    e.preventDefault();
    var content = '';

    content += '<div class="block permission-content-'+index+'">';
    content += '<div class="app-heading app-heading-small">';
    content += '<div class="title">';
    content += '<h2>Permission</h2>';
    content += '<p>Isi form di bawah ini</p>';
    content += '</div>';
    content += '<div class="heading-elements">';
    content += '<a href="#" id="trash-permission-'+index+'" class="btn btn-default btn-icon"><span class="fa fa-trash"></span></a>';
    content += '</div>';
    content += '</div>';
    content += '<div class="form-group">';
    content += '<label class="col-md-2 control-label" for="permission_name">Name</label>';
    content += '<div class="col-md-10">';
    content += '<input type="text" name="permission_name" id="permission_name" class="form-control"';
    content += 'placeholder="name" autocomplete="off">';
    content += '<span class="help-block form-error text-danger"></span>';
    content += '</div>';
    content += '</div>';
    content += '<div class="form-group">';
    content += '<label class="col-md-2 control-label" for="description_permission">Description</label>';
    content += '<div class="col-md-10">';
    content += '<textarea class="form-control" name="description_permission" id="description_permission"';
    content += 'rows="5"></textarea>';
    content += '</div>';
    content += '</div>';
    content += '</div>';
    
    $('.content-permission').append(content);
    trashContentPermission(index)
    index++;
});

function trashContentPermission(indicator) {
    var label_indicator = '#trash-permission-'+indicator;
    var classContent = '.permission-content-'+indicator;
    $(document).on('click', label_indicator, function (e) {
        e.preventDefault();
        
        $(classContent).remove();
    })
}

$('#form-create').submit(function (e) { 
    $(".btn-submit").prop('disabled', true);
    e.preventDefault();
    var dataForm = $(this).serializeArray();
    var dataMenu = {};
    var dataPermission = [];
    $.each(dataForm, function (i, val) { 
        if(i < 5){
            dataMenu[val.name] = val.value;
        }
    });

    var index = 5;
    do {
        var permissionNameValue = dataForm[index].value;
        var descriptionNameValue = dataForm[index + 1].value;
        var permission = {
            permission_name: permissionNameValue,
            description_permission: descriptionNameValue
        }
        
        dataPermission.push(permission);

        index = index + 2;
    } while (index < dataForm.length);

    
    $.ajax({
        type: "POST",
        url: base_url + 'menu/storeCreated',
        data: {
            menu: dataMenu,
            permission: dataPermission
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
        }
    });

    $(".btn-submit").prop('disabled', false);
});

