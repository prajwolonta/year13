<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2 d-flex">
                    <p><strong>#{{ id + 1}}</strong></p>
                </div>
                <div class="col-sm-4 d-flex">
                    <p>{{ card.occupation_1 }}</p>
                </div>
                <div class="col-sm-4 d-flex">
                    <p>{{ card.occupation_2 }}</p>
                </div>
                <div class="col-sm-2 d-flex text-center">
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
            'card', 'id'
        ]
    }
</script>

<style lang="scss" scoped>
    .card{
        .d-flex{
            align-items: center;
            justify-content: left;
        }
        margin-bottom:15px;
        p{
            font-size: 16px;
            strong{
                font-size:75px;
                color:#ddd;
                line-height:1;
            }
        }
        .match{
            p{
                font-size:25px;
                font-weight: bold;
            }
        }
    }
</style>
