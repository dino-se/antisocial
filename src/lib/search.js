const search = Vue.createApp({
    data() {
        return {
            results: [],
            searchText: ''
        }
    },
    mounted() {
        this.fetchUserX();
    },
    methods: {
        fetchUserX() {
            fetch("../api/user/search_user.php")
            .then((response) => response.json())
            .then((data) => {
                this.results = data;
            })
            .catch((error) => {
                console.error('Error fetching data:', error);
            });
        },
        performSearch() {
            this.resultsFiltered = this.results.filter(item =>
                item.fullname.toLowerCase().includes(this.searchText.toLowerCase())
            );
        }
    },
    computed: {
        resultsFiltered() {
            return this.results.filter(item =>
                item.fullname.toLowerCase().includes(this.searchText.toLowerCase())
            );
        }
    }
});

search.mount('#search');
