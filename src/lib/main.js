const cuid = localStorage.getItem('user_id');

const main = Vue.createApp({
    data() {
        return {
            uid: "",
            sugg: [],
            notiff: 0
        }
    },
    created() {
        this.uid = localStorage.getItem('user_id');
        this. getAllNotif();
        this.suggestions();
    },
    methods: {
        suggestions() {
            fetch(`../api/user/suggest_user.php?uid=${cuid}`)
            .then((data) => data.json())
            .then((result) => {
                this.sugg = result;
            });
        },
        getAllNotif() {
            fetch(`../api/user/notif_user.php?uid=${cuid}`)
            .then((data) => data.json())
            .then((res) => {
                this.notiff = res[0].total_likes;
            })
        }
    }
});

main.mount('#main');