const chat = Vue.createApp({
    data() {
        return {
            statee: false
        }
    },
    methods: {
        chatBtn() {
            this.statee = true;
            console.error('hello');
        }
    }
});

chat.mount("#message");
