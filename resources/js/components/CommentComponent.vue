<template>
    <div>
        <list-component @replyButtonClicked="replyButtonClicked" :comments="comments"></list-component>
        <form-component @formSubmitted="formSubmitted" @removeParentId="removeParentId"
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
            newlyCreatedComment: null,
            parentId: null
        }
    },
    mounted() {
        this.getComments()
    },
    updated() {
        this.$nextTick(function () {
            if (this.newlyCreatedComment) {
                const commentId = `comment-${this.newlyCreatedComment.id}`
                const commentObject = document.getElementById(commentId)

                if (commentObject) {
                    document.getElementById(commentId).scrollIntoView({
                        behavior: 'smooth'
                    });
                }
                this.newlyCreatedComment = null
                this.removeParentId()
            }
        })
    },
    methods: {
        formSubmitted(comment) {
            this.newlyCreatedComment = comment
            this.getComments()
            this.$bvModal.hide('comment-modal')

        },
        replyButtonClicked(parentId) {
            this.parentId = parentId
            this.$bvModal.show('comment-modal')
        },
        removeParentId() {
            this.parentId = null
        },
        async getComments() {
            const url = `api/post/${this.postId}/comments`
            const {data} = await axios.get(url)
            this.comments = data.data
        }
    }
}
</script>
