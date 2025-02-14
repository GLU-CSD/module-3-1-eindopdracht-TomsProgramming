let allModulesLoaded = false;

let cart;

async function loadModules(){
    if(allModulesLoaded) return;
    cart = await import(`./modules/cart.js?t=${new Date().getTime()}`);
    allModulesLoaded = true;
}

loadModules();