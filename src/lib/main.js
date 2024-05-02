const main = Vue.createApp({
    data() {
        return {
            uid: "",
            sugg: [],
        }
    },
    created() {
        this.uid = localStorage.getItem('user_id');
        this.suggestions();
    },
    methods: {
        suggestions() {
            const cuid = localStorage.getItem('user_id');
            fetch(`../api/user/suggest_user.php?uid=${cuid}`)
            .then((data) => data.json())
            .then((result) => {
                this.sugg = result;
            });
        }
    }
});

main.mount('#main');