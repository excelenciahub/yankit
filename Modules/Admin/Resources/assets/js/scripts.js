$(document).ready(function () {
    $(document).delegate('form.validation', 'submit', function (e) {
        e.preventDefault();
        if ($(this).addClass("was-validated"), !1 !== $(this)[0].checkValidity() || (e.preventDefault(), e.stopPropagation(), !1)) {
            $('#preloader,#status').show();
            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $(form).closest('.modal').modal('hide');
                    $('#preloader,#status').hide();
                    Swal.fire("Saved!", data.message, "success").then(function (data) {
                        window.location.reload();
                    });
                },
                error: function (reject) {
                    $('#preloader,#status').hide();
                    var message = 'Something went wrong.';
                    if (reject.status === 422) {
                        var errors = $.parseJSON(reject.responseText);
                        message = '';
                        $.each(errors.errors, function (key, val) {
                            message += val[0] + '<br/>';
                        });
                    }
                    else if (reject.status === 403) {
                        message = $.parseJSON(reject.responseText).message;
                    }
                    Swal.fire("Oops...", message, 'error');
                }
            });
        }
    });
    $(document).delegate('.table .status', 'click', function (e) {
        e.preventDefault();
        $('#preloader,#status').show();
        var obj = $(this);
        $.ajax({
            type: "POST",
            url: $(obj).attr('href'),
            type: 'PATCH',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "status": $(obj).data('status'),
            },
            success: function (data) {
                $('#preloader,#status').hide();
                Swal.fire("Saved!", data.message, "success").then(function (data) {
                    window.location.reload();
                });
            },
            error: function (reject) {
                $('#preloader,#status').hide();
                var message = 'Something went wrong.';
                if (reject.status === 422) {
                    var errors = $.parseJSON(reject.responseText);
                    message = '';
                    $.each(errors.errors, function (key, val) {
                        message += val[0] + '<br/>';
                    });
                }
                else if (reject.status === 403) {
                    message = $.parseJSON(reject.responseText).message;
                }
                Swal.fire("Oops...", message, 'error');
            }
        });
    });
    $(".data-datatable").DataTable({
        columnDefs: [
            { orderable: false, targets: -1 }
        ],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    });
    $(document).delegate('.table .edit', 'click', function (e) {
        e.preventDefault();
        var title = $(this).data('title');
        $($(this).data('modal')).modal('show').find('.modal-title').html(title).end().find('.modal-body').load($(this).attr('href'), function () {
            $('#pickup_date').datetimepicker({
                format: 'Y-m-d',
                formatDate: 'Y-m-d',
                timepicker: false,
                scrollInput: false,
                allowBlank: true,
            });
            $("#pickup-start-time").flatpickr({ enableTime: !0, noCalendar: !0, dateFormat: "H:i", minuteIncrement: 15 })
            $("#pickup-end-time").flatpickr({ enableTime: !0, noCalendar: !0, dateFormat: "H:i", minuteIncrement: 15 })
            $('[data-toggle="select2"]').select2();
        });
    });
    $(document).delegate('.table .assign-order', 'click', function (e) {
        e.preventDefault();
        var title = $(this).data('title');
        $($(this).data('modal')).modal('show').find('.modal-title').html(title).end().find('.modal-body').load($(this).data('url'), function () {
            
        });
    });
    $(document).delegate('.table .orders', 'click', function (e) {
        e.preventDefault();
        var title = $(this).data('title');
        $($(this).data('modal')).modal('show').find('.modal-title').html(title).end().find('.modal-body').load($(this).data('url'), function () {
            
        });
    });
    $(document).delegate('.table .delete', 'click', function (e) {
        e.preventDefault();
        var obj = $(this);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(function (data) {
            if (data.value) {
                $('#preloader,#status').show();
                $.ajax({
                    url: $(obj).attr('href'),
                    type: 'DELETE',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (data) {
                        $('#preloader,#status').hide();
                        Swal.fire("Deleted!", data.message, "success").then(function (data) {
                            window.location.reload();
                        });
                    },
                    error: function (reject) {
                        $('#preloader,#status').hide();
                        Swal.fire("Oops...", "Something went wrong.", "error");
                    }
                });
            }
        });
    });
    $('.datepicker').datetimepicker({
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        timepicker: false,
        minDate: 'now',
        scrollInput: false,
        allowBlank: true,
    });
});
