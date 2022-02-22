<template>
    <div v-if="post">
        <post-component :post="post"></post-component>
        <br>
        <comment-component :post-id="postId"></comment-component>
    </div>
</template>

<script>
import PostComponent from "./PostComponent";
import CommentComponent from "./CommentComponent";

export default {
    components: {
        CommentComponent, PostComponent
    },
    data() {
        return {
            postId: 1,
            post: null,
            comments: null
        }
    },
    async mounted() {
        const {data} = await axios.get(`api/post/${this.postId}`)
        this.post = data.data
    }
}
</script>
