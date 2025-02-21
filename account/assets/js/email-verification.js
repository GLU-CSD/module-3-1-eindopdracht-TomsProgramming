let defaultFunctions, notifications;

document.addEventListener('DOMContentLoaded', async function () {
    defaultFunctions = await import(`./defaultFunctions.js?t=${new Date().getTime()}`);
    notifications = await import(`./modules/notifications.js?t=${new Date().getTime()}`);

    const resetMail = document.querySelector('.resendMail');
    resetMail.addEventListener('click', async function () {
        const data = await defaultFunctions.fetchData({
            function: 'resendVerificationCode'
        });

        if(data.success) {
            notifications.setNotificationText('Er is een nieuwe verificatie e-mail verstuurd.');
        }else{
            notifications.setErrorText(data.error);
        }
    });

    const verifyCodeForm = document.getElementById('verifyCodeForm');
    verifyCodeForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const code = verifyCodeForm.code.value;

        const data = await defaultFunctions.fetchData({
            function: 'verifyCode',
            code
        });

        if(data.success) {
            window.location.href = '/mijn-account';
        } else {
            notifications.setErrorText(data.error);
        }
    });
});