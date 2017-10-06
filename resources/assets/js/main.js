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

    document.getElementById("file").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("image").src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
});
