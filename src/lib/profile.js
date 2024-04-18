const app = Vue.createApp({
    data() {
        return {
            items: [],
            suid: ""
        }
    },
    created() {
        this.suid = localStorage.getItem('user_id');
        const uid = new URLSearchParams(window.location.search).get('uid');

        fetch(`../api/profile/profile.php?uid=${uid}`)
        .then(response => response.json())
        .then(data => {
            this.items = data;
            console.log(this.items)
        })
    },
    methods: {
       followMe() {
        const fsuid = localStorage.getItem('user_id');
        const fuid = new URLSearchParams(window.location.search).get('uid');

        fetch(`../api/follow/follow.php?uid=${fsuid}&suid=${fuid}`)
        .then(() => {
            //location.reload();
        })
       }
    }
});

app.mount('#profile');
