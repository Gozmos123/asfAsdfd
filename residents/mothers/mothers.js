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

    $('button#btn_close_modal').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure you want to cancel?',
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


    $('button#btn_edit_mother').click(function (e) {
        var id = $(this).data('id');

        $.ajax({
            type: "post",
            data: {
                request_mother_details: 1,
                id: id
            },
            dataType: "JSON",
            success: function (response) {
                console.log(response[0]['id']);
                if (response == "false" || response == "request_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed To Load Details',
                        text: 'Something went wrong, failed to load details. Please try again.',
                        allowOutsideClick: false
                    });
                } else {
                    $('#edit_id').val(response[0]['id']);
                    $('#edit_first_name').val(response[0]['first_name']);
                    $('#edit_middle_name').val(response[0]['middle_name']);
                    $('#edit_last_name').val(response[0]['last_name']);
                    $('#edit_sex').val(response[0]['sex']);
                    $('#edit_birthdate').val(response[0]['birthdate']);
                    $('#edit_birthplace').val(response[0]['birthplace']);
                    $('#edit_civil_status').val(response[0]['civil_status']);
                    $('#edit_other_status').val(response[0]['other_status']);
                    $('#edit_religion').val(response[0]['religion']);
                    $('#edit_purok_name').val(response[0]['purok_name']);
                    $('#edit_email').val(response[0]['email']);
                    $('#edit_contact_no').val(response[0]['contact_no']);
                }
            }
        });
    });
});