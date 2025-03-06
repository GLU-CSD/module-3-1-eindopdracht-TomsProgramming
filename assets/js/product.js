let allModulesLoaded = false;

let cart, headNav;

async function loadModules(){
    if(allModulesLoaded) return;
    cart = await import(`./modules/cart.js?t=${new Date().getTime()}`);
    headNav = await import(`./modules/headNav.js?t=${new Date().getTime()}`);
    allModulesLoaded = true;
}

loadModules();