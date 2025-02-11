let allModulesLoaded = false;
let dropdown = null;

async function loadModules(){
    if(allModulesLoaded) return;
    dropdown = await import(`./modules/dropdown.js?t=${new Date().getTime()}`);
    allModulesLoaded = true;
}

loadModules();

