<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">Entries In Database</div>
                    <div class="panel-body">
                        <ul>
                            <li v-for="(item, index) in list" :key="index">
                                <pre>{{ item || pretty }}</pre>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Add New Entries</div>
                    <div class="panel-body">
                        <form @submit.prevent="handleSubmit">
                            <div v-for="(person, index) in people" :key="index" class="form-group" style="margin-bottom: 40px;">
                                <label>First Name:</label>
                                <input v-model="people[index].first_name">

                                <label>Last Name:</label>
                                <input v-model="people[index].last_name">

                                <label>Age:</label>
                                <input v-model="people[index].age">

                                <label>Email:</label>
                                <input v-model="people[index].email">

                                <label>Secret:</label>
                                <input v-model="people[index].secret">
                            </div>
                            <button class="btn btn-primary" style="margin-bottom: 20px;" type="submit">Submit</button>
                        </form>
                        <button v-on:click="addPerson" class="btn btn-secondary">Add Another Person To Entry</button>
                        <button v-if="people.length > 1" v-on:click="removePerson" class="btn btn-tertiary">Remove Person From Entry</button>
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
                people: [{
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
            addPerson() {
                this.people.push({
                    first_name:null,
                    last_name:null,
                    age:null,
                    email:null,
                    secret:null
                })
            },
            removePerson() {
                this.people.pop()
            },
            handleSubmit() {
                axios.post('http://dry-ocean-48302.herokuapp.com/api/data', {
                    "data":this.people
                }).then(function (response) {
                    console.log(response)
                }).catch(function (error) {
                    console.log(error)
                });

                this.showUpdatedEntries()

                this.people = [{
                    first_name:null,
                    last_name:null,
                    age:null,
                    email:null,
                    secret:null
                }]
            },
            showUpdatedEntries() {
                axios.get('http://dry-ocean-48302.herokuapp.com/api/data')
                .then(response => (this.list = response.data))
                .catch(function (error) {
                    console.log(error)
                });
            }
        },
        created() {
            axios.get('http://dry-ocean-48302.herokuapp.com/api/data')
            .then(response => (this.list = response.data))
            .catch(function (error) {
                console.log(error)
            });
        },
        filters: {
            pretty: function(value) {
                return JSON.stringify(JSON.parse(value), null, 2)
            }
        }
    }
</script>
