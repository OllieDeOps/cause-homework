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
                            <div v-for="(person, index) in people" :key="index" class="form-group" style="margin-bottom: 30px;">
                                <label>First Name:</label>
                                <input v-model="person.first_name">

                                <label>Last Name:</label>
                                <input v-model="person.last_name">

                                <label>Age:</label>
                                <input v-model="person.age">

                                <label>Email:</label>
                                <input v-model="person.email">

                                <label>Secret:</label>
                                <input v-model="person.secret">
                            </div>
                            <button class="btn btn-primary" style="margin-bottom: 20px;" type="submit">Submit</button>
                        </form>
                        <button v-on:click="addPerson" class="btn btn-secondary">Add Another Person To Entry</button>
                        <button v-if="people.length > 1" v-on:click="removePerson" class="btn btn-tertiary">Remove Person From Entry</button>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Delete Entry</div>
                    <div class="panel-body">
                        <form @submit.prevent="handleDelete">
                            <div class="form-group" style="margin-bottom: 30px;">
                                <label>ID Of Entry To Delete:</label>
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
                list: null,
                deleteByID: null
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
                    this.showUpdatedEntries()
                }).catch(error => {
                    console.log(error)
                });

                this.people = [{
                    first_name:null,
                    last_name:null,
                    age:null,
                    email:null,
                    secret:null
                }]
            },
            handleDelete() {
                axios.delete('http://dry-ocean-48302.herokuapp.com/api/data/' + this.deleteByID)
                .then(response => {
                    this.showUpdatedEntries()
                }).catch(error => {
                    console.log(error)
                });
            },
            showUpdatedEntries() {
                axios.get('http://dry-ocean-48302.herokuapp.com/api/data')
                .then(response => {
                    this.list = response.data
                })
                .catch(error => {
                    console.log(error)
                });
            }
        },
        created() {
            this.showUpdatedEntries()
        },
        filters: {
            pretty: function(value) {
                return JSON.stringify(JSON.parse(value), null, 2)
            }
        }
    }
</script>
