<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <b> Comments </b>
                        <button v-b-modal.comment-modal type="button" style="float: right"
                                class="btn btn-success">New Comment
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-for="comment in comments">
            <sub-list-component @replyButtonClicked="replyComment" :level="1"
                                :comment="comment"></sub-list-component>
        </div>
    </div>
</template>

<script>
import subListComponent from "./SubListComponent";

export default {
    components: {subListComponent},
    props: ['comments'],
    methods: {
        replyComment(id) {
            this.parentId = id
            this.$emit('replyButtonClicked', id)
        }
    }
}
</script>
