//ITEM
const SideMenu1 = document.getElementById('side-menu1');
const SideMenu2 = document.getElementById('side-menu2');
const SideMenu3 = document.getElementById('side-menu3');

const SideIcon = document.getElementById('SideIcon');

const ShowSideMenu1 = document.getElementById('ShowSideMenu1');
const ShowSideMenu2 = document.getElementById('ShowSideMenu2');
const ShowSideMenu3 = document.getElementById('ShowSideMenu3');

const ShowSide = document.getElementById('ShowSide');


SideMenu1.addEventListener('click', function () {
    ShowSideMenu1.classList.toggle('active');
});
SideMenu2.addEventListener('click', function () {
    ShowSideMenu2.classList.toggle('active');
});
SideMenu3.addEventListener('click', function () {
    ShowSideMenu3.classList.toggle('active');
});
 
SideIcon.addEventListener('click', function () {
    ShowSide.classList.toggle('active');
});