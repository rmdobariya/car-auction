$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    const table = $('#basic-1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: APP_URL + datatable_url,
            type: 'GET',
            data: function (d) {
                d.status = $('#status').val()
                d.user_type = $('#user_type').val()
                d.deleted = $('#deleted_at').val()
            }
        },
        drawCallback: function () {
            //funTooltip()
            feather.replace()
            KTMenu.init()
            KTMenu.init()
        },
        language: {
            processing: '<div class="spinner-border text-primary m-1" role="status"><span class="sr-only">Loading...</span></div>'
        },
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']]
    })

    $('#data-table-search').keyup(function () {
        table.search($(this).val()).draw()
    })

    $(document).on('change', '.status-filter', function () {
        table.draw()
    })
    $(document).on('click', '#filter', function () {
        if ($('#deleted_at').prop('checked')) {
            var deleted_at = 1;
        } else {
            var deleted_at = 0;
        }
        $('#deleted_at').val(deleted_at);
        $('.menu-sub-dropdown').removeClass('show');
        table.draw()
    })
    $(document).on('click', '#reset-filter', function () {
        $('.menu-sub-dropdown').removeClass('show');
        $('#user_type').val('all')
        $('#deleted_at').val('');
        table.draw()
    })

    $(document).on('click', '.delete-single', function () {
        const value_id = $(this).data('id')

        Swal.fire({
            title: sweetalert_delete_title,
            text: sweetalert_delete_text,
            icon: 'warning',
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: delete_button_text,
            cancelButtonText: cancel_button_text,
            customClass: {
                confirmButton: 'btn fw-bold btn-danger',
                cancelButton: 'btn fw-bold btn-active-light-primary'
            }
        }).then((function (t) {
            if (t.isConfirmed) {
                deleteRecord(value_id)
            }
        }))
    })

    function deleteRecord(value_id) {
        loaderView()
        axios
            .delete(APP_URL + form_url + '/' + value_id)
            .then(function (response) {
                notificationToast(response.data.message, 'success')
                table.draw()
                loaderHide()
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })

    }

    $(document).on('click', '.status-change', function () {
        const value_id = $(this).data('id')
        const status = $(this).data('status')
        console.log(11)
        Swal.fire({
            title: sweetalert_change_status,
            text: sweetalert_change_status_text,
            icon: 'warning',
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: yes_change_it,
            cancelButtonText: cancel_button_text,
            customClass: {
                confirmButton: 'btn fw-bold btn-danger',
                cancelButton: 'btn fw-bold btn-active-light-primary'
            },
        }).then((function (t) {
            if (t.isConfirmed) {
                changeStatus(value_id, status)
            }
        }))
    })

    function changeStatus(value_id, status) {
        loaderView()
        axios
            .get(APP_URL + form_url + '/status' + '/' + value_id + '/' + status)
            .then(function (response) {
                table.draw()
                notificationToast(response.data.message, 'success')
                loaderHide()
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
    }

    $(document).on('click', '.hard-delete-single', function () {
        const value_id = $(this).data('id')

        Swal.fire({
            title: sweetalert_delete_title,
            text: sweetalert_delete_text,
            icon: 'warning',
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            customClass: {
                confirmButton: 'btn fw-bold btn-danger',
                cancelButton: 'btn fw-bold btn-active-light-primary'
            }
        }).then((function (t) {
            if (t.isConfirmed) {
                hardDeleteRecord(value_id)
            }
        }))
    })

    function hardDeleteRecord(value_id) {
        loaderView()
        axios
            .delete(APP_URL + hard_delete_url + '/' + value_id)
            .then(function (response) {
                notificationToast(response.data.message, 'success')
                table.draw()
                loaderHide()
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })

    }

    $(document).on('click', '.restore', function () {
        const value_id = $(this).data('id')

        Swal.fire({
            title: sweetalert_restore_title,
            text: sweetalert_restore_text,
            icon: 'warning',
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            customClass: {
                confirmButton: 'btn fw-bold btn-danger',
                cancelButton: 'btn fw-bold btn-active-light-primary'
            }
        }).then((function (t) {
            if (t.isConfirmed) {
                restoreRecord(value_id)
            }
        }))
    })

    function restoreRecord(value_id) {
        loaderView()
        axios
            .get(APP_URL + restore_url + '/' + value_id)
            .then(function (response) {
                notificationToast(response.data.message, 'success')
                table.draw()
                loaderHide()
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })

    }

    $(document).on('click', '#all_selected', function () {
        console.log(123);
        if ($(this).prop('checked')) {
            $('.all_selected').prop('checked', true)
            $(".all_selected:checked").each(function (e, i) {
                arr.push(this.value);
            });
            $('#select_delete_btn').removeClass('d-none');
            $('#selected_count').text($('.all_selected:checked').length)
        } else {
            arr.splice(0);
            $('.all_selected').prop('checked', false)
            $('#select_delete_btn').addClass('d-none');
            $('#selected_count').text()
        }
    })
    $(document).on('click', '#single_select', function () {
        if ($(this).prop('checked')) {
            arr = [];
            $(".all_selected:checked").each(function (e, i) {
                arr.push(this.value);
            });
            $('#select_delete_btn').removeClass('d-none');
            $('#selected_count').text($('.all_selected:checked').length)
        } else {
            if ($('.all_selected:checked').length <= 0) {
                $('#select_delete_btn').addClass('d-none');
                $('#selected_count').text()
            } else {
                arr = [];
                $(".all_selected:checked").each(function (e, i) {
                    arr.push(this.value);
                });
                $('#select_delete_btn').removeClass('d-none');
                $('#selected_count').text($('.all_selected:checked').length)
            }

        }
    })

    $(document).on('click', '#multiple_record_delete', function () {
        Swal.fire({
            title: multiple_select_title,
            text: multiple_select_text,
            icon: 'warning',
            showCancelButton: !0,
            buttonsStyling: !1,
            confirmButtonText: delete_button_text,
            cancelButtonText: cancel_button_text,
            customClass: {
                confirmButton: 'btn fw-bold btn-danger',
                cancelButton: 'btn fw-bold btn-active-light-primary'
            }
        }).then((function (t) {
            if (t.isConfirmed) {
                multipleDeleteRecord(arr)
            }
        }))
    })

    function multipleDeleteRecord(arr) {
        console.log(arr)
        loaderView()
        axios
            .post(APP_URL + multiple_delete_url, {
                ids: arr
            })
            .then(function (response) {
                notificationToast(response.data.message, 'success')
                loaderHide()
                window.location.reload()
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })

    }

    // integerOnly()
})
