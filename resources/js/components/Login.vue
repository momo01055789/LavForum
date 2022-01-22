<template>
<v-container>
    <v-form @submit.prevent="login" margin-top:50px>
        <v-text-field
        v-model="form.email"
        label="E-mail"
        type="e-mail"
        required
        ></v-text-field>
        <v-text-field
        v-model="form.password"
        label="Password"
        type="password"
        required
        ></v-text-field>
        <v-btn color="green" type="submit">Login</v-btn>
        <router-link to="/signup">
            <v-btn color="purple" type="submit">Sign-up</v-btn>
        </router-link>
    </v-form>
</v-container>
</template>

<script>
import User from '../Helpers/User'
export default {
    data(){
        return{
            form:{
                email:'',
                password:'',
            }
        }
    },
    created(){
        if(User.LoggedIn()){
            this.$router.push({name:'forum'})
        }
    },
    methods:{
        login(){
            User.login(this.form)
            this.$router.push({name:'forum'})
        }
    }
}
</script>

<style>
.v-form{
    margin-top:100px;
    background-color: rgb(255, 253, 253);
    padding: 20px;
    border: 1px solid #b7b6b6;
    border-radius: 7px;
}
</style>