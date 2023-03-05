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
    $('#table_dewormings').DataTable();

    $('#table_childrens').DataTable();

    $('#formAddDeworming').validate({
        rules: {
            place_given: "required",
            date_given: "required",
            given_by: "required"
        },
        message: {
            place_given: "Please enter the place given.",
            date_given: "Please select valid date.",
            given_by: "This field is required."
        }
    });

    $('button#btnSave').click(function (e) {
        // e.preventDefault();
        var table = $('#table_childrens').DataTable();
        // table.search('').draw();
        var selected_children = table.$('input[type="checkbox"]').serializeArray();
        var place_given = $('#place_given').val();
        var date_given = $('#date_given').val();
        var given_by = $('#given_by').val();

        if ($('#formAddDeworming').valid()) {
            $.ajax({
                type: "post",
                data: {
                    request_save_deworming: 1,
                    selected: selected_children,
                    place_given: place_given,
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
                            title: 'Deworming Distribution Added Successfully.',
                            confirmButtonText: 'Ok',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).then((result) => {
                            location.href = '../deworming/';
                        });
                    }
                }
            });
        }
    });
});