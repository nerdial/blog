<template>
    <b-modal id="comment-modal" title="Leave your comment" ok-title="Submit"

             @hidden="resetModal"
             @ok="handleOk">
        <form ref="form" @submit.stop.prevent="handleSubmit">
            <b-form-group
                label="Name"
                label-for="name-input"
                invalid-feedback="Name is required"
                :state="nameState"
            >
                <b-form-input
                    id="name-input"
                    :maxlength="50"
                    v-model="name"
                    :state="nameState"
                    placeholder="Your Name"
                    required
                ></b-form-input>
            </b-form-group>

            <b-form-group
                label="Comment"
                label-for="textarea-input"
                invalid-feedback="Comment is required"
                :state="bodyState"
            >
                <b-form-textarea
                    id="textarea-input"
                    v-model="body"
                    placeholder="Your comment"
                    rows="3"
                    max-rows="6"
                    required
                ></b-form-textarea>
            </b-form-group>

        </form>
    </b-modal>
</template>

<script>
import {BFormGroup, BFormInput, BFormTextarea} from 'bootstrap-vue'

Vue.component('b-form-group', BFormGroup)
Vue.component('b-form-input', BFormInput)
Vue.component('b-form-textarea', BFormTextarea)

export default {
    props: ['postId', 'parentId'],
    watch: {
        parentId: function (newVal, oldVal) {
            this.currentParentId = newVal
        },
    },
    data() {
        return {
            name: '',
            nameState: null,
            body: '',
            bodyState: null,
            currentParentId: this.parentId
        }
    },
    methods: {
        checkFormValidity() {
            const valid = this.$refs.form.checkValidity()
            this.nameState = !!(this.name.length)
            this.bodyState = !!(this.body.length)
            return valid
        },
        resetModal() {
            this.name = ''
            this.nameState = null
            this.body = ''
            this.bodyState = null
            this.$emit('removeParentId')
        },
        handleOk(bvModalEvt) {
            // Prevent modal from closing
            bvModalEvt.preventDefault()
            // Trigger submit handler
            this.handleSubmit()
        },
        async handleSubmit() {
            // Exit when the form isn't valid
            if (!this.checkFormValidity()) {
                return
            }

            const requestData = {
                name: this.name,
                body: this.body,
            }

            if (this.currentParentId) {
                requestData.parent_id = this.currentParentId
            }

            const url = `api/post/${this.postId}/comments`
            const {data} = await axios.post(url, requestData)
            const comment = data.data
            this.resetModal()
            this.$emit('formSubmitted', comment)
        }
    }
}
</script>
