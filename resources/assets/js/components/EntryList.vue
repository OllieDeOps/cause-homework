<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">List of Entries</div>

                    <div class="panel-body">
                        <ul>
                            <li v-for="item in list" :key="item">
                                {{ item }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                list: null
            }
        },
        mounted() {
            console.log('mounted')
            axios
                .get('http://dry-ocean-48302.herokuapp.com/api/data')
                .then(response => (this.list = response.data))
        }
    }
</script>
