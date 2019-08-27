<script>
jQuery(function() {
    tinymce.init({
        selector: 'textarea.tinymce-enabled',
        height: 500,
        menubar: "table view edit",
        plugins: [
            'advlist autolink lists link image imagetools charmap print preview anchor textcolor media',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'formatselect | bold italic strikethrough removeformat | alignleft aligncenter alignright | bullist numlist outdent indent | link image media',
        image_title: true,
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
            };

            input.click();
        }
    });
});
</script>