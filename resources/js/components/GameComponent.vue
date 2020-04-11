<template>
   <div class="game-component">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">Play Game</div>
                    <div class="card-body">
                    <div class="form-group">
                        <div class="col-12">
                            <form>
                                <label for="name">Cards</label>
                                <input type="text" class="form-control" name="user_cards" id="user_cards" placeholder="Enter your cards separated by a space" required v-model="user_cards" v-on:click="resetResult()"
                                />
                                <input type="hidden" name="user_id" v-model="user_id" />
                            </form>
                            <div v-if="error" class="text-danger">{{ error }}</div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary btn-lg btn-block" v-on:click="submit()">Play!</button>
                        </div>
                    </div>

                    <div class="mt-2" v-if="show_result">
                        <h3>Result</h3>
                        <div class="alert alert-dark" role="alert">
                            {{ result.user_win }}
                        </div>
                        <p>Your Cards: {{ user_cards }}</p>
                        <p>Your Score: {{ result.user_score }}</p>
                        <p>Generated Cards: {{ result.bot_cards }}</p>
                        <p>Generated Score: {{ result.bot_score  }}</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="justify-content-center mt-5">
            <score-board-component :scoreBoard=new_scores></score-board-component>
        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                user_cards: '',
                error: '',
                result: {},
                show_result: '',
                new_scores: '',
            }
        },
        beforeMount() {
            this.refreshScoreBoard()
        },
        props:
            ['user_id']
        ,
        methods: {
            resetResult() {
                this.show_result = false;
            },
            submit() {
                axios
                .post('/api/store_score', { 'user_cards' : this.user_cards, 'user_id' : this.user_id })
                .then(response => {
                    this.error = '';
                    this.show_result = response.data.user_win;
                    this.result.user_win = response.data.user_win;
                    this.result.user_cards = response.data.user_cards;
                    this.result.user_score = response.data.user_score;
                    this.result.bot_score = response.data.bot_score;
                    this.result.bot_cards = response.data.bot_cards;
                     this.refreshScoreBoard()
                })
                .catch(error => {
                    console.log(error)
                    this.error = error.response.data.errors.user_cards[0]
                })
            },
            refreshScoreBoard() {
                axios.
                get('/api/score_board')
                .then( response => {
                        this.new_scores = response.data.data
                })
            }
        }
    }
</script>
