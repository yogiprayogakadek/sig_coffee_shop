$(document).ready(function () {
    // on submit form
    $('body').on('click', '.btn-register', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formRegister')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/traveler/register",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-register').attr('disable', 'disabled')
                $('.btn-register').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-register').removeAttr('disable')
                $('.btn-register').html('Sign Up')
            },
            success: function (response) {
                // alert('sukses')
                toastr[response.status](response.message, response.title);
                // console.log(response.message)
                setTimeout(function(){
                    window.location.href = '/login'
                }, 1500);
            },
            error: function (error) {
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.name) {
                            $('#name').addClass('is-invalid')
                            $('#name').trigger('focus')
                            $('.error-name').html(error.responseJSON.errors.name)
                        } else {
                            $('#name').removeClass('is-invalid')
                            $('.error-name').html('')
                        }
                        if (error.responseJSON.errors.place_of_birth) {
                            $('#placeOfBirth').addClass('is-invalid')
                            $('#placeOfBirth').trigger('focus')
                            $('.error-place-of-birth').html(error.responseJSON.errors.place_of_birth)
                        } else {
                            $('#placeOfBirth').removeClass('is-invalid')
                            $('.error-place-of-birth').html('')
                        }
                        if (error.responseJSON.errors.date_of_birth) {
                            $('#dateOfBirth').addClass('is-invalid')
                            $('#dateOfBirth').trigger('focus')
                            $('.error-date-of-birth').html(error.responseJSON.errors.date_of_birth)
                        } else {
                            $('#dateOfBirth').removeClass('is-invalid')
                            $('.error-date-of-birth').html('')
                        }
                        if (error.responseJSON.errors.phone) {
                            $('#phone').addClass('is-invalid')
                            $('#phone').trigger('focus')
                            $('.error-phone').html(error.responseJSON.errors.phone)
                        } else {
                            $('#phone').removeClass('is-invalid')
                            $('.error-phone').html('')
                        }
                        if (error.responseJSON.errors.address) {
                            $('#address').addClass('is-invalid')
                            $('#address').trigger('focus')
                            $('.error-address').html(error.responseJSON.errors.address)
                        } else {
                            $('#address').removeClass('is-invalid')
                            $('.error-address').html('')
                        }
                        if (error.responseJSON.errors.email) {
                            $('#email').addClass('is-invalid')
                            $('#email').trigger('focus')
                            $('.error-email').html(error.responseJSON.errors.email)
                        } else {
                            $('#email').removeClass('is-invalid')
                            $('.error-email').html('')
                        }
                        if (error.responseJSON.errors.password) {
                            $('#password').addClass('is-invalid')
                            $('#password').trigger('focus')
                            $('.error-password').html(error.responseJSON.errors.password)
                        } else {
                            $('#password').removeClass('is-invalid')
                            $('.error-password').html('')
                        }
                        if (error.responseJSON.errors.password_confirmation) {
                            $('#passwordConfirmation').addClass('is-invalid')
                            $('#passwordConfirmation').trigger('focus')
                            $('.error-password-confirmation').html(error.responseJSON.errors.password_confirmation)
                        } else {
                            $('#passwordConfirmation').removeClass('is-invalid')
                            $('.error-password-confirmation').html('')
                        }
                        if (error.responseJSON.errors.image) {
                            $('#image').addClass('is-invalid')
                            $('#image').trigger('focus')
                            $('.error-image').html(error.responseJSON.errors.image)
                        } else {
                            $('#image').removeClass('is-invalid')
                            $('.error-image').html('')
                        }
                    }
                }
            }
        });
    });
});