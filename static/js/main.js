// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the header
var header = document.getElementById("Header");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}

var bars = document.getElementById('bars');
var times = document.getElementById('times');
var nav = document.getElementById('nav');
var logoDiv = document.querySelector('.logo');
var logo = document.getElementById('logo-text');

bars.addEventListener('click', () =>{
    bars.style.display = "none";
    times.style.display = "block";
    nav.style.display = "block";
    logoDiv.style.position = "unset";
    logo.style.marginLeft = "-20px";
});
times.addEventListener('click', () =>{
    bars.style.display = "block";
    times.style.display = "none";
    nav.style.display = "none";
    logoDiv.style.position = "absolute";
    logo.style.marginLeft = "0px";
});


// mobi res
function opennav(){
  var nav = document.querySelector('#navigation');
  nav.style.display = "block";
}

function closenav(){
  var nav = document.querySelector('#navigation');
  nav.style.display = "none";
}

//write article form
function showform(){
  var writeButton = document.querySelector('.write-button');
  var formdiv = document.querySelector('.show-write-form');
  writeButton.style.display="none";
  formdiv.style.display="block";
  }