<script type="text/javascript">

    function myFunction(id) {
        var div = document.getElementById('show-course-js');
        courseHtml= '';
        div.innerHTML="";
        document.getElementById('loading_gif').style.display = "block";
        $.ajax({
            url: "/ajax-course-request/"+id,
            type:"GET",
            success:function(response){
            if(response) {
                document.getElementById('loading_gif').style.display = "none";
                if(!$.trim(response)){
                    courseHtml += '<h5 class="text-xxsm fw-600 text-purple mt-2">Course will publish soon, Try another category</h5>';
                    div.innerHTML += courseHtml;
                } else {
                            
                        $.map(response, function(val, key) {
                            courseHtml += '<div class="col-md-4 col-lg-3 mb-3"><div class="single-exam mx-auto p-4 mb-4 mb-md-0" style="background-image: url(https://edventurebd.com/'+val.banner+');">';
                            courseHtml += '<img src="https://edventurebd.com/'+val.icon+'" width="50" alt="">';
                            courseHtml += '<h5 class="text-sm mt-2">'+val.title+'</h5>';
                            courseHtml += '<p class="text-md mt-2 fw-600 text-price">'+val.price+'৳</p>';
                            courseHtml += '<a href="/course/course-preview/'+val.slug+'" class="btn btn-outline text-purple mt-2">Go To Exam</a></div></div>';
                            });
                    
                        div.innerHTML += courseHtml;
                        var removestyle = document.querySelectorAll(".course-category-single-js");
                            [].forEach.call(removestyle, function(el) {
                                el.classList.remove("text-white");
                                el.classList.remove("bg-purple");
                                el.classList.add("bg-white");
                                el.classList.add("text-purple");
                            });           
                            
                            var addstyle = document.querySelectorAll("#"+id);
                            [].forEach.call(addstyle, function(el) {                   
                                el.classList.remove("bg-white");
                                el.classList.remove("text-purple");
                                el.classList.add("text-white");
                                el.classList.add("bg-purple");
                            });
                }
            }
            },
            error: function(error) {
            document.getElementById('loading_gif').style.display = "none";
            courseHtml += '<h5 class="text-xxsm fw-600 mt-2">Try again</h5>';
            div.innerHTML += courseHtml;
            }
        });
    }

</script>
