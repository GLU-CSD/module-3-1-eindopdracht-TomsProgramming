let defaultFunctions, headNav, cart, loadProducts;

document.addEventListener('DOMContentLoaded', async function(){
    defaultFunctions = await import(`./defaultFunctions.js?t=${new Date().getTime()}`);
    headNav = await import(`./modules/headNav.js?t=${new Date().getTime()}`);
    cart = await import(`./modules/cart.js?t=${new Date().getTime()}`);
    loadProducts = await import(`./modules/loadProducts.js?t=${new Date().getTime()}`);

    
    const data = await defaultFunctions.fetchData({
        function: 'get5ProductsFromAllCategory',
    });

    if(data.success){
        const productsContainer = document.querySelector('.productsContainer');
        const categories = data.data;

        for(const categoryName in categories){
            const categoryData = categories[categoryName];
            
            const categoryContainer = document.createElement('div');
            categoryContainer.classList.add('category');
            categoryContainer.innerHTML = `
                <h2>${categoryData.title}</h2
            `;

            loadProducts.load(categoryContainer, categoryData.products);
            productsContainer.appendChild(categoryContainer);
        }
    }
});

