let addbutton = document.getElementById("addbutton");
let formClone = document.getElementById("form-clone");

addbutton.addEventListener("click", function(){
  let clone = formClone.firstElementChild.cloneNode(true);
  formClone.appendChild(clone);
});