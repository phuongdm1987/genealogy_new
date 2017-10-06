$(function(){
    $('.date-picker').fdatepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        disableDblClickSelection: true,
        leftArrow:'<i class="fi-arrow-left"></i>',
        rightArrow:'<i class="fi-arrow-right"></i>'
    });

    $('.show-elm').change(function() {
        if ($(this).is(":checked")) {
            $(".show-by").removeClass('hide');
        } else {
            $(".show-by").addClass('hide');
        }
    });
});
