function formReset() {
    document.getElementById("formAddWeight").reset();
}

$(document).ready(function () {

    $('#table_weights').DataTable();

    $('#table_childrens').DataTable();

    // $('#formAddWeight').validate({
    //     rules: {
    //         weight: "required",
    //         height: "required",
    //         checked_by: "required",
    //         date_checked: "required"
    //     },
    //     message: {
    //         weight: "Please enter weight",
    //         height: "Please enter height",
    //         checked_by: "This field is required",
    //         date_checked: "This field is required"
    //     }
    // });

    $('#btn_close_modal').click(function (e) {
        formReset();
    });

    $(document).on('click', '#btnAddWeight', function () {
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

    $('#btn_add_weight').click(function (e) {
        e.preventDefault();
        var id = $('#children_id').val();
        var weight = $('#txt_weight').val();
        var height = $('#txt_height').val();
        var checked_by = $('#txt_checked_by').val();
        var date_checked = $('#txt_date_checked').val();

        if ($('#formAddWeight').valid()) {
            $.ajax({
                type: "post",
                data: {
                    request_save_weight: 1,
                    children_id: id,
                    weight: weight,
                    height: height,
                    checked_by: checked_by,
                    date_checked: date_checked
                },
                dataType: "JSON",
                success: function (response) {
                    if (response == "true") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Weight added successfully.',
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