$(document).ready(function () {
    $('#show_password').click(function (e) {
        // e.preventDefault();
        var passwd = document.getElementById('password');
        if (passwd.type === "password") {
            passwd.type = "text";
        } else {
            passwd.type = "password";
        }
    });

    $('button#btn_login').click(function (e) {
        var username = $('#username').val();
        var password = $('#password').val();

        if (!(username.trim() == "" || password.trim() == "")) {
            e.preventDefault();
            $.ajax({
                type: "post",
                data: {
                    authenticate_login: 1,
                    username: username,
                    password: password
                },
                dataType: "JSON",
                success: function (response) {
                    // console.log(response);
                    if (response == 'request_failed') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: 'Something went wrong, failed to process request. Please try again.',
                            allowOutsideClick: false
                        });
                    } else if (response == "false") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: 'Incorrect username or password, please try again.',
                            allowOutsideClick: false
                        });
                    } else {
                        location.href = '../dashboard/';
                    }
                }
            });
        }
    });
});