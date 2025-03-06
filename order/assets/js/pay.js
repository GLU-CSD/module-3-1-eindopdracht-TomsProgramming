let defaultFunctions, cart, headNav, cartSide;

document.addEventListener('DOMContentLoaded', async function () {
    defaultFunctions = await import(`../../../assets/js/defaultFunctions.js?t=${new Date().getTime()}`);
    cart = await import(`../../../assets/js/modules/cart.js?t=${new Date().getTime()}`);
    headNav = await import(`../../../assets/js/modules/headNav.js?t=${new Date().getTime()}`);
    cartSide = await import(`./modules/cartSide.js?t=${new Date().getTime()}`);

    cartSide.load();

    const stripe = Stripe(stripePublicKey);

    const paymentMethods = document.querySelectorAll(".paymentMethods .method");
    const payButton = document.querySelector(".payButton");

    paymentMethods.forEach(method => {
        method.addEventListener("click", async function () {
            const selectedMethod = document.querySelector(".paymentMethods .method.selected");
            if(selectedMethod === method) {
                method.classList.remove("selected");
                payButton.disabled = true;
                return;
            }

            if (selectedMethod) {
                selectedMethod.classList.remove("selected");
            }

            method.classList.add("selected");
            payButton.disabled = false;
        });
    });

    payButton.addEventListener("click", async function () {
        const selectedMethods = document.querySelectorAll(".paymentMethods .method.selected");
        if(selectedMethods.length === 0 || selectedMethods.length > 1) {
            return;
        }

        const selectedMethod = selectedMethods[0];
        const method = selectedMethod.id;

        if(method === "ideal") {
            const { error } = await stripe.confirmIdealPayment(stripeClientSecret, {
                payment_method: {
                    type: "ideal",
                    ideal: {}
                },
                return_url: "https://webshop.tomtiedemann.com/bestellen/proces/"
            });
        
            if (error) {
                alert(error.message);
            }
        }
    });
});