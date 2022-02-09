let landsParentDiv = document.getElementById("ilandsParentContainer");
let totalLands = 10;
   while(totalLands){
      // onStream design
      for(let i = 0; i  <5; i++){
         for(let j = 0; j < 5; j++){
            if(i===j){
               if(j%2==0){
                  let div = document.createElement("div");
                  div.classList.add("px-lg-5","px-sm-0");
                  // Iland image part 
                  let divIland = document.createElement("div");
                  divIland.innerHTML = `<img src="img/road_map/landl1.png" alt="Iland image" class="img-fluid">`;
                  // modal part 
                  divIland.setAttribute("data-toggle","modal");
                  divIland.setAttribute("data-target", "#exampleModal");
                  div.appendChild(divIland);
                  // Iland down star's part 
                  let divstars = document.createElement("div");
                  divstars.classList.add("row","row-cols-3","w-md-75","mx-auto","w-sm-100");
                  divstars.innerHTML = `<img src="img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                  <img src="img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                  <img src="img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                  `;
                  div.appendChild(divstars);
                  landsParentDiv.appendChild(div);
                  totalLands--;
               }
               else{
                  if(j % 3 !== 0) {
                     let div = document.createElement("div");
                     div.innerHTML  = `<img src="img/road_map/onStreamStair.png" alt="Stair image" class="img-fluid onStreamStair">`;
                     div.classList.add("px-lg-5","w-lg-50","px-sm-0","w-sm-100");
                     landsParentDiv.appendChild(div);
                  }
                  else{
                     let div = document.createElement("div");
                     div.innerHTML  = `<img src="img/road_map/onStreamStair.png" alt="Stair image" class="img-fluid reverseStreamStair">`;
                     div.classList.add("px-lg-5","w-lg-50","px-sm-0","w-sm-100");
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
      // onStream design ends 
      
      // reverseStream design starts
      for(let i = 0; i < 5; i++){
         for(let j = 0; j < 5; j++){
            if((i+j)===(5-1)){
               let div = document.createElement("div");
               if((i===4) || (i===0)){
                  div.classList.add("invisible");
                  landsParentDiv.appendChild(div);
               }
               else{
                  if(i===j){
                     div.classList.add("px-lg-5","px-sm-0","mx-sm-0");
                     // Iland image part 
                     let divIland = document.createElement("div");
                     divIland.innerHTML = `<img src="img/road_map/landr4.png" alt="Iland image" class="img-fluid">`;
                     // modal part 
                     divIland.setAttribute("data-toggle","modal");
                     divIland.setAttribute("data-target", "#exampleModal");
                     div.appendChild(divIland);
                     // Iland down star's part 
                     let divstars = document.createElement("div");
                     divstars.classList.add("row","row-cols-3","w-md-75","mx-auto","w-sm-100");
                     divstars.innerHTML = `<img src="img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                     <img src="img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                     <img src="img/road_map/starFill.png" alt="Iland image" class="img-fluid">
                     `;
                     div.appendChild(divstars);
                     landsParentDiv.appendChild(div);
                     totalLands--;
                  }
                  else{
                     if(j % 3 !== 0){
                        div.innerHTML  = `<img src="img/road_map/reverseStair.png" alt="Stair image" class="img-fluid reverseStreamStair" >`;
                        div.classList.add("px-lg-5","w-lg-50","px-sm-0","w-sm-100");
                        landsParentDiv.appendChild(div);
                     }
                     else{
                        div.innerHTML  = `<img src="img/road_map/reverseStair.png" alt="Stair image" class="img-fluid onStreamStair" >`;
                        div.classList.add("px-lg-5","w-lg-50","px-sm-0","w-sm-100");
                        landsParentDiv.appendChild(div);
                     }
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