function formReset() {
    document.getElementById("formAddImmunization").reset();
}

$(document).ready(function () {

    $('#table_immunizations').DataTable();

    $('#table_childrens').DataTable();

    // $('#formAddImmunization').validate({
    //     rules: {
    //         vaccine_name: "required",
    //         dose: "required",
    //         date_given: "required",
    //         administered_by: "required"
    //     },
    //     message: {
    //         vaccine_name: "Please enter weight",
    //         dose: "Please enter height",
    //         date_given: "This field is required",
    //         administered_by: "This field is required"
    //     }
    // });

    $('#btn_close_modal').click(function (e) {
        formReset();
    });

    $(document).on('click', '#btnAddImmunization', function () {
        var id = $(this).data('id');

        $.ajax({
            type: "post",
            data: {
                request_children_details: 1,
                children_id: id
            },
            dataType: "JSON",
            success: function (response) {
                if (response == "false" || response == "request_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong.',
                        text: 'Failed to process request, please try again.',
                        allowOutsideClick: false
                    });
                } else {
                    $('#children_id').val(id);
                    $('#children_name').text('Name: ' + response[0]['name']);
                }
            }
        });
    });

    $('#btn_add_immunization').click(function (e) {
        e.preventDefault();
        var id = $('#children_id').val();
        var vaccine_name = $('#txt_vaccineName').val();
        var dose = $('#txt_dose').val();
        var date_given = $('#txt_date_given').val();
        var immunization_type = $('#txt_immunization_type').val();
        var administered_by = $('#txt_administered_by').val();

        if ($('#formAddImmunization').valid()) {
            $.ajax({
                type: "post",
                data: {
                    request_save_immunization: 1,
                    children_id: id,
                    vaccine_name: vaccine_name,
                    dose: dose,
                    date_given: date_given,
                    immunization_type: immunization_type,
                    administered_by: administered_by
                },
                dataType: "JSON",
                success: function (response) {
                    if (response == "true") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Immunization added successfully.',
                            confirmButtonText: 'Ok',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong.',
                            text: 'Failed to process request, please try again.',
                            allowOutsideClick: false
                        });
                    }
                }
            });
        }
    });
});