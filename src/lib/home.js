const app = Vue.createApp({
    data() {
        return {
            items: []
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            fetch('../api/content/getpost.php')
                .then(response => response.json())
                .then(data => {
                    this.items = data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    }
});

app.mount('#homepage');