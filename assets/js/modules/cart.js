const addedToCardElement = document.querySelector('.addedToCard') || null;
const addedToCardOverlay = document.querySelector('.addedToCardOverlay') || null;

export function updateCartIconInNav()
{
    const cartQuantity = document.querySelector('.cartQuantity');
    const cartItems = getItems();
    const carItemsLength = Object.keys(cartItems).length;

    if(carItemsLength > 0) {
        let totalProducts = 0;

        for (const key in cartItems) {
            totalProducts += cartItems[key];
        }

        cartQuantity.innerHTML = totalProducts.toString();
        cartQuantity.style.display = 'block';
    }else{
        cartQuantity.style.display = 'none';
    }
}

export function addItem(itemId)
{
    const currentCart = JSON.parse(localStorage.getItem('cart')) || {};

    if(currentCart[itemId] === undefined){
        currentCart[itemId] = 1;
    }else{
        currentCart[itemId]++;
    }

    localStorage.setItem('cart', JSON.stringify(currentCart));

    if(addedToCardElement !== null && addedToCardOverlay !== null){
        addedToCardElement.classList.add('active');
        addedToCardOverlay.style.display = 'block';
    }

    updateCartIconInNav();
}

export function removeItem(itemId)
{   
    const currentCart = JSON.parse(localStorage.getItem('cart')) || {};
    if(currentCart[itemId.toString()] !== undefined){
        delete currentCart[itemId.toString()];
        localStorage.setItem('cart', JSON.stringify(currentCart));
        updateCartIconInNav();
    }
}

export function updateItem(itemId, quantity)
{
    const currentCart = JSON.parse(localStorage.getItem('cart')) || {};
    if(currentCart[itemId.toString()] !== undefined){
        currentCart[itemId.toString()] = parseInt(quantity);
        localStorage.setItem('cart', JSON.stringify(currentCart));
        updateCartIconInNav();
    }
}

export function getItems()
{
    return JSON.parse(localStorage.getItem('cart')) || {};
}


function closeAddedToCard(){
    addedToCardElement.classList.remove('active');
    addedToCardOverlay.style.display = 'none';
}

const addToCartCloseBtns = document.querySelectorAll('.addedToCard .close');

addToCartCloseBtns.forEach(btn => {
    btn.addEventListener('click', closeAddedToCard);
});

const addToCartOverlay = document.querySelectorAll('.addedToCardOverlay');
if(addedToCardOverlay !== null){
    addedToCardOverlay.addEventListener('click', closeAddedToCard);
}