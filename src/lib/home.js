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
    deletePost(id) {
      fetch(`../api/content/delete_post.php?id=${id}`)
          .then(() => {
              location.reload();
          });
  }

  }
});

app.mount("#homepage");
