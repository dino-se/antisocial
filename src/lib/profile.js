const app = Vue.createApp({
    data() {
        return {
            items: []
        }
    },
    created() {
        const uid = new URLSearchParams(window.location.search).get('uid');

        fetch(`../api/profile/profile.php?uid=${uid}`)
        .then(response => response.json())
        .then(data => {
            this.items = data;
            console.log(this.items)
        })
    }
});

app.mount('#profile');
