const app = Vue.createApp({
    data() {
        return {
            contents: [],
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
                    this.contents = data.map(content => ({
                        ...content,
                        isEditing: false,
                        editedContent: content.content
                    }));
                })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
        },
        editContent(id){
            this.contents = this.contents.map(content => ({
                ...content,
                isEditing: content.post_id === id
            }));
        },
        cancelEditContent(item) {
            item.isEditing = false;
            item.editedContent = item.content;
        },

        saveEditedContent(item) {
            fetch(`../api/content/edit_content.php?postid=${item.post_id}&content=${item.editedContent}`)
                .then(() => {
                    location.reload();
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
