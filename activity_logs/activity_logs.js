$(document).ready(function () {

    $('#table_activity_logs').DataTable();

    $(document).on('click', '#btn_view_log', function () {
        var log_id = $(this).data('id');

        $.ajax({
            type: "post",
            data: {
                request_log_details: 1,
                id: log_id
            },
            dataType: "JSON",
            success: function (response) {
                if (response == "false" || response == "request_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed To Load Log',
                        text: 'Something went wrong, failed to load log details. Please try again.',
                        allowOutsideClick: false
                    });
                } else {
                    $('#username').text(response[0]['username']);
                    $('#action').text(response[0]['action']);
                    $('#log_content').text(response[0]['content']);
                    $('#log_changes').text(response[0]['changes']);
                    $('#date').text(response[0]['created_at']);
                }
            }
        });
    });
});