// ===========================
// Sidebar Toggle
// ===========================

const menuBtn = document.getElementById("menuBtn");
const sidebar = document.getElementById("sidebar");

if(menuBtn){

menuBtn.addEventListener("click",()=>{

sidebar.classList.toggle("show");

});

}

// ===========================
// Balance Toggle
// ===========================

const balance=document.getElementById("walletBalance");
const eye=document.getElementById("toggleBalance");

if(balance && eye){

const original=balance.innerHTML;

let hidden=false;

eye.onclick=function(){

if(hidden){

balance.innerHTML=original;

eye.innerHTML='<i class="fa-solid fa-eye"></i>';

}else{

balance.innerHTML="₦********";

eye.innerHTML='<i class="fa-solid fa-eye-slash"></i>';

}

hidden=!hidden;

};

}

// ===========================
// Greeting
// ===========================

const welcome=document.querySelector(".welcome h1");

if(welcome){

const hour=new Date().getHours();

let greet="Good Evening";

if(hour<12){

greet="Good Morning";

}else if(hour<17){

greet="Good Afternoon";

}

const name=welcome.innerHTML.split(",")[1];

welcome.innerHTML=greet+","+name;

}

// ===========================
// Close Sidebar On Mobile
// ===========================

document.addEventListener("click",function(e){

if(window.innerWidth<=992){

if(!sidebar.contains(e.target) &&

!menuBtn.contains(e.target) &&

sidebar.classList.contains("show")){

sidebar.classList.remove("show");

}

}

});
