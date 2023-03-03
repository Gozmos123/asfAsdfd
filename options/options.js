$(document).ready(function () {
    $('#table_civil_status').DataTable();
    $('#table_immunizations_type').DataTable();
    $('#table_religions').DataTable();
    $('#table_puroks').DataTable();

    $('button#btn_close_modal').click(function (e) {
        // e.preventDefault();
        $('#txt_purok_name').val('');
        $('#purok_id').val('');
        $('#edit_txt_purok_name').val('');

        $('#txt_civil_status').val('');
        $('#civil_status_id').val('');
        $('#edit_txt_civil_status').val('');

        $('#txt_immune_type').val('');
        $('#immune_id').val('');
        $('#edit_txt_immune_type').val('');

        $('#txt_religion').val('');
        $('#religion_id').val('');
        $('#edit_txt_religion').val('');
    });

    $('button#btn_add_civil_status').click(function (e) {
        e.preventDefault();
        var civil_status = $('#txt_civil_status').val();
        if (civil_status.trim() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Civil Status Empty.',
                allowOutsideClick: false
            });
        } else {
            // check exist
            $.ajax({
                type: "post",
                data: {
                    civil_status_exist: 1,
                    value: civil_status
                },
                dataType: "JSON",
                success: function (response) {
                    if (response == "true") {
                        Swal.fire({
                            icon: 'error',
                            title: civil_status + ' is already added.',
                            allowOutsideClick: false
                        });
                    } else {
                        // if ! -> save
                        $.ajax({
                            type: "post",
                            data: {
                                request_add_civil_status: 1,
                                civil_status: civil_status
                            },
                            dataType: "JSON",
                            success: function (response) {
                                // saved
                                if (response == "true") {
                                    Swal.fire({
                                        icon: 'success',
                                        title: civil_status + ' civil status is added successfully.',
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
                                    // not saved
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed to process request.',
                                        text: 'Something went wrong, please try again.',
                                        allowOutsideClick: false
                                    });
                                }
                            }
                        });
                    }
                }
            });
        }
    });

    $('button#btn_edit_status').click(function (e) {
        // e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            type: "post",
            data: {
                request_civil_status: 1,
                id: id
            },
            dataType: "JSON",
            success: function (response) {
                if (response == "false" || response == "request_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to load.',
                        text: 'Something went wrong, please try again.',
                        allowOutsideClick: false
                    });
                } else {
                    $('#civil_status_id').val(response.id);
                    $('#edit_txt_civil_status').val(response.civil_status);
                }
            }
        });
    });

    $('button#btn_update_civil_status').click(function (e) {
        e.preventDefault();
        var id = $('#civil_status_id').val();
        var civil_status = $('#edit_txt_civil_status').val();
        if (id.trim() == "" || civil_status.trim() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Civil Status Empty.',
                allowOutsideClick: false
            });
        } else {

            Swal.fire({
                title: 'Update Warning!!!',
                text: "Updating this data will update all records referenced to this. Are you sure you want to continue updating this data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        data: {
                            request_update_civil_status: 1,
                            id: id,
                            civil_status: civil_status
                        },
                        dataType: "JSON",
                        success: function (response) {
                            // saved
                            if (response == "true") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Civil status is updated successfully.',
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
                                // not saved
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to process request.',
                                    text: 'Something went wrong, please try again.',
                                    allowOutsideClick: false
                                });
                            }
                        }
                    });
                }
            });
        }
    });

    // immunuzaiton
    $('button#btn_add_immune').click(function (e) {
        e.preventDefault();
        var immune_type = $('#txt_immune_type').val();
        if (immune_type.trim() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Immunization Type is Empty.',
                allowOutsideClick: false
            });
        } else {
            // check exist
            $.ajax({
                type: "post",
                data: {
                    immunizationType_exist: 1,
                    value: immune_type
                },
                dataType: "JSON",
                success: function (response) {
                    if (response == "true") {
                        Swal.fire({
                            icon: 'error',
                            title: immune_type + ' is already added.',
                            allowOutsideClick: false
                        });
                    } else {
                        // if ! -> save
                        $.ajax({
                            type: "post",
                            data: {
                                request_add_immune: 1,
                                immune_type: immune_type
                            },
                            dataType: "JSON",
                            success: function (response) {
                                // saved
                                if (response == "true") {
                                    Swal.fire({
                                        icon: 'success',
                                        title: immune_type + ' is added successfully.',
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
                                    // not saved
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed to process request.',
                                        text: 'Something went wrong, please try again.',
                                        allowOutsideClick: false
                                    });
                                }
                            }
                        });
                    }
                }
            });
        }
    });

    $('button#btn_edit_immune').click(function (e) {
        // e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            type: "post",
            data: {
                request_immunization_type: 1,
                id: id
            },
            dataType: "JSON",
            success: function (response) {
                if (response == "false" || response == "request_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to load.',
                        text: 'Something went wrong, please try again.',
                        allowOutsideClick: false
                    });
                } else {
                    $('#immune_id').val(response.id);
                    $('#edit_txt_immune_type').val(response.immunization_type);
                }
            }
        });
    });

    $('button#btn_update_immune').click(function (e) {
        e.preventDefault();
        var id = $('#immune_id').val();
        var immune_type = $('#edit_txt_immune_type').val();
        if (id.trim() == "" || immune_type.trim() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Immunization Type is Empty.',
                allowOutsideClick: false
            });
        } else {
            Swal.fire({
                title: 'Update Warning!!!',
                text: "Updating this data will update all records referenced to this. Are you sure you want to continue updating this data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        data: {
                            request_update_immune: 1,
                            id: id,
                            immune_type: immune_type
                        },
                        dataType: "JSON",
                        success: function (response) {
                            // saved
                            console.log(response);
                            if (response == "true") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Immunization type is updated successfully.',
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
                                // not saved
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to process request.',
                                    text: 'Something went wrong, please try again.',
                                    allowOutsideClick: false
                                });
                            }
                        }
                    });
                }
            });
        }
    });

    // religion
    $('button#btn_add_religion').click(function (e) {
        e.preventDefault();
        var religion = $('#txt_religion').val();
        if (religion.trim() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Religion is Empty.',
                allowOutsideClick: false
            });
        } else {
            // check exist
            $.ajax({
                type: "post",
                data: {
                    religion_exist: 1,
                    value: religion
                },
                dataType: "JSON",
                success: function (response) {
                    if (response == "true") {
                        Swal.fire({
                            icon: 'error',
                            title: religion + ' is already added.',
                            allowOutsideClick: false
                        });
                    } else {
                        // if ! -> save
                        $.ajax({
                            type: "post",
                            data: {
                                request_add_religion: 1,
                                religion_name: religion
                            },
                            dataType: "JSON",
                            success: function (response) {
                                // saved
                                if (response == "true") {
                                    Swal.fire({
                                        icon: 'success',
                                        title: religion + ' is added successfully.',
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
                                    // not saved
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed to process request.',
                                        text: 'Something went wrong, please try again.',
                                        allowOutsideClick: false
                                    });
                                }
                            }
                        });
                    }
                }
            });
        }
    });

    $('button#btn_edit_religion').click(function (e) {
        // e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            type: "post",
            data: {
                request_religion: 1,
                id: id
            },
            dataType: "JSON",
            success: function (response) {
                if (response == "false" || response == "request_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to load.',
                        text: 'Something went wrong, please try again.',
                        allowOutsideClick: false
                    });
                } else {
                    $('#religion_id').val(response.id);
                    $('#edit_txt_religion').val(response.religion_name);
                }
            }
        });
    });

    $('button#btn_update_religion').click(function (e) {
        e.preventDefault();
        var id = $('#religion_id').val();
        var religion = $('#edit_txt_religion').val();
        if (id.trim() == "" || religion.trim() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Religion is Empty.',
                allowOutsideClick: false
            });
        } else {
            Swal.fire({
                title: 'Update Warning!!!',
                text: "Updating this data will update all records referenced to this. Are you sure you want to continue updating this data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        data: {
                            request_update_religion: 1,
                            id: id,
                            religion_name: religion
                        },
                        dataType: "JSON",
                        success: function (response) {
                            // saved
                            console.log(response);
                            if (response == "true") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Religion name is updated successfully.',
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
                                // not saved
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to process request.',
                                    text: 'Something went wrong, please try again.',
                                    allowOutsideClick: false
                                });
                            }
                        }
                    });
                }
            });
        }
    });

    // purok
    $('button#btn_add_purok').click(function (e) {
        e.preventDefault();
        var purok = $('#txt_purok_name').val();
        if (purok.trim() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Purok is Empty.',
                allowOutsideClick: false
            });
        } else {
            // check exist
            $.ajax({
                type: "post",
                data: {
                    purok_exist: 1,
                    value: purok
                },
                dataType: "JSON",
                success: function (response) {
                    if (response == "true") {
                        Swal.fire({
                            icon: 'error',
                            title: purok + ' is already added.',
                            allowOutsideClick: false
                        });
                    } else {
                        // if ! -> save
                        $.ajax({
                            type: "post",
                            data: {
                                request_add_purok: 1,
                                purok_name: purok
                            },
                            dataType: "JSON",
                            success: function (response) {
                                // saved
                                if (response == "true") {
                                    Swal.fire({
                                        icon: 'success',
                                        title: purok + ' is added successfully.',
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
                                    // not saved
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed to process request.',
                                        text: 'Something went wrong, please try again.',
                                        allowOutsideClick: false
                                    });
                                }
                            }
                        });
                    }
                }
            });
        }
    });

    $('button#btn_edit_purok').click(function (e) {
        // e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            type: "post",
            data: {
                request_purok: 1,
                id: id
            },
            dataType: "JSON",
            success: function (response) {
                if (response == "false" || response == "request_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to load.',
                        text: 'Something went wrong, please try again.',
                        allowOutsideClick: false
                    });
                } else {
                    $('#purok_id').val(response.id);
                    $('#edit_txt_purok_name').val(response.purok_name);
                }
            }
        });
    });

    $('button#btn_update_purok').click(function (e) {
        e.preventDefault();
        var id = $('#purok_id').val();
        var purok = $('#edit_txt_purok_name').val();
        if (id.trim() == "" || purok.trim() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Purok is Empty.',
                allowOutsideClick: false
            });
        } else {
            Swal.fire({
                title: 'Update Warning!!!',
                text: "Updating this data will update all records referenced to this. Are you sure you want to continue updating this data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        data: {
                            request_update_purok: 1,
                            id: id,
                            purok_name: purok
                        },
                        dataType: "JSON",
                        success: function (response) {
                            // saved
                            console.log(response);
                            if (response == "true") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Purok name is updated successfully.',
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
                                // not saved
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to process request.',
                                    text: 'Something went wrong, please try again.',
                                    allowOutsideClick: false
                                });
                            }
                        }
                    });
                }
            });
        }
    });
});
