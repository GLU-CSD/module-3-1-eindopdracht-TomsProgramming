let defaultFunctions, notifications;

document.addEventListener('DOMContentLoaded', async function () {
    defaultFunctions = await import(`./defaultFunctions.js?t=${new Date().getTime()}`);
    notifications = await import(`./modules/notifications.js?t=${new Date().getTime()}`);
    
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const email = loginForm.email.value;
        const password = loginForm.password.value;

        const data = await defaultFunctions.fetchData({
            function: 'login',
            email,
            password,
            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
        });

        if(data.success) {
            window.location.href = '/email-verificatie';
        } else {
            notifications.setErrorText(data.error);
            
            loginForm.password.value = '';
        }
    });
});