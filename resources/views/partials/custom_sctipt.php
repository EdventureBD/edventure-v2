<script type="text/javascript">
    var loadedCategory={};
    function myFunction(id) {
     
        var div = document.getElementById('show-course-js');
        courseHtml= '';
        div.innerHTML="";
        document.getElementById('loading_gif').style.display = "block";
        document.getElementById('stop-click').style.display = "block";
        if(id in loadedCategory ){
            document.getElementById('loading_gif').style.display = "none";
            document.getElementById('stop-click').style.display = "none";
            courseHtml=divPresention(loadedCategory[id]);
            div.innerHTML += courseHtml;
            removeAddSelector(id); 
        } else{
            $.ajax({
            url: "/ajax-course-request/"+id,
            type:"GET",
            success:function(response){
            if(response) {
                loadedCategory[id]=response;
                document.getElementById('loading_gif').style.display = "none";
                document.getElementById('stop-click').style.display = "none";
                if(!$.trim(response)){
                    courseHtml += '<h5 class="text-xxsm fw-600 text-purple mt-2">Course will publish soon, Try another category</h5>';
                    div.innerHTML += courseHtml;
                     removeAddSelector(id);
                } else {
                        courseHtml=divPresention(response);
                        div.innerHTML += courseHtml;
                        removeAddSelector(id); 
                }
            }
            },
            error: function(error) {
                document.getElementById('loading_gif').style.display = "none";
                removeAddSelector(id);
                courseHtml += '<h5 class="text-xxsm fw-600 mt-2">Try again</h5>';
                div.innerHTML += courseHtml;
            }
        });
        }
        
    }

    function removeAddSelector(id){
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

    function divPresention(response){
        html="";
        if(!$.trim(response)){
                    courseHtml += '<h5 class="text-xxsm fw-600 text-purple mt-2">Course will publish soon, Try another category</h5>';
        } else{
            $.map(response, function(val, key) {
                html += '<div class="col-md-4 col-lg-3 mb-3"><div class="single-exam mx-auto p-4 mb-4 mb-md-0" style="background-image: url(https://edventurebd.com/'+val.banner+');">';
                html += '<img src="https://edventurebd.com/'+val.icon+'" width="50" alt="">';
                html += '<h5 class="text-sm mt-2">'+val.title+'</h5>';
                html += '<p class="text-md mt-2 fw-600 text-price">'+val.price+'৳</p>';
                html += '<a href="/course/course-preview/'+val.slug+'" class="btn btn-outline text-purple mt-2">Go To Exam</a></div></div>';
                });
        }
        return html;
    }

</script>
