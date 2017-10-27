$(function(){
    $('.date-picker').fdatepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        disableDblClickSelection: true,
        leftArrow:'<i class="fi-arrow-left"></i>',
        rightArrow:'<i class="fi-arrow-right"></i>'
    });

    $('.show-elm').change(function() {
        let target = $(this).data('target');
        if ($(this).is(":checked")) {
            $(target).removeClass('hide');
        } else {
            $(target).addClass('hide');
        }
    });

    $('.disable-elm').change(function() {
        let target = $(this).data('target');
        if ($(this).is(":checked")) {
            $(target).attr('disabled', true);
        } else {
            $(target).removeAttr('disabled');
        }
    });

    // document.getElementById("file").onchange = function () {
    //     var reader = new FileReader();

    //     reader.onload = function (e) {
    //         // get loaded data and render thumbnail.
    //         document.getElementById("image").src = e.target.result;
    //     };

    //     // read the image file as a data URL.
    //     reader.readAsDataURL(this.files[0]);
    // };

    //  cropper image
    var Cropper = window.Cropper;
    var URL = window.URL || window.webkitURL;
    var image = document.getElementById('image');
    var options = {
        aspectRatio: 1,
        minContainerHeight: 200,
        autoCropArea: 1,
        crop: function(e) {
            document.getElementById('image_x').value = e.detail.x;
            document.getElementById('image_y').value = e.detail.y;
            document.getElementById('image_width').value = e.detail.width;
            document.getElementById('image_height').value = e.detail.height;
            // document.getElementsByName('avatar_rotate').item(0).value = e.detail.rotate;
            // console.log(e.detail.scaleX);
            // console.log(e.detail.scaleY);
        }
    };

    var cropper = new Cropper(image, options);
    var originalImageURL = image.src;
    var uploadedImageURL;

    // Import image
    var inputImage = document.getElementById('inputImage');

    if (URL) {
        inputImage.onchange = function () {
            var files = this.files;
            var file;

            if (cropper && files && files.length) {
                file = files[0];

                if (/^image\/\w+/.test(file.type)) {
                    if (uploadedImageURL) {
                        URL.revokeObjectURL(uploadedImageURL);
                    }

                    image.src = uploadedImageURL = URL.createObjectURL(file);
                    cropper.destroy();
                    cropper = new Cropper(image, options);
                    // inputImage.value = null;
                } else {
                    window.alert('Please choose an image file.');
                }
            }
        };
    } else {
        inputImage.disabled = true;
        inputImage.parentNode.className += ' disabled';
    }
});
