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

        <div :id="`comment-${comment.id}`" v-for="comment in comments" class="row justify-content-center"
             style="margin-top: 10px;margin-bottom:20px  !important;">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><b>{{ comment.name }} </b>
                        <label style="color:blue;float: right"> {{ comment.created }} </label>
                    </div>

                    <div class="card-body">
                        {{ comment.body }}

                        <button @click="replyComment(comment.id)" style="float:right" type="button"
                                class="btn btn-info">Reply
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['comments'],
    methods: {
        replyComment(id) {
            this.parentId = id
            this.$emit('replyButtonClicked', id)
        }
    }
}
</script>
