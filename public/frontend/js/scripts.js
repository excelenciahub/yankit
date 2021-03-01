function readURL(input, target) {
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e) {
            $(target).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
(function($) {
    //Hide Loading Box (Preloader)
    function handlePreloader() {
        if($('.preloader').length){
            $('.preloader').delay(1100).fadeOut(300);
        }
    }
    $(window).on('load', function() {
        handlePreloader();
    });
})(window.jQuery);
/*Preloading Animation*/
$(window).load(function() {
    $('.preloader').delay(300).addClass('cloak');
});
$(document).ready(function(){
    $(document).delegate('.social_link', 'click', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $('#social_form').attr('action', url);
        $('#social_dialog_link').trigger('click');
    });
    $(document).delegate('.submit_ajaxform', 'click', function(e){
        e.preventDefault();
        $(this).closest('.ajaxform').submit();
    });
    $(document).delegate('.custom_address', 'click', function(e){
        console.log($(this).is(":checked"));
        if($(this).is(":checked")){
            $(this).closest('.custom_address_box').find('.custom_address_input').show();
        }
        else{
            $(this).closest('.custom_address_box').find('.custom_address_input').hide();
        }
    })
    $(document).delegate('.ajaxform', 'submit', function(e){
        $('#preloader').show();
        e.preventDefault();
        var form = $(this);
        var action = form.attr('action');
        var method = form.attr('method');
        var formData = new FormData(this);
        $.ajax({
            type: method,
            url: action,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#preloader').hide();
                Swal.fire("Success!", data.message, "success").then(function (d) {
                    if(typeof data.redirect != 'undefined'){
                        window.location.href = data.redirect;
                    }
                    else{
                        window.location.reload();
                    }
                });
            },
            error: function(reject) {
                $('#preloader').hide();
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
                else if (reject.status === 401) {
                    message = 'Please sign in to continue';
                }
                Swal.fire("Oops...", message, 'error').then(function (d) {
                    var redirect = $.parseJSON(reject.responseText).redirect;
                    if(typeof redirect != 'undefined'){
                        window.location.href = redirect;
                    }
                });
            }
        });
    });
    // $(document).delegate('#home-tab, #profile-tab', 'click', function(){
    //     $('#user_type').val($(this).closest('.nav-tabs').find('.nav-link.active').data('type'))
    // });
    $(".preview_image").change(function(){
        readURL(this, '#'+$(this).attr('id')+'_preview');
    });
    $('.select2').select2();
    $(document).delegate('.btn-order-next', 'click', function(){
        $(this).closest('form').find('.order_box').addClass('hide');
        $(this).closest('.order_box').next('.order_box').removeClass('hide');
    });
    $(document).delegate('.btn-order-back', 'click', function(){
        $(this).closest('form').find('.order_box').addClass('hide');
        $(this).closest('.order_box').prev('.order_box').removeClass('hide');
    });
    var package_items = 1;
    $(document).delegate('.btn-add-item', 'click', function(){
        package_items++;
        $('#package_detail .items:first').clone()
        .find('.package_radio').attr('name', 'items['+package_items+'][weight]').end()
        .insertAfter('#package_detail .items:last');
        $('#package_detail .items:last .description').attr('name', 'items['+package_items+'][description]').val('');
        $('#package_detail .items:last .weight_div').each(function(key, val){
            $(this).find('.package_radio').attr('id', 'package_'+package_items+'_'+key).prop('checked', false);
            $(this).find('.package_radio_label').attr('for', 'package_'+package_items+'_'+key);
        });
    });
    $(document).delegate('.delete', 'click', function(e){
        e.preventDefault();
        var obj = $(this);
        Swal.fire({
            title:"Are you sure?",
            text:"You won't be able to revert this!",
            type:"warning",
            showCancelButton:!0,
            confirmButtonColor:"#3085d6",
            cancelButtonColor:"#d33",
            confirmButtonText:"Yes, delete it!"
        }).then(function(data){
            if(data.value){
                $('.preloader').show();
                $.ajax({
                    url: $(obj).attr('href'),
                    type: 'DELETE',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (data) {
                        $('.preloader').hide();
                        Swal.fire("Deleted!",data.message,"success").then(function(data){
                            window.location.reload();
                        });
                    },
                    error: function(reject) {
                        $('.preloader').hide();
                        Swal.fire("Oops...","Something went wrong.","error");
                    }
                });
            }
        });
    });
});
