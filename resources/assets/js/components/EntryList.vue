<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">List of Entries</div>
                    <div class="panel-body">
                        <ul>
                            <li v-for="(item, index) in list" :key="index">
                                {{ item || pretty(item) }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">List of Entries</div>
                    <div class="panel-body">
                        <form @submit.prevent="handleSubmit">
                            <div v-for="(entry, index) in entries" :key="index" class="entry" style="margin-bottom: 40px;">
                                <label>First Name:</label>
                                <input v-model="entries[index].first_name">

                                <label>Last Name:</label>
                                <input v-model="entries[index].last_name">

                                <label>Age:</label>
                                <input v-model="entries[index].age">

                                <label>Email:</label>
                                <input v-model="entries[index].email">

                                <label>Secret:</label>
                                <input v-model="entries[index].secret">
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                        <button v-if="entries.length > 1" v-on:click="removeEntry">Remove Entry</button>
                        <button v-on:click="addEntry">Add another entry to submit</button>
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
                entries: [{
                    first_name:null,
                    last_name:null,
                    age:null,
                    email:null,
                    secret:null
                }],
                list: null
            }
        },
        methods: {
            addEntry() {
                this.entries.push({
                    first_name:null,
                    last_name:null,
                    age:null,
                    email:null,
                    secret:null
                })
            },
            removeEntry() {
                this.entries.pop()
            },
            handleSubmit() {
                console.log({
                    "data":this.entries
                })
                axios.post('http://dry-ocean-48302.herokuapp.com/api/data',
                {
                    "data":this.entries
                })
                .then(function (response) {
                    console.log(response)
                })
                .catch(function (error) {
                    console.log(error)
                });
            }
        },
        updated() {
            axios
                .get('http://dry-ocean-48302.herokuapp.com/api/data')
                .then(response => (this.list = response.data))
                .catch(function (error) {
                    console.log(error)
                });
        },
        mounted() {
            axios
                .get('http://dry-ocean-48302.herokuapp.com/api/data')
                .then(response => (this.list = response.data))
                .catch(function (error) {
                    console.log(error)
                });
        },
          filters: {
            pretty: function(value) {
                return JSON.stringify(JSON.parse(value), null, 2);
            }
        }
    }
</script>
