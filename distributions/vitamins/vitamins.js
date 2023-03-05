$(document).ready(function () {

    // $('#table_childrens').DataTable({
    //     "language": {
    //         searchPlaceholder: "Search children:"
    //     },
    //     "ajax": {
    //         "url": "children_list.function.php",
    //         "type": "post",
    //         "data": { "request_list": 1 },
    //         "dataSrc": ""
    //     },
    //     "columns": [
    //         { "data": "id" },
    //         { "data": "name" },
    //         { "data": "age" },
    //         { "data": "sex" },
    //         { "data": "mother" }
    //     ]
    // });
    $('#table_vitamins').DataTable();

    $('#table_childrens').DataTable();

    $('#formAddVitamin').validate({
        rules: {
            date_given: "required",
            given_by: "required"
        },
        message: {
            date_given: "Please select valid date.",
            given_by: "This field is required."
        }
    });

    $('button#btnSave').click(function (e) {
        // e.preventDefault();
        var table = $('#table_childrens').DataTable();
        // table.search('').draw();
        var selected_children = table.$('input[type="checkbox"]').serializeArray();
        var date_given = $('#date_given').val();
        var given_by = $('#given_by').val();

        if ($('#formAddVitamin').valid()) {
            $.ajax({
                type: "post",
                data: {
                    request_save_vitamin: 1,
                    selected: selected_children,
                    date_given: date_given,
                    given_by: given_by
                },
                dataType: "JSON",
                success: function (response) {
                    if (response == "no_selected") {
                        Swal.fire({
                            icon: 'error',
                            title: 'No children selected',
                            text: 'Please select the children/s received vitamins.',
                            allowOutsideClick: false
                        });
                    } else if (response == "false" || response == "request_failed") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong.',
                            text: 'Failed to process request, please try again.',
                            allowOutsideClick: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Vitamin Distribution Added Successfully.',
                            confirmButtonText: 'Ok',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).then((result) => {
                            location.href = '../vitamins/';
                        });
                    }
                }
            });
        }
    });
});