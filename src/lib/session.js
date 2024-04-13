function checkUserCookie() {
    const cookies = document.cookie.split('; ');
    for (const cookie of cookies) {
        const [name, value] = cookie.split('=');
        if (name === 'user_id' && value) {
            return;
        }
    }
    window.location.href = 'login.html';
}

window.addEventListener('load', checkUserCookie);
