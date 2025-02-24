const aside = document.querySelector('.aside');
const rightAside = document.querySelector('.account-menu');


document.querySelector('.burger').addEventListener('click', function(){
    this.classList.toggle('active');
    aside.classList.toggle('mobile');
});

document.querySelector('.burger-right').addEventListener('click', function(){
    this.classList.toggle('active');
    rightAside.classList.toggle('mobile');
})