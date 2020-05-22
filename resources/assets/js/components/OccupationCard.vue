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
                <div class="col-sm-1 d-flex text-center">
                    <div class="match">
                        <p>{{ card.match }}%</p>
                    </div>
                </div>
                <div class="col-sm-1 d-flex text-center">
                    <button @click.prevent="show = !show" class="btn btn-outline-secondary btn-xs">{{show == true ? 'Hide' : 'Show'}}</button>
                </div>
            </div>
            <div class="row result" v-if="show">
                <div class="col-md-6">
                    <Occupations :occupations="card.occupations_1"/>
                </div>
                <div class="col-md-6">
                    <Occupations :occupations="card.occupations_2"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Occupations from './Occupations'

    export default {
        name: "OccupationCard",
        components: {
            Occupations
        },
        props: [
            'card', 'id'
        ],
        data(){
            return {
                show: false
            }
        },
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
        .result{

        }
    }
</style>
