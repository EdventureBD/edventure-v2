@section('js2')
    <script>
        $(function () {
            $('.select2').select2()
            $('#negative_marking_value').attr('disabled', true);
        })
        let query_category_id = null;


        function visibilityUpdate(examId) {
            url = window.location.origin +'/admin/model-exam/visibility/'+examId;
            $.ajax({
                url: url,
                type:"GET",
                success:function(response){
                    if(response == 'visible') {
                        alert('Exam is now Visible')
                    } else {
                        alert('Exam is now Invisible')
                    }

                },
            });
        }

        $("#question_limit").on('change keyup', function() {
            $("#per_question_marks").val(1)
            $("#total_exam_marks").val($("#per_question_marks").val() * $("#question_limit").val())
        });

        $("#checkBoxValue").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', '1');
            } else {
                $(this).attr('value', '0');
            }
        });

        $('#solution_video').on('paste change keyup', function () {
            let code = $('#solution_video').val()
            if(code) {
                $('#iframe').removeAttr("class");
                $('#iframe_div').attr('class', 'mt-3 mb-3')
                $('#iframe').attr('src', "https://www.youtube-nocookie.com/embed/"+code)
            } else  {
                $('#iframe_div').attr('class', 'd-none')
            }
        });

        $('.negative_marking').on('click', function () {
            if ($('input[name="negative_marking"]:checked').val() == 0) {
                $('#negative_marking_value').attr('disabled', true);
                $('#negative_marking_value').val(null);
            } else {
                $('#negative_marking_value').attr('disabled', false);
            }
        });

        $('#exam_category_selected').on("select2:selecting", function (e) {
            let category_id = e.params.args.data.id
            let url = window.location.origin + '/admin/model-exam/topics/' + category_id;
            $('#exam_topics').empty();
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    let topicsObj = [];
                    for (const [key, value] of Object.entries(response)) {
                        topicsObj.push({"id": value.id, "text": value.name})
                    }
                    $('#exam_topics').select2({
                        data: topicsObj
                    });

                },
                error: function (e) {
                    console.log(e)
                }
            });
        });

        $('#query_category_selected').on("select2:selecting", function (e) {
            console.log(e)
            query_category_id = e.params.args.data.id
            let url = window.location.origin + '/admin/model-exam/topics/' + query_category_id;
            $('#query_topic_selected').empty();
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    let topicsObj = [
                        id = '',
                        text = ''
                    ];
                    for (const [key, value] of Object.entries(response)) {
                        topicsObj.push({"id": value.id, "text": value.name})
                    }
                    $('#query_topic_selected').select2({
                        data: topicsObj
                    });

                },
                error: function (e) {
                    console.log(e)
                }
            });
        });

        $('.selected_topic').on("select2:selecting", function (e) {
            let query_topic_id = e.params.args.data.id
            let url = window.location.origin + '/admin/model-exam/list/' + query_category_id + '/' + query_topic_id;
            $('#query_exam_selected').empty();
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    let examsObj = [
                        id = '',
                        text = ''
                    ];
                    for (const [key, value] of Object.entries(response)) {
                        examsObj.push({"id": value.id, "text": value.title})
                    }
                    $('#query_exam_selected').select2({
                        data: examsObj
                    });

                },
                error: function (e) {
                    console.log(e)
                }
            });
        });

    </script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
