<html>
<head>
    <title>Flipo</title>
</head>
<body>

<form enctype="multipart/form-data" id="profile_image_form">
<input name="file" type="file" />
<input type="button" value="Upload" />
</form>
<progress style="display:none"></progress>
<div id="result"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">

    $(':button').click(function(){
        $('progress').show();
        var formData = new FormData($('#profile_image_form')[0]);
        formData.append('login_key', '4b25225118f3c06db7edfaf082dda4f86dd3c8be');
        $.ajax({
            url: 'http://api.devblibb.com/image/upload',
            type: 'POST',
            xhr: function() {
                myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: completeHandler,
            error: errorHandler,
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
    });
    function completeHandler(e){
        $('progress').hide();
        url_img = e.upload;
        img = '<img src="' + url_img + '" alt="uploaded" width="65"/>';
        $('#result').html(img);
    }

    function errorHandler(e){
        $('progress').hide();
        $('#result').html('There was a problem uploading the file.');
    }
</script>
</body>
</html>
