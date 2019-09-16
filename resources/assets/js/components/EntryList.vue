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
                                <input v-model="person[index].first_name">

                                <label>Last Name:</label>
                                <input v-model="person[index].last_name">

                                <label>Age:</label>
                                <input v-model="person[index].age">

                                <label>Email:</label>
                                <input v-model="person[index].email">

                                <label>Secret:</label>
                                <input v-model="person[index].secret">
                            </div>
                            <button class="btn btn-primary" style="margin-bottom: 20px;" type="submit">Submit</button>
                        </form>
                        <button v-on:click="addPerson" class="btn btn-secondary">Add Another Person To Entry</button>
                        <button v-if="people.length > 1" v-on:click="removePerson" class="btn btn-tertiary">Remove Person From Entry</button>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Delete An Entry</div>
                    <div class="panel-body">
                        <form @submit.prevent="deleteEntry">
                            <div class="form-group" style="margin-bottom: 40px;">
                                <label>Entry ID:</label>
                                <input v-model="deleteByID">
                            </div>
                            <button class="btn btn-primary" style="margin-bottom: 20px;" type="submit">Delete</button>
                        </form>
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
                deleteByID: null,
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
                }).then(response => {
                    console.log(response)
                }).catch(error => {
                    console.log(error)
                });

                this.showNewEntries()

                this.people = [{
                    first_name:null,
                    last_name:null,
                    age:null,
                    email:null,
                    secret:null
                }]
            },
            deleteEntry() {
                console.log(this.deleteByID)
            },
            showNewEntries() {
                axios.get('http://dry-ocean-48302.herokuapp.com/api/data')
                .then(response => (this.list = response.data))
                .catch(error => {
                    console.log(error)
                });
            }
        },
        created() {
            axios.get('http://dry-ocean-48302.herokuapp.com/api/data')
            .then(response => (this.list = response.data))
            .catch(error => {
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
