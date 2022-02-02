<x-landing-layout headerBg="white">
<div class="my-5 p-5 d-flex flex-column" id="roadmapParentContainer">
   <div class="mx-auto">
      <h3 class="fw-700">Physics</h3>
   </div>
   <div class="d-flex w-25 position-relative">
     <a href="#" class="position-fixed">
      <img src="/img/road_map/back.png" alt="" class="img-fluid" id="roadmap-backButton">
     </a>
   </div>
   <div class="d-flex justify-content-center w-100 mt-5 pt-2">
      <div class="row row-cols-5 mt-5 mx-5 px-5" id="ilandsParentContainer">
         
      </div>
   </div>
</div>
<script>
   let landsParentDiv = document.getElementById("ilandsParentContainer");
   let totalLands = 25;
   while(totalLands){
      // onStream design
      for(let i = 0; i  <5; i++){
         for(let j = 0; j < 5; j++){
            if(i===j){
               if(j%2==0){
                  let div = document.createElement("div");
                  div.innerText  = "iland";
                  div.classList.add("border","border-primary","p-5");
                  landsParentDiv.appendChild(div);
                  totalLands--;
               }
               else{
                  let div = document.createElement("div");
                  div.innerText  = "arrow";
                  div.classList.add("border","border-primary","p-5");
                  landsParentDiv.appendChild(div);
               }
            }
            else{
               let div = document.createElement("div");
               div.innerText  = "0";
               div.classList.add("invisible");
               landsParentDiv.appendChild(div);
            }
            if(!totalLands){
               break;
            }
         }
         if(!totalLands){
            break;
         }
      }
      // onStream design ends 
      
      // reverseStream design starts
      for(let i = 0; i < 5; i++){
         for(let j = 0; j < 5; j++){
            if((i+j)===(5-1)){
               let div = document.createElement("div");
               if((i===4) || (i===0)){
                  div.classList.add("invisible","border","border-primary","p-5");
                  div.innerText  = "0";
                  landsParentDiv.appendChild(div);
               }
               else{
                  if(i===j){
                     div.classList.add("border","border-primary","p-5");
                     div.innerText  = "lands";
                     landsParentDiv.appendChild(div);
                     totalLands--;
                  }
                  else{
                     div.classList.add("border","border-primary","p-5");
                     div.innerText  = "arrow";
                     landsParentDiv.appendChild(div);
                  }
               }
            }
            else{
               let div = document.createElement("div");
               div.innerText  = "0";
               div.classList.add("invisible");
               landsParentDiv.appendChild(div);
            }
            if(!totalLands){
               break;
            }
         }
         if(!totalLands){
            break;
         }
      }
      // reverseStream design ends 
   }
</script>
</x-landing-layout>
