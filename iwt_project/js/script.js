function noPreview() {
    $('#image-preview-div').css("display", "none");
    $('#preview-img').attr('src', 'noimage');
    $('upload-button').attr('disabled', '');
}

function selectImage(e) {
    $('#file').css("color", "green");
    $('#image-preview-div').css("display", "block");
    $('#preview-img').attr('src', e.target.result);
    $('#preview-img').css('max-width', '550px');
}

$(document).ready(function (e) {

    var maxsize = 500 * 1024; // 500 KB

    $('#max-size').html((maxsize/1024).toFixed(2));

    $('#upload-image-form').on('submit', function(e) {

        e.preventDefault();

        $('#message').empty();
        $('#loading').show();

        $.ajax({
            url: "add-item.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data)
            {
                $('#upload-image-form').find("input[type=text], input").val("");
                $('#image-preview-div').css("display", "none");
                $('#loading').hide();
                $('#message').append('<div class="container">\n' +
            '<div class="row">\n' +
             '   <div class="alert alert-success" role="alert">\n' +
              '  Item created successfully.\n' +
              '  </div>\n' +
               '</div>\n' +
                '</div>');
            }
        });

    });

    $('#file').change(function() {

        $('#message').empty();

        var file = this.files[0];
        var match = ["image/jpeg", "image/png", "image/jpg"];

        if ( !( (file.type == match[0]) || (file.type == match[1]) || (file.type == match[2]) ) )
        {
            noPreview();

            $('#message').html('<div class="alert alert-warning" role="alert">Unvalid image format. Allowed formats: JPG, JPEG, PNG.</div>');

            return false;
        }

        if ( file.size > maxsize )
        {
            noPreview();

            $('#message').html('<div class=\"alert alert-danger\" role=\"alert\">The size of image you are attempting to upload is ' + (file.size/1024).toFixed(2) + ' KB, maximum size allowed is ' + (maxsize/1024).toFixed(2) + ' KB</div>');

            return false;
        }

        $('#upload-button').removeAttr("disabled");

        var reader = new FileReader();
        reader.onload = selectImage;
        reader.readAsDataURL(this.files[0]);

    });


    $(".item").click(function(){
        var del_id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: 'delete-item.php',
            data: 'delete_id=' + del_id,
            success: function (data) {
                if (data) {
                    $('#item-'+del_id).remove();
                }
            }
        });
    });

    $(".item-edit").click(function () {
        var edit_id = $(this).attr('id');
        window.location.href = "/iwt_project/item-edit.php?item_id="+edit_id;
    });
    $(".submit-search").click(function () {
        var search_value = $('.search').val();
        window.location.href = "/iwt_project/search.php?search_value="+search_value;
    });
});