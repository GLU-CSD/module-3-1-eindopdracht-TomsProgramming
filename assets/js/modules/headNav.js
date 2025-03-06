const burger = document.querySelector('.burger');
const headNav = document.querySelector('.headNav');

burger.addEventListener('click', function () {
    headNav.classList.toggle('active');
});

cart.updateCartIconInNav();