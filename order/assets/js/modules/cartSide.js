export async function load() {
    const productsTable = document.querySelector('.cart table tbody');
    const addProductElement = productsTable.querySelector('.productBefore');
    const cartItems = cart.getItems();

    if (cartItems === null || Object.keys(cartItems).length === 0) {
        window.location = '/winkelwagen';
        return;
    }

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

        const cartItemQuantity = cartItems[itemId] || 1;
        const price = parseFloat(item.price) * cartItemQuantity;

        totalProducts += cartItemQuantity;
        totalPriceNum += price;

        const productElement = document.createElement('tr');
        productElement.classList.add('product');

        productElement.innerHTML = `
            <td class="image"><img src="../uploads/img/${itemId}/${item.mainImage}" alt="${item.title}" loading="lazy"></td>
            <td class="name">${item.title}</td>
            <td class="amount">(<span>${cartItemQuantity}</span>)</td>
            <td class="price">€ <span>${price.toFixed(2).replace('.', ',')}</span></td>
        `;

        productsTable.insertBefore(productElement, addProductElement);
    }
    const displayPrice = totalPriceNum.toFixed(2).replace('.', ',');

    const totalPriceElement = document.querySelector('.cart .total .price span');
    totalPriceElement.innerHTML = displayPrice;
}