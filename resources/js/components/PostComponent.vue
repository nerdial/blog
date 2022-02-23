<template>
    <div class="container" id="vahid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <h3 style="margin: 20px"><b>{{ post.title }}</b>
                        <hr>
                    </h3>
                    <div v-html="post.body" style="margin: 20px" class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['post']
}
</script>
