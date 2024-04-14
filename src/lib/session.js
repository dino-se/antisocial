function deleteLocalStorageItem() {
    localStorage.removeItem('user_id');
}

function checkUserLocalStorage() {
    const userId = localStorage.getItem('user_id');
    if (!userId) {
        window.location.href = 'login.html';
    }
}

window.addEventListener('load', checkUserLocalStorage);
