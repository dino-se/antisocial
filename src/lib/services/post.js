const userId = localStorage.getItem('user_id');
document.getElementById("userid").value = userId;

document.getElementById('postForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    fetch('../api/content/post.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(() => {
        clearMind();
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again later.');
    });
});

function clearMind() {
    document.getElementById("postForm").reset();
}