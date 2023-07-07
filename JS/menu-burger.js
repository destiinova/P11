console.log('test')

//MENU BURGER// 
const button = document.querySelector('.buttonmenu');
const nav = document.querySelector('.navnewmenu');
const backdrop = document.querySelector('.backdrop');
const remove = document.querySelector('#container');
const remove2 = document.querySelector('footer');
const menuburger = document.querySelector('.menuburger');
button.addEventListener('click', () => {
  menuburger.classList.toggle('openburger');
  nav.classList.toggle('open');
  remove.classList.toggle('remove');
  remove2.classList.toggle('remove');

});

backdrop.addEventListener('click', () => {
  nav.classList.remove('open');
  remove.classList.remove('remove');
  remove2.classList.remove('remove');
  remove3.classList.remove('remove');
});

// button burger 
const burger= document.querySelector('.buttonmenu'); 
burger.addEventListener('click', ()=> {
  burger.classList.toggle('activee');
});



























