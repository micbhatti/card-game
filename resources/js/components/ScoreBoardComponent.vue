<template>
        <div class="card mt-10">
            <div class="card-header">Scoreboard</div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Name</th>
                            <th scope="col" class="text-center">Total Games</th>
                            <th scope="col" class="text-center">Wins</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="game in scoreBoard" :key="game.id">
                            <td class="text-center">{{ game.user.name }}</td>
                            <td class="text-center">{{ game.total_games }}</td>
                            <td class="text-center">{{ game.total_wins }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</template>

<script>
    export default {
        props:
            [
                'scoreBoard'
            ]
    }
</script>
