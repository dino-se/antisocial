const app = Vue.createApp({
  data() {
    return {
      items: [],
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      const cuid = localStorage.getItem('user_id');
      fetch(`../api/content/getpost.php?fuid=${cuid}`)
        .then((response) => response.json())
        .then((data) => {
          this.items = data;
        })
        .catch((error) => {
          console.error("Error fetching data:", error);
        });
    },
  },
});

app.mount("#homepage");
