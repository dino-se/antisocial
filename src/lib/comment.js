const app = Vue.createApp({
    data() {
        return {
            comments: []
        }
    },
    mounted() {
        this.fetchComment();
    },
    methods: {
        fetchComment() {
            const urlParams = new URLSearchParams(window.location.search);
            const postId = urlParams.get('post');

            fetch(`../api/comment/getcomment.php?postid=${postId}`)
                .then(response => response.json())
                .then(data => {
                    this.comments = data.map(comment => ({
                        ...comment,
                        isEditing: false,
                        editedComment: comment.comment_text
                    }));

                    console.log(data);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        },

        editComment(id){
            this.comments = this.comments.map(comment => ({
                ...comment,
                isEditing: comment.comment_id === id
            }));
        },

        cancelEdit(item) {
            item.isEditing = false;
            item.editedComment = item.comment_text;
        },

        saveEditedComment(item) {
            fetch(`../api/comment/edit_comment.php?id=${item.comment_id}&comment=${item.editedComment}`)
                .then(() => {
                    location.reload();
                });
        },

        deleteComment(id) {
            fetch(`../api/comment/delete_comment.php?id=${id}`)
                .then(() => {
                    location.reload();
                });
        }
    }
});

app.mount('#comment');