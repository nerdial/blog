<template>
    <div v-if="title" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{title}}</div>

                    <div class="card-body">
                        {{body}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return {
              title : null,
              body : null
          }
        },
        mounted() {

            axios.get('api/post/1').then(({data})=> {
                this.title = data.data.title
                this.body = data.data.body
            })

        }
    }
</script>
