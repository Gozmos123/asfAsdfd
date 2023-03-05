children_birthdate.max = current_date;

function civil_status_change() {
    if (document.getElementById('children_civil_status').value === "Other") {
        children_other_status.required = true;
    } else {
        children_other_status.required = false;
    }
}

$(document).ready(function () {
    civil_status_change();

    $('#table_childrens').DataTable();

    $('#table_vitamins').DataTable();
    $('#table_deworming').DataTable();
    $('#table_weights').DataTable();
    $('#table_immunizations').DataTable();

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

    $(document).on('click', '#btn_edit_children', function () {
        var id = $(this).data('id');
        var m_id = $('#m_id').val();
        $.ajax({
            type: "post",
            data: {
                request_mother_details: 1,
                id: m_id
            },
            dataType: "JSON",
            success: function (response) {
                if (response == "false" || response == "request_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed To Load Details',
                        text: 'Something went wrong, failed to load details. Please try again.',
                        allowOutsideClick: false
                    });
                } else {
                    $('#mother_id').val(response[0]['id']);
                    $('#mother_name').text('Mother: ' + response[0]['first_name'] + ' ' + response[0]['middle_name'] + ' ' + response[0]['last_name']);
                    $('#profile_children_id').val(id);

                    $.ajax({
                        type: "post",
                        data: {
                            request_children_details: 1,
                            id: id
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if (response == "false" || response == "request_failed") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed To Load Details',
                                    text: 'Something went wrong, failed to load details. Please try again.',
                                    allowOutsideClick: false
                                });
                            } else {
                                $('#children_first_name').val(response[0]['first_name']);
                                $('#children_middle_name').val(response[0]['middle_name']);
                                $('#children_last_name').val(response[0]['last_name']);
                                $('#children_prefix').val(response[0]['prefix']);
                                $('#children_sex').val(response[0]['sex']);
                                $('#children_birthdate').val(response[0]['birthdate']);
                                $('#children_birthplace').val(response[0]['birthplace']);
                                $('#children_civil_status').val(response[0]['civil_status']);
                                $('#children_other_status').val(response[0]['other_status']);
                                $('#children_religion').val(response[0]['religion']);
                                $('#children_purok_name').val(response[0]['purok_name']);
                                $('#children_email').val(response[0]['email']);
                                $('#children_contact_no').val(response[0]['contact_no']);
                            }
                        }
                    });
                }
            }
        });
    });
});