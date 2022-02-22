<template>
    <div>
        <list-component @replyButtonClicked="replyButtonClicked" :comments="comments"></list-component>
        <form-component @formSubmitted="formSubmitted"
                        :post-id="postId" :parent-id="parentId"></form-component>
    </div>
</template>

<script>

import FormComponent from "./Comment/FormComponent";
import ListComponent from "./Comment/ListComponent";

export default {
    components: {
        FormComponent, ListComponent
    },
    props: ['postId'],
    data() {
        return {
            comments: null,
            createdComment: null,
            parentId: null
        }
    },
    mounted() {
        this.getComments()
    },
    updated() {
        this.$nextTick(function () {
            if (this.createdComment) {
                const commentId = `comment-${this.createdComment.id}`
                document.getElementById(commentId).scrollIntoView({
                    behavior: 'smooth'
                });
                this.createdComment = null
            }
        })
    },
    methods: {
        formSubmitted(comment) {
            this.createdComment = comment
            this.getComments()
            this.$bvModal.hide('comment-modal')
        },
        replyButtonClicked(parentId) {
            this.parentId = parentId
            this.$bvModal.show('comment-modal')
        },
        async getComments() {
            const url = `api/post/${this.postId}/comments`
            const {data} = await axios.get(url)
            this.comments = data.data
        }
    }
}
</script>
