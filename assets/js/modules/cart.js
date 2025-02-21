export function addItem(itemId)
{
    const currentCart = JSON.parse(localStorage.getItem('cart')) || {};

    if(currentCart[itemId] === undefined){
        currentCart[itemId] = 1;
    }else{
        currentCart[itemId]++;
    }

    localStorage.setItem('cart', JSON.stringify(currentCart));
}

export function removeItem(itemId)
{   
    const currentCart = JSON.parse(localStorage.getItem('cart')) || {};
    if(currentCart[itemId.toString()] !== undefined){
        delete currentCart[itemId.toString()];
        localStorage.setItem('cart', JSON.stringify(currentCart));
    }
}

export function updateItem(itemId, quantity)
{
    const currentCart = JSON.parse(localStorage.getItem('cart')) || {};
    if(currentCart[itemId.toString()] !== undefined){
        currentCart[itemId.toString()] = parseInt(quantity);
        localStorage.setItem('cart', JSON.stringify(currentCart));
    }
}

export function getItems()
{
    return JSON.parse(localStorage.getItem('cart')) || {};
}
