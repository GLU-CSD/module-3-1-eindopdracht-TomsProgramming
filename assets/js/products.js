let defaultFunctions, cart, headNav, sidebar, loadProducts;

document.addEventListener('DOMContentLoaded', async function () {
    defaultFunctions = await import(`./defaultFunctions.js?t=${new Date().getTime()}`);
    cart = await import(`./modules/cart.js?t=${new Date().getTime()}`);
    headNav = await import(`./modules/headNav.js?t=${new Date().getTime()}`);
    sidebar = await import(`./modules/sidebar.js?t=${new Date().getTime()}`);
    loadProducts = await import(`./modules/loadProducts.js?t=${new Date().getTime()}`);

    const productsContainer = document.querySelector('.productsContainer');
    const products = await loadProducts.get();
    await loadProducts.load(productsContainer, products);
});