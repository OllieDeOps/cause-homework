<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">List of Entries</div>
                    <div class="panel-body">
                        <ul>
                            <li v-for="(item, index) in list" :key="index">
                                {{ item || pretty }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">List of Entries</div>
                    <div class="panel-body">
                        <form @submit.prevent="handleSubmit">
                            <div v-for="(entry, index) in entries" :key="index" class="entry" style="margin-bottom: 40px;">
                                <label>
                                    First Name:
                                    <input v-model="first_name">
                                </label>
                                <label>
                                    Last Name:
                                    <input v-model="last_name">
                                </label>
                                <label>
                                    Age:
                                    <input v-model="age">
                                </label>
                                <label>
                                    Email:
                                    <input v-model="email">
                                </label>
                                <label>
                                    Secret:
                                    <input v-model="secret">
                                </label>
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
                first_name: null,
                last_name: null,
                age: null,
                email: null,
                secret: null,
                entries: [{
                    "first_name":null,
                    "last_name":null,
                    "age":null,
                    "email":null,
                    "secret":null
                }],
                list: null
            }
        },
        methods: {
            addEntry() {
                this.entries.push({
                    "first_name":null,
                    "last_name":null,
                    "age":null,
                    "email":null,
                    "secret":null
                })
            },
            removeEntry() {
                this.entries.pop()
            },
            handleSubmit() {
                axios.post('http://dry-ocean-48302.herokuapp.com/api/data',
                {
                    "data":[{
                        "first_name":this.first_name,
                        "last_name":this.last_name,
                        "age":this.age,
                        "email":this.email,
                        "secret":this.secret
                    }]
                })
                .then(function (response) {
                    console.log(response)
                })
                .catch(function (error) {
                    console.log(error)
                });
            }
        },
        mounted() {
            console.log('mounted')
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
