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

    $('button#btn_close_edit_profile').click(function (e) {
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

    $('button#btn_edit_user').click(function (e) {
        var username = $(this).data('id');

        $.ajax({
            type: "post",
            data: {
                request_user_details: 1,
                username: username
            },
            dataType: "JSON",
            success: function (response) {
                if (response == "false" || response == "request_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed To Load User Details',
                        text: 'Something went wrong, failed to load user details. Please try again.',
                        allowOutsideClick: false
                    });
                } else {
                    $('#username').val(response[0]['username']);
                    $('#first_name').val(response[0]['first_name']);
                    $('#middle_name').val(response[0]['middle_name']);
                    $('#last_name').val(response[0]['last_name']);
                    $('#prefix').val(response[0]['prefix']);
                    $('#sex').val(response[0]['sex']);
                    $('#birthdate').val(response[0]['birthdate']);
                    $('#birthplace').val(response[0]['birthplace']);
                    $('#civil_status').val(response[0]['civil_status']);
                    $('#other_status').val(response[0]['other_status']);
                    $('#religion').val(response[0]['religion']);
                    $('#purok_name').val(response[0]['purok_name']);
                    $('#email').val(response[0]['email']);
                    $('#contact_no').val(response[0]['contact_no']);
                }
            }
        });
    });

});