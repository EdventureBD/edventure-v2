<x-landing-layout headerBg="white">
<div class="my-5 p-5 d-flex flex-column" id="roadmapParentContainer">
   <div class="mx-auto">
      <h3 class="fw-700">Physics</h3>
   </div>
   <div class="d-flex w-25">
     <a href="#">
      <img src="/img/road_map/back.png" alt="" class="img-fluid" id="roadmap-backButton">
     </a>
   </div>
   <div class="d-flex justify-content-center w-100">
      <div class="row row-cols-5 mt-5 mx-5 px-5" id="ilandsParentContainer">
         
      </div>
   </div>
</div>
<script>
   let landsParentDiv = document.getElementById("ilandsParentContainer");
   // onStream design
   for(let i = 0; i  <5; i++){
      for(let j = 0; j < 5; j++){
         if(i===j){
            let div = document.createElement("div");
            div.innerText  = "h1";
            if(j===4){
               div.classList.add("invisible");
               landsParentDiv.appendChild(div);
            }
            else{
               landsParentDiv.appendChild(div);
            }
         }
         else{
            let div = document.createElement("div");
            div.innerText  = "0";
            div.classList.add("invisible");
            landsParentDiv.appendChild(div);
         }
      }
   }
   // onStream design ends 
   // reverseStream design starts
   for(let i = 0; i < 5; i++){
      for(let j = 0; j < 5; j++){
         if((i+j)===(5-1)){
            let div = document.createElement("div");
            div.innerText  = "h1";
            if(i===4){
               div.classList.add("invisible");
               landsParentDiv.appendChild(div);
            }
            else{
               landsParentDiv.appendChild(div);
            }
         }
         else{
            let div = document.createElement("div");
            div.innerText  = "0";
            div.classList.add("invisible");
            landsParentDiv.appendChild(div);
         }
      }
   }
   // reverseStream design ends 
   for(let i = 0; i  <5; i++){
      for(let j = 0; j < 5; j++){
         if(i===j){
            let div = document.createElement("div");
            div.innerText  = "h1";
            landsParentDiv.appendChild(div);
         }
         else{
            let div = document.createElement("div");
            div.innerText  = "0";
            div.classList.add("invisible");
            landsParentDiv.appendChild(div);
         }
      }
   }
</script>
</x-landing-layout>
