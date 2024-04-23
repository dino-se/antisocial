const app = Vue.createApp({
  data() {
    return {
      items: [],
    };
  },
  mounted() {
    this.fetchPost();
  },
  methods: {
    fetchPost() {
      const cuid = localStorage.getItem('user_id');
      fetch(`../api/content/get_content.php?fuid=${cuid}&cuid=${cuid}`)
        .then((response) => response.json())
        .then((data) => {
          this.items = data;
        })
        .catch((error) => {
          console.error("Error fetching data:", error);
        });
    },
    deletePost(id) {
      fetch(`../api/content/delete_content.php?post_id=${id}`)
          .then(() => {
              location.reload();
          });
  }

  }
});

app.mount("#homepage");
