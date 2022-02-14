@section('js2')
    <script>
        $(function () {
            $('.select2').select2()
        })
    </script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
