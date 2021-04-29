$(document).ready(function () {
    $('.btn-login').click(function (e) { 
        e.preventDefault();
        var email = $('#email').val();
        var password = $("#password").val()

        $.ajax({
            type: "POST",
            url: base_url + 'login/storeLogin',
            data: {
                email: email,
                password: password
            },
            dataType: "json",
            success: function (response) {
                $.ajax({
                    type: "POST",
                    url: base_url + "Login/checkHash",
                    data: {
                        hash: password,
                        password: response.password
                    },
                    dataType: "json",
                    success: function (callBack) {
                        if(callBack)
                        {
                            $.ajax({
                                type: "POST",
                                url: base_url + "login/setSession",
                                data: {
                                    data: response
                                },
                                success: function () {
                                    window.location.href = base_url
                                }
                            });
                        }else{
                            $('#alert_validation').append('');
                            $('#alert_validation').append(`<div class="alert alert-danger" role="alert">
                                Email atau password salah!!
                            </div>`);
                        }
                    }
                });
            }
        });
    });
    
});