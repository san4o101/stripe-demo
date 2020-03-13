require('./bootstrap');
import $ from 'jquery';

const csrf_token = $('meta[name="csrf-token"]').attr('content');

$('.donate-btn').on('click', function () {
    let form = $('.donate_form');
    $.ajax({
        url: form.data('action'),
        method: form.data('method'),
        data: form.serialize(),
        success: function(result, status){
            $('#donateModal').modal('toggle');
            $('.infoAlert').removeClass('d-none').addClass('alert-success').text(status);
        },
        error: function(xhr, status, error) {
            $('.infoAlert').removeClass('d-none').addClass('alert-danger').text(error);
        }
    });
});

