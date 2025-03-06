const obServer = new IntersectionObserver((entries) => {
    for (const entry of entries) {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
    }
});

export async function createProductElement(product) {
    const productElement = document.createElement('div');
    productElement.classList.add('product');
    productElement.innerHTML = `
        <img src="./uploads/img/${product.id}/${product.mainImage}" alt="${product.title}" loading="lazy">
        <div class="productInfo">
            <p class="brand">${product.brand}</p>
            <h3>${product.title}</h3>
            <p class="price">&euro; ${product.price.replace('.', ',')}</p>
            <a href="/${product.category}/${product.brand}/${product.name}" class="product-button">Bekijken</a>
        </div>
    `;
    obServer.observe(productElement);

    return productElement;
}

export async function get(limit = null) {
    const pathSegments = window.location.pathname.split('/').filter(Boolean);

    const category = pathSegments[0] || null;
    const brand = pathSegments[1] || null;

    const data = await defaultFunctions.fetchData({
        function: 'getProducts',
        category,
        brand,
        limit,
    });

    if (data.success) {
        return data.products;
    } else {
        return [];
    }
}

export async function load(productContainer, products) {
    for (const product of products) {
        const productElement = await createProductElement(product);
        if(productContainer) {
            productContainer.appendChild(productElement);
        }
    }
}

export async function addAnitmationToProducts(products) {
    products.forEach(product => {
        obServer.observe(product);
    });
}