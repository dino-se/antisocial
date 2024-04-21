document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('fileInput').addEventListener('change', handleFileSelect);
});

function handleFileSelect(event) {
    const files = event.target.files;
    const uid = localStorage.getItem('user_id');
    const formData = new FormData();

    for (let i = 0; i < files.length; i++) {
        formData.append('img[]', files[i]);
    }

    formData.append('uid', uid);

    fetch('../api/upload/image.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}