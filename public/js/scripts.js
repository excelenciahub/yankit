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
    $(".preview_image").change(function(){
        readURL(this, '#'+$(this).attr('id')+'_preview');
    });
    $('.select2').select2();
    $('.pickup_date').datetimepicker({
        format:'Y-m-d',
        formatDate:'Y-m-d',
        timepicker:false,
        minDate:'now',
        scrollInput:false,
        allowBlank:true,
    });
    $('.start_time').timepicker();
    $('.end_time').timepicker();
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
