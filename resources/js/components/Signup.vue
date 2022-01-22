<template>
<v-container>
    <v-form @submit.prevent="signup" margin-top:50px>
        <v-text-field
        v-model="form.name"
        label="Name"
        type="name"
        required
        ></v-text-field>
        <span class="red--text" v-if="errors.name">{{ this.errors.name[0] }}</span>
        <v-text-field
        v-model="form.email"
        label="E-mail"
        type="e-mail"
        required
        ></v-text-field>
        <span class="red--text" v-if="errors.email">{{ this.errors.email[0] }}</span>
        <v-text-field
        v-model="form.password"
        label="Password"
        type="password"
        required
        ></v-text-field>
        <span class="red--text" v-if="errors.password">{{ this.errors.password[0] }}</span>
        <v-text-field
        v-model="form.password_confirmation"
        label="Password Confirmation"
        type="password"
        required
        ></v-text-field>
        <v-btn color="purple" type="submit">Sign-up</v-btn>
    </v-form>
</v-container>
</template>

<script>
import User from '../Helpers/User'

export default {
    data(){
        return{
            form:{
                name:'',
                email:'',
                password:'',
                password_confirmation:'',
            },
            errors:{}
        }
    },
    methods:{
        signup(){
            axios.post('/api/auth/signup',this.form)
            .then(res => {
                User.responseAfterLogin(res)
                })
            .catch(error => this.errors = error)
        }
    }
}
</script>