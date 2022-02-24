@section('js2')
    <script>
        $(function () {
            $('.select2').select2()

            $('#question').summernote({
                placeholder: 'Enter Question',
                height: 200,
                maximumImageFileSize: 500*1024, // 500 KB
                callbacks:{
                    onImageUploadError: function(msg){
                        alert(msg + ' (500 KB)');
                    },
                    onImageUpload: function (files) {

                        if (!files.length) return;
                        var file = files[0];
                        // create FileReader
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var img = $("<img>").attr({src: reader.result, width: "300px"});
                            $('#question').summernote("insertNode", img[0]);
                        }
                        if (file) {
                            reader.readAsDataURL(file);
                        }

                    }
                },
            });

            $('#field_1').summernote({
                placeholder: 'Option 1',
                height: 100,
                maximumImageFileSize: 500*1024, // 500 KB
                callbacks:{
                    onImageUploadError: function(msg){
                        alert(msg + ' (500 KB)');
                    },
                    onImageUpload: function (files) {

                        if (!files.length) return;
                        var file = files[0];
                        // create FileReader
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var img = $("<img>").attr({src: reader.result, width: "300px"});
                            $('#field_1').summernote("insertNode", img[0]);
                        }
                        if (file) {
                            reader.readAsDataURL(file);
                        }

                    }
                }
            });

            $('#field_2').summernote({
                placeholder: 'Option 2',
                height: 100,
                maximumImageFileSize: 500*1024, // 500 KB
                callbacks:{
                    onImageUploadError: function(msg){
                        alert(msg + ' (500 KB)');
                    },
                    onImageUpload: function (files) {

                        if (!files.length) return;
                        var file = files[0];
                        // create FileReader
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var img = $("<img>").attr({src: reader.result, width: "300px"});
                            $('#field_2').summernote("insertNode", img[0]);
                        }
                        if (file) {
                            reader.readAsDataURL(file);
                        }

                    }
                }
            });

            $('#field_3').summernote({
                placeholder: 'Option 3',
                height: 100,
                maximumImageFileSize: 500*1024, // 500 KB
                callbacks:{
                    onImageUploadError: function(msg){
                        alert(msg + ' (500 KB)');
                    },
                    onImageUpload: function (files) {

                        if (!files.length) return;
                        var file = files[0];
                        // create FileReader
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var img = $("<img>").attr({src: reader.result, width: "300px"});
                            $('#field_3').summernote("insertNode", img[0]);
                        }
                        if (file) {
                            reader.readAsDataURL(file);
                        }

                    }
                }
            });

            $('#field_4').summernote({
                placeholder: 'Option 4',
                height: 100,
                maximumImageFileSize: 500*1024, // 500 KB
                callbacks:{
                    onImageUploadError: function(msg){
                        alert(msg + ' (500 KB)');
                    },
                    onImageUpload: function (files) {

                        if (!files.length) return;
                        var file = files[0];
                        // create FileReader
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var img = $("<img>").attr({src: reader.result, width: "300px"});
                            $('#field_4').summernote("insertNode", img[0]);
                        }
                        if (file) {
                            reader.readAsDataURL(file);
                        }

                    }
                }
            });

            $('#explanation').summernote({
                placeholder: 'Explanation',
                height: 100,
                maximumImageFileSize: 500*1024, // 500 KB
                callbacks:{
                    onImageUploadError: function(msg){
                        alert(msg + ' (500 KB)');
                    },
                    onImageUpload: function (files) {

                        if (!files.length) return;
                        var file = files[0];
                        // create FileReader
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var img = $("<img>").attr({src: reader.result, width: "300px"});
                            $('#explanation').summernote("insertNode", img[0]);
                        }
                        if (file) {
                            reader.readAsDataURL(file);
                        }

                    }
                }
            });
        })

        $('#question_form').on('submit', function(e) {

            if($('#question').summernote('isEmpty')) {
                $('#question_error').html('Question is required!')
                e.preventDefault();
            } else {
                $('#question_error').html('')
            }

            if($('#field_1').summernote('isEmpty')) {
                $('#field_1_error').html('This option is required!')
                e.preventDefault();
            } else {
                $('#field_1_error').html('')
            }

            if($('#field_2').summernote('isEmpty')) {
                $('#field_2_error').html('This option is required!')
                e.preventDefault();
            } else {
                $('#field_2_error').html('')
            }

            if($('#field_3').summernote('isEmpty')) {
                $('#field_3_error').html('This option is required!')
                e.preventDefault();
            } else {
                $('#field_3_error').html('')
            }

            if($('#field_4').summernote('isEmpty')) {
                $('#field_4_error').html('This option is required!')
                e.preventDefault();
            } else {
                $('#field_4_error').html('')
            }

            if($('#explanation').summernote('isEmpty')) {
                $('#explanation_error').html('Explanation is required!')
                e.preventDefault();
            } else {
                $('#explanation_error').html('')
            }
        })
    </script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
