<template>
    <div class="container">
        <div class="card enter-usernmae" v-if="!play_game">
            <div class="card-header">Start by entering you username</div>
            <div class="card-body">
                <form @submit.prevent="submit">
                    <div class="form-group">
                        <div class="col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" v-model="name" />
                            <div v-if="error" class="text-danger">{{ error }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Enter</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="play_game" v-if="play_game">
            <game-component :user_id=user_id></game-component>
        </div>
    </div>

</template>
<script>
    export default {
       data() {
            return {
                name: '',
                play_game :false,
                error: '',
                user_id : ''
            }
        },
        methods: {
            submit() {
                axios
                .post('/api/store_user', {'name' : this.name})
                .then(response => {
                    console.log("user_id => " + response.data.user_id)
                    this.play_game = true
                    this.user_id = response.data.user_id
                })
                .catch(error => {
                    this.error = error.response.data.message
                })
            }
        }
    }
</script>
