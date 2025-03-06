let defaultFunctions, cart, headNav;

async function loadProducts() {
    const checkoutElement = document.querySelector('.cartCheckout');
    const cartItems = cart.getItems();

    if (cartItems === null || Object.keys(cartItems).length === 0) {
        checkoutElement.style.display = 'none';

        const emptyCartElement = document.querySelector('.emptyCartContainer');
        emptyCartElement.style.display = 'block';
        return;
    }

    checkoutElement.style.display = 'block';

    let totalProducts = 0;
    let totalPriceNum = 0.00;

    for (const itemId in cartItems) {
        const itemData = await defaultFunctions.fetchData({
            function: 'getProductFromId',
            id: itemId,
        });

        if (!itemData.success) {
            return;
        }

        const item = itemData.product;

        const price = parseFloat(item.price);
        const cartItemQuantity = cartItems[itemId] || 1;

        totalProducts += cartItemQuantity;
        totalPriceNum += price * cartItemQuantity;

        const cartItemElement = document.createElement('div');
        cartItemElement.classList.add('cartItem');
        cartItemElement.setAttribute('data-id', itemId);
        cartItemElement.innerHTML = `
                <img src="./uploads/img/${itemId}/${item.mainImage}" alt="${item.title}" loading="lazy">
                <div class="productInfo">
                    <p class="brand">${item.brand}</p>
                    <h3>${item.title}</h3>
                    <p class="price">&euro; ${price.toFixed(2).replace('.', ',')}</p>
                    <div class="actions">
                        <div class="quantity">
                            <input type="number" name="quantityInput" data-id="${itemId}" value="${cartItemQuantity}" min="1" min-length="1">
                            <select name="quantitySelect" data-id="${itemId}">
                                <option value="more">meer</option>
                            </select>
                        </div>
                        <button class="remove" onclick="removeItem(${itemId})"><i class="fa-regular fa-trash-can"></i></button>
                    </div>
                </div>
            `;

        const quantityElement = cartItemElement.querySelector('.quantity');

        const quantityInput = cartItemElement.querySelector('.quantity input');
        const quantitySelect = cartItemElement.querySelector('.quantity select');

        for (let i = 10; i >= 1; i--) {
            const option = document.createElement('option');
            option.value = i.toString();
            option.innerHTML = i.toString();
            quantitySelect.prepend(option);
        }

        if (cartItemQuantity > 10) {
            quantityInput.style.display = 'block';
            quantityInput.value = cartItemQuantity.toString();
        } else {
            quantitySelect.style.display = 'block';
            quantitySelect.value = cartItemQuantity.toString();
        }

        quantitySelect.addEventListener('change', function () {
            const value = quantitySelect.value;
            if (value === 'more') {
                quantityInput.style.display = 'block';
                quantitySelect.style.display = 'none';
                quantityInput.value = cartItemQuantity.toString();
            } else {
                cart.updateItem(itemId, value);
                updateCheckoutDiv();
            }
        });

        quantityInput.addEventListener('input', function () {
            const value = parseInt(quantityInput.value);
            cart.updateItem(itemId, value);
            updateCheckoutDiv();
        });

        quantityInput.addEventListener('blur', function () {
            const value = parseInt(quantityInput.value) || 0;
            if (value < 1) {
                cart.updateItem(itemId, 1);
                quantityInput.value = '1';
                updateCheckoutDiv();
            }
        });

        quantityElement.appendChild(quantitySelect);
        document.querySelector('.cartItems').appendChild(cartItemElement);
    }
    const totalProductsElement = document.querySelector('.totalProducts');
    totalProductsElement.innerHTML = totalProducts.toString();

    const displayPrice = totalPriceNum.toFixed(2).replace('.', ',');
    const totalProductsPrices = document.querySelector('.totalProductsPrices');
    const totalPriceElement = document.querySelector('.totalPriceSpan');

    totalProductsPrices.innerHTML = displayPrice;
    totalPriceElement.innerHTML = displayPrice;
}

async function updateCheckoutDiv() {
    const cartItems = cart.getItems();
    const checkoutElement = document.querySelector('.cartCheckout');

    if (cartItems === null || Object.keys(cartItems).length === 0) {
        checkoutElement.style.display = 'none';

        const emptyCartElement = document.querySelector('.emptyCartContainer');
        emptyCartElement.style.display = 'block';
        return;
    } else {
        checkoutElement.style.display = 'block';
    }

    let totalPriceNum = 0.00;
    let totalProducts = 0;

    for (const itemId in cartItems) {
        const itemData = await defaultFunctions.fetchData({
            function: 'getProductFromId',
            id: itemId,
        });

        if (itemData.success) {
            const item = itemData.product;

            const price = parseFloat(item.price);
            const cartItemQuantity = cartItems[itemId];

            totalProducts += cartItemQuantity;
            totalPriceNum += price * cartItemQuantity;
        }
    }

    const totalProductsElement = document.querySelector('.totalProducts');
    totalProductsElement.innerHTML = totalProducts.toString();

    const displayPrice = totalPriceNum.toFixed(2).replace('.', ',');
    const totalProductsPrices = document.querySelector('.totalProductsPrices');
    const totalPriceElement = document.querySelector('.totalPriceSpan');

    totalProductsPrices.innerHTML = displayPrice;
    totalPriceElement.innerHTML = displayPrice;
}

function removeItem(itemId) {
    cart.removeItem(itemId);
    const cartItemElement = document.querySelector(`.cartItem[data-id="${itemId}"]`);
    cartItemElement.remove();

    updateCheckoutDiv();
}

document.addEventListener('DOMContentLoaded', async function () {
    defaultFunctions = await import(`./defaultFunctions.js?t=${new Date().getTime()}`);
    cart = await import(`./modules/cart.js?t=${new Date().getTime()}`);
    headNav = await import(`./modules/headNav.js?t=${new Date().getTime()}`);

    loadProducts();
});