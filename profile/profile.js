const current_date = new Date().toLocaleDateString('fr-ca');
birthdate.max = current_date;

function civil_status_change() {
    if (document.getElementById('civil_status').value === "Other") {
        other_status.required = true;
    } else {
        other_status.required = false;
    }
}

$(document).ready(function () {
    civil_status_change();

    $('#btn_close_edit_profile').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure you want to cancel editing?',
            text: "All changes will be discarded!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    });

    $('button#btn_change_password').click(function (e) {
        var username = $('#username').text();
        var current_password = $('#current_password').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();

        if (!(current_password.trim() == "" || password.trim() == "" || password_confirmation.trim() == "" || password.length < 8 || password_confirmation.length < 8)) {
            e.preventDefault();
            $.ajax({
                type: "post",
                data: {
                    verify_password: 1,
                    username: username,
                    password: current_password
                },
                dataType: "JSON",
                success: function (response) {
                    if (response == "request_failed") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Change Password Failed',
                            text: 'Something went wrong, failed to process request. Please try again.',
                            allowOutsideClick: false
                        });
                    } else if (response == "false") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Current password is incorrect.',
                            allowOutsideClick: false
                        });
                    } else {
                        if (password != password_confirmation) {
                            Swal.fire({
                                icon: 'error',
                                title: 'New password and confirmation do not match.',
                                allowOutsideClick: false
                            });
                        } else {
                            $.ajax({
                                type: "post",
                                data: {
                                    change_password: 1,
                                    username: username,
                                    password: password_confirmation
                                },
                                dataType: "JSON",
                                success: function (response) {
                                    if (response == "true") {
                                        Swal.fire({
                                            // toast: true,
                                            // position: 'top',
                                            icon: 'success',
                                            title: 'Password Changed Successfully.',
                                            confirmButtonText: 'Ok',
                                            // showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                // Swal.showLoading()
                                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                                            }
                                        }).then((result) => {
                                            // $('#current_password').val('');
                                            // $('#password').val('');
                                            // $('#password_confirmation').val('');
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Change Password Failed',
                                            text: 'Something went wrong, failed to change password. Please try again.',
                                            allowOutsideClick: false
                                        });
                                    }
                                }
                            });
                        }
                    }
                }
            });
        }
    });
});