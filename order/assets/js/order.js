let defaultFunctions, cart, headNav, cartSide;

function showError(input, message) {
    const parent = input.parentElement;
    let errorSpan = parent.querySelector(".error");
    if (!errorSpan) {
        errorSpan = document.createElement("span");
        errorSpan.classList.add("error");
        parent.appendChild(errorSpan);
    }
    errorSpan.innerText = message;
    parent.classList.add("error");
    return false;
}

function clearError(input) {
    const parent = input.parentElement;
    let errorSpan = parent.querySelector("span.error");
    if (errorSpan) {
        errorSpan.remove();
    }
    parent.classList.remove("error");
}

async function checkZipcode(postalPattern) {
    const country = document.getElementById("country");
    if (country.value !== "netherlands") {
        return;
    }

    let postalCode = document.getElementById("postalCode");
    postalCode = postalCode.value.trim();

    let houseNumber = document.getElementById("houseNumber");
    houseNumber = parseInt(houseNumber.value.trim());

    let houseNumberSuffix = document.getElementById("houseNumberSuffix");
    houseNumberSuffix = houseNumberSuffix.value.trim();

    if (postalPattern.test(postalCode) && !isNaN(houseNumber)) {
        let houseNumberString = houseNumber.toString();

        if (houseNumberSuffix) {
            houseNumberString += '-' + houseNumberSuffix;
        }

        let zipCodeData = await defaultFunctions.fetchData({
            function: 'getZipcodeData',
            zipcode: postalCode,
            number: houseNumberString
        }, '/order/assets/php/functions.php');

        if (zipCodeData.success === true && zipCodeData.data.error === undefined) {
            document.getElementById("street").value = zipCodeData.data.street;
            document.getElementById("city").value = zipCodeData.data.city;
        }
    }
}

document.addEventListener('DOMContentLoaded', async function () {
    defaultFunctions = await import(`../../../assets/js/defaultFunctions.js?t=${new Date().getTime()}`);
    cart = await import(`../../../assets/js/modules/cart.js?t=${new Date().getTime()}`);
    headNav = await import(`../../../assets/js/modules/headNav.js?t=${new Date().getTime()}`);
    cartSide = await import(`./modules/cartSide.js?t=${new Date().getTime()}`);

    cartSide.load();

    document.querySelector("#firstName").addEventListener("input", function () {
        if (!this.value.trim()) {
            showError(this, "Voornaam is verplicht");
            return;
        }

        clearError(this);
    });

    document.querySelector("#lastName").addEventListener("input", function () {
        if (!this.value.trim()) {
            showError(this, "Achternaam is verplicht");
            return;
        }
    });

    const postalCodePattern = /^[1-9][0-9]{3}[A-Z]{2}$/i;

    document.querySelector("#country").addEventListener("change", async function () {
        if (this.value === "netherlands") {
            document.querySelector("#street").setAttribute("disabled", "");
            document.querySelector("#city").setAttribute("disabled", "");

            checkZipcode(postalCodePattern);
        } else {
            document.querySelector("#street").removeAttribute("disabled");
            document.querySelector("#city").removeAttribute("disabled");
        }
    });

    document.querySelector("#postalCode").addEventListener("input", async function () {
        if(!this.value.trim()) {
            showError(this, "Postcode is verplicht");
            return;
        }

        if (!postalCodePattern.test(this.value.trim())) {
            showError(this, "Ongeldige postcode (bijv. 1234AB)");
            return;
        }

        checkZipcode(postalCodePattern);
        clearError(this);
    });

    document.querySelector("#houseNumber").addEventListener("input", function () {
        if (isNaN(parseInt(this.value))) {
            console.log("error");
            showError(this, "Ongeldig huisnummer");
            return;
        }

        checkZipcode(postalCodePattern);
        clearError(this);
    });
    document.querySelector("#houseNumberSuffix").addEventListener("input", function () {
        checkZipcode(postalCodePattern);
    });

    document.querySelector("#street").addEventListener("input", function () {
        if (!this.value.trim()) {
            showError(this, "Straatnaam is verplicht");
            return;
        }

        clearError(this);
    });

    document.querySelector("#email").addEventListener("input", function () {
        if(!this.value.trim()) {
            showError(this, "E-mailadres is verplicht");
            return;
        }
        
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(this.value.trim())) {
            showError(this, "Ongeldig e-mailadres");
            return;
        }

        clearError(this);
    });

    document.querySelector("#phone").addEventListener("input", function () {
        if(!this.value.trim()) {
            showError(this, "Telefoonnummer is verplicht");
            return;
        }

        let phonePattern = /^[0-9\+\-\s]{8,15}$/;
        if (!phonePattern.test(this.value.trim())) {
            showError(this, "Ongeldig telefoonnummer");
            return;
        }

        clearError(this);
    });

    document.querySelector("#termsAndConditions").addEventListener("change", function () {
        if(this.checked) {
            document.querySelector('.submitBtn').removeAttribute("disabled");
        }else{
            document.querySelector('.submitBtn').setAttribute("disabled", "");
        }
    });

    const form = document.querySelector(".orderForm");

    form.addEventListener("submit", async function (event) {
        event.preventDefault();
    
        if (document.querySelector(".error")) {
            return;
        }

        if(document.querySelector('input[name="gender"]:checked') === null) {
            showError(document.querySelector('.gender'), "Geslacht is verplicht");
            return;   
        }

        const data = await defaultFunctions.fetchData({
            products: JSON.stringify(cart.getItems()),
            gender: document.querySelector('input[name="gender"]:checked').value,
            firstName: document.querySelector("#firstName").value,
            lastNamePrefix: document.querySelector("#lastNamePrefix").value,
            lastName: document.querySelector("#lastName").value,
            country: document.querySelector("#country").value,
            postalCode: document.querySelector("#postalCode").value,
            houseNumber: document.querySelector("#houseNumber").value,
            houseNumberSuffix: document.querySelector("#houseNumberSuffix").value,
            street: document.querySelector("#street").value,
            city: document.querySelector("#city").value,
            email: document.querySelector("#email").value,
            phone: document.querySelector("#phone").value,
            dateOfBirth: document.querySelector("#dateOfBirth").value,
            function: 'createOrder',
        }, '/order/assets/php/functions.php');


        if (data.success) {
            window.location.href = "/bestellen/betalen";
        }

    });
});