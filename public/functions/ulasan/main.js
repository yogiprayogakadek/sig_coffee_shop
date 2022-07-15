function getData() {
    $.ajax({
        type: "get",
        url: "/owner/ulasan/render",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

$(document).ready(function () {
    getData();

    // on change status
    $('body').on('change', '#status', function() {
        let idUlasan = $(this).data('id');
        let currentStatus = $(this).data('status');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/owner/ulasan/change-status",
            data: {
                id_ulasan: idUlasan,
                status: $(this).val()
            },
            success: function(response) {
                if(response.status != 'success') {
                    $('#status').val(currentStatus);
                }
                getData();
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            },
            error: function(response) {
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            }
        });
    });
});