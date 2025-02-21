let defaultFunctions, notifications;

document.addEventListener('DOMContentLoaded', async function () {
    defaultFunctions = await import(`./defaultFunctions.js?t=${new Date().getTime()}`);
    notifications = await import(`./modules/notifications.js?t=${new Date().getTime()}`);

    const registerForm = document.getElementById('registerForm');
    registerForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const email = registerForm.email.value;
        const confirmEmail = registerForm.confirmEmail.value;
        const password = registerForm.password.value;
        const confirmPassword = registerForm.confirmPassword.value;

        const data = await defaultFunctions.fetchData({
            function: 'register',
            email,
            confirmEmail,
            password,
            confirmPassword,
            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
        });

        if(data.success) {
            window.location.href = '/email-verificatie';
        } else {
            notifications.setErrorText(data.error);
            
            registerForm.password.value = '';
            registerForm.confirmPassword.value = '';
        }
    });
});
