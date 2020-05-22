<template>
    <div class="container py-3">
        <div class="row">
            <div class="col-12 text-center">
                <div class="form">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label>Occupation 1</label>
                            <select-occupation v-model="occupation_1"></select-occupation>
                        </div>
                        <div class="col-md-5">
                            <label>Occupation 2</label>
                            <select-occupation v-model="occupation_2"></select-occupation>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger btn-block mt-4" @click.prevent="compare" :disabled="!occupation_1 || !occupation_2 || loading">
                                <template v-if="loading">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </template>
                                <template v-else>
                                    Compare
                                </template>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <template v-if="!result.length && !loading">
                <div class="col-12 text-center">
                    Please select two Occupations from above and click Compare
                </div>
            </template>
            <template v-else-if="loading">
                <div class="col-12 text-center">
                    Please wait...
                </div>
            </template>
            <template v-if="result.length">
                <div class="col-12">
                    <div class="card" v-for="(res, ind) in result" :key="ind">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <p><strong>#{{ ind + 1}}</strong></p>
                                </div>
                                <div class="col-sm-5">
                                    <p>{{ res.occupation_1 }}</p>
                                </div>
                                <div class="col-sm-4">
                                    <p>{{ res.occupation_2 }}</p>
                                </div>
                                <div class="col-sm-2">
                                    <div class="match">
                                        <p>{{ res.match }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    import SelectOccupation from '../components/form-controls/SelectOccupation';
    export default {
        name: 'home-page',
        components: {
            SelectOccupation
        },
        data() {
            return {
                loading: false,
                occupation_1: null,
                occupation_2: null,
                match: null,
                result: []
            }
        },
        methods: {
            compare() {
                this.loading = true;
                this.axios.post('/api/compare', {
                    occupation_1: this.occupation_1,
                    occupation_2: this.occupation_2
                }).then((response) => {
                    console.log(response);
                    this.loading = false;
                    this.result.unshift({
                        occupation_1: response.data.occupation_1,
                        occupation_2: response.data.occupation_2,
                        match: response.data.match
                    });
                    console.log(this.result);
                }).catch(() => {
                    this.loading = false;
                });
            }
        }
    }
</script>

<style lang="scss" scoped>
    .form-group {
        label {
            font-size: 0.8rem;
            text-align: left;
            display: block;
            margin-bottom: 0.2rem
        }
    }
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
