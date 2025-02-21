function setMessageVisibility(type) {
    const notificationText = document.querySelector('.notificationText');
    const errorText = document.querySelector('.errorText');

    errorText.style.display = type === 'error' ? 'block' : 'none';
    notificationText.style.display = type === 'notification' ? 'block' : 'none';
}

export function setErrorText(message) {
    const error = document.querySelector('.errorText');
    error.innerHTML = message;
    setMessageVisibility('error');
}

export function setNotificationText(message) {
    const notificationText = document.querySelector('.notificationText');
    notificationText.innerHTML = message;
    setMessageVisibility('notification');
}