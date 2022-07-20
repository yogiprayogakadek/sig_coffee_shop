function getData() {
    $.ajax({
        type: "get",
        url: "/owner/kedai/render",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function tambah() {
    $.ajax({
        type: "get",
        url: "/owner/kedai/create",
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

    $('body').on('click', '.btn-add', function () {
        tambah();
    });

    $('body').on('click', '.btn-data', function () {
        getData();
    });

    // on save button
    $('body').on('click', '.btn-save', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formAdd')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/owner/kedai/store",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-save').attr('disable', 'disabled')
                $('.btn-save').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-save').removeAttr('disable')
                $('.btn-save').html('Simpan')
            },
            success: function (response) {
                $('#formAdd').trigger('reset')
                $(".invalid-feedback").html('')
                getData();
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            },
            error: function (error) {
                let formName = []
                let errorName = []

                $.each($('#formAdd').serializeArray(), function (i, field) {
                    formName.push(field.name.replace(/\[|\]/g, ''))
                });
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function (key, value) {
                            errorName.push(key)
                            if($('.'+key).val() == '') {
                                $('.' + key).addClass('is-invalid')
                                $('.error-' + key).html(value)
                            }
                        })
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1 ? $('.'+field).removeClass('is-invalid') : $('.'+field).addClass('is-invalid');
                        });
                    }
                }
            }
        });
    });

    $('body').on('click', '.btn-edit', function () {
        let id = $(this).data('id')
        $.ajax({
            type: "get",
            url: "/owner/kedai/edit/" + id,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    });

    // on update button
    $('body').on('click', '.btn-update', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formEdit')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/owner/kedai/update",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-update').attr('disable', 'disabled')
                $('.btn-update').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-update').removeAttr('disable')
                $('.btn-update').html('Simpan')
            },
            success: function (response) {
                $('#formEdit').trigger('reset')
                $(".invalid-feedback").html('')
                getData();
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            },
            error: function (error) {
                let formName = []
                let errorName = []

                $.each($('#formEdit').serializeArray(), function (i, field) {
                    formName.push(field.name.replace(/\[|\]/g, ''))
                });
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function (key, value) {
                            errorName.push(key)
                            if($('.'+key).val() == '') {
                                $('.' + key).addClass('is-invalid')
                                $('.error-' + key).html(value)
                            }
                        })
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1 ? $('.'+field).removeClass('is-invalid') : $('.'+field).addClass('is-invalid');
                        });
                    }
                }
            }
        });
    });

    $('body').on('click', '.btn-delete', function () {
        let id = $(this).data('id')
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang sudah dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: "/owner/kedai/delete/" + id,
                    dataType: "json",
                    success: function (response) {
                        $(".render").html(response.data);
                        getData();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        );
                    },
                    error: function (error) {
                        console.log("Error", error);
                    },
                });
            }
        })
    });


    // on change status
    $('body').on('change', '#status', function() {
        let idKedai = $(this).data('id');
        let currentStatus = $(this).data('status');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/owner/kedai/change-status",
            data: {
                id_kedai: idKedai,
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

    $('body').on('click', '.btn-add-suasana', function () {
        let id = $(this).data('id')
        $('#modalSuasana').find('#id_kedai').val(id)
        $('#modalSuasana').modal('show');
    });

    $('body').on('click', '.btn-upload', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formUpload')[0]
        let data = new FormData(form)
        if($('#photos').val() == '') {
            Swal.fire({
                title: 'Pilih file terlebih dahulu!',
                text: "",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else {
            $.ajax({
                type: "POST",
                url: "/owner/kedai/upload",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $('.btn-upload').attr('disable', 'disabled')
                    $('.btn-upload').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                complete: function () {
                    $('.btn-upload').removeAttr('disable')
                    $('.btn-upload').html('Simpan')
                },
                success: function (response) {
                    $('#formUpload').trigger('reset')
                    $(".invalid-feedback").html('')
                    getData();
                    Swal.fire(
                        response.title,
                        response.message,
                        response.status
                    );
                    $('#modalSuasana').modal('hide');
                },
                error: function (error) {
                    console.log("Error", error);
                }
            });
        }
    });

    $('body').on('click', '.btn-edit-suasana', function () {
        let id = $(this).data('id')
        $('#modalSuasana').find('#id_kedai').val(id)
        $('#modalSuasana').modal('show');
        
        $.get("/owner/kedai/detail/"+id,function (data) {
            $.each(data, function (index, value) { 
                let image = '<div class="col-md-3">'+
                                '<div class="card-body">'+
                                    '<p class="card-description">'+
                                        '<img src="'+assets(value.foto)+'" class="img-thumbnail delete-image" style="cursor: pointer" data-id="'+value.id+'">'+
                                    '</p>'+
                                '</div>'+
                            '</div>';
                $('.photos').append(image)
            });
            $('#modalSuasana').find('.noted').text('Klik gambar untuk menghapus')
        });
    });

    $('body').on('click', '.delete-image', function () {
        let id_kedai = $('#modalSuasana').find('#id_kedai').val()
        let id_foto = $(this).data('id')

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang sudah dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: "/owner/kedai/delete-image/" + id_kedai + "/" + id_foto,
                    dataType: "json",
                    success: function (response) {
                        $('#modalSuasana').modal('hide');
                        getData();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        );
                    },
                    error: function (error) {
                        console.log("Error", error);
                    },
                });
            }
        })
    });
});