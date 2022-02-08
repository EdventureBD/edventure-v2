@section('js2')
    <script>
        $(function () {
            $('.select2').select2()

            $('#question').summernote({
                placeholder: 'Enter Question',
                height: 100,
            });

            $('#field_1').summernote({
                placeholder: 'Option 1',
            });

            $('#field_2').summernote({
                placeholder: 'Option 2',
            });

            $('#field_3').summernote({
                placeholder: 'Option 3',
            });

            $('#field_4').summernote({
                placeholder: 'Option 4',
            });

            $('#explanation').summernote({
                placeholder: 'Explanation',
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
