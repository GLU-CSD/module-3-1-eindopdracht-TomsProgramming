export function setItemInCart(itemId)
{
    const currentCart = JSON.parse(localStorage.getItem('cart')) || [];
    currentCart.push(itemId);
    localStorage.setItem('cart', JSON.stringify(currentCart));
}

export function getItemsInCart()
{
    return JSON.parse(localStorage.getItem('cart')) || [];
}

export function removeItemFromCart(itemId)
{
    const currentCart = JSON.parse(localStorage.getItem('cart')) || [];
    const newCart = currentCart.filter(id => id !== itemId);
    localStorage.setItem('cart', JSON.stringify(newCart));
}