const notif = Vue.createApp({
    data() {
        return {
            not: []
        }
    },
    mounted() {
        this.getNotif();
    },
    methods: {
        getNotif() {
            this.uid = localStorage.getItem('user_id');
            fetch(`../api/user/notif_user.php?uid=${uid}`)
            .then((data) => data.json())
            .then((res) => {
                this.not = res;
            });
        }
    }
});

notif.mount('#notifa');