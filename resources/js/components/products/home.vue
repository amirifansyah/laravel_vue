
<template>
    <div class="dashboard" style="margin-top:80px">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            MAIN MENU
                            <hr>
                            <ul class="list-group">
                                <li @click="logout" class="list-group-item text-dark text-decoration-none" style="cursor:pointer">LOGOUT</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            DASHBOARD
                            <hr>
                            Selamat Datang <strong>{{ user.name }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios'

export default {
    name: 'Dashboard',

    data() {
        return {
            //state loggedIn with localStorage
            loggedIn: localStorage.getItem('loggedIn'),
            //state token
            token: localStorage.getItem('token'),
            //state user logged In
            user: [],
            token: ''
        }
    },

    created() {
        this.token = "Bearer " + localStorage.getItem("token");
        axios.get('http://127.0.0.1:8000/api/user', {headers: {'Authorization': 'Bearer '+this.token}})
        .then(response => {
            console.log(response)
            this.user = response.data // assign response to state user
        })
    },

    methods: {
        logout() {
            axios.get('http://127.0.0.1:8000/api/auth/logout', { 
                    headers : {
                        Authorization: this.token
                    }
                }
            )
            .then(() => {
                //remove localStorage
                localStorage.removeItem("loggedIn")    
                localStorage.removeItem("token")    


                //redirect
                return this.$router.push({ name: 'Login' })
            })
        }
    },

    //check user logged in or not
    mounted() {
        if(!this.loggedIn) {
            return this.$router.push({ name: 'Login' })
        }
    }
}
</script>