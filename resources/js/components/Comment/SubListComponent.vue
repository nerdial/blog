<template>
    <div :id="`comment-${comment.id}`" class="row justify-content-center"
         style="margin-top: 10px;margin-bottom:10px  !important;">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><b>{{ comment.name }} </b>
                    <label style="color:blue;float: right"> {{ comment.created_at }} </label>
                </div>
                <div class="card-body">
                    {{ comment.body }}
                    <button v-if="level <= 2" @click="replyComment(comment.id)" style="float:right" type="button"
                            class="btn btn-info">Reply
                    </button>
                </div>
                <subList @replyButtonClicked="replyComment" :level="level + 1" :key="item.id" v-for="item in comment.children" :comment="item"></subList>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    props: ['comment', 'level'],
    name: 'subList',
    methods: {
        replyComment(id) {
            this.parentId = id
            this.$emit('replyButtonClicked', id)
        }
    }
}
</script>
