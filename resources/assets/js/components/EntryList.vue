<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">List of Entries</div>

                    <div class="panel-body">
                        <ul>
                            <li v-for="(item, index) in list" :key="`item-${index}`">
                                {{ item }}
                            </li>
                        </ul>
                    </div>

                    <form @submit.prevent="handleSubmit">
                        <label>
                            First Name:
                            <input v-model="first_name" placeholder="edit me">
                        </label>
                        <label>
                            Last Name:
                            <input v-model="last_name" placeholder="edit me">
                        </label>
                        <label>
                            Age:
                            <input v-model="age" placeholder="edit me">
                        </label>
                        <label>
                            Email:
                            <input v-model="email" placeholder="edit me">
                        </label>
                        <label>
                            Secret:
                            <input v-model="secret" placeholder="edit me">
                        </label>
                        <button type="submit">Submit</button>
                    </form>

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
                list: [{"name":"morgan"},{"name":"ollie"}]
            }
        },
        methods: {
            handleSubmit() {
            axios.post('http://dry-ocean-48302.herokuapp.com/api/data', {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    age: this.age,
                    email: this.email,
                    secret: this.secret
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
            // axios
            //     .get('http://dry-ocean-48302.herokuapp.com/api/data')
            //     .then(response => (this.list = response.data))
        }
    }
</script>
