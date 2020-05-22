<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-1">
                    <p><strong>#{{ key + 1}}</strong></p>
                </div>
                <div class="col-sm-5">
                    <p>{{ card.occupation_1 }}</p>
                </div>
                <div class="col-sm-4">
                    <p>{{ card.occupation_2 }}</p>
                </div>
                <div class="col-sm-2">
                    <div class="match">
                        <p>{{ card.match }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OccupationCard",
        props: [
            'card',
            'key'
        ]
    }
</script>

<style lang="scss" scoped>
    .card{
        margin-bottom:15px;
        p{
            font-size: 16px;
        }
        .match{
            p{
                font-size:25px;
                font-weight: bold;
            }
        }
    }
</style>
