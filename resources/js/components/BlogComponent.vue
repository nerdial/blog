<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Blog App</div>

                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="yourName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="yourName" placeholder="Your Name">
                                </div>
                            </div>

                            <br>

                            <div class="form-group row">
                                <label for="yourComment" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <textarea rows="6" class="form-control" id="yourComment" placeholder="Your Comment">
                                    </textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
