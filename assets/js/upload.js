$(document).ready(function () {
    let imageFile = $('#album_imageFile')
    $(imageFile).on('input', function() {
        let imageFile = $('#album_imageFile').val().split('\\').pop()
        $('#album_imageFile').next().text(imageFile)
    });
});

$('#album_imageFile').change(function (e) {
    let f = e.target.files[0];
    let reader = new FileReader();
    reader.onload = (function (file) {
        return function (e) {
            let img = $('#album-image');
            img.attr('src', reader.result);
        }
    })(f);
    reader.readAsDataURL(f);
});