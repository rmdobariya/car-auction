$(document).on('click', '.notification_delete', function () {
    const value_id = $(this).data('id')
    Swal.fire({
        title: delete_title,
        text: delete_text,
        type: 'warning',
        showCancelButton: !0,
        confirmButtonColor: '#556ee6',
        cancelButtonColor: '#f46a6a'
    }).then(function (t) {
        if (t.value) {
            deleteRecord(value_id)
        }
    })
})

function deleteRecord(value_id) {
    $.ajax({
        type: 'GET',
        url: APP_URL + '/notification-delete' + '/' + value_id,
        success: function (data) {
            window.location.reload()

        }, error: function (data) {
            console.log('Error:', data)
        }
    })
}
