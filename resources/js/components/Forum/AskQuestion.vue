<template>
<v-container>
    <v-form @submit.prevent="askQuestion" margin-top:50px>
        <span v-if="errors.title" class="red--text">{{ errors.title[0] }}</span>
        <v-text-field
        outlined
        v-model="form.title"
        label="Title of The Question"
        type="title"
        required
        ></v-text-field>
        <span v-if="errors.category_id" class="red--text">{{ errors.category_id[0] }}</span>
        <v-select
          :items="categories"
          v-model="form.category_id"
          item-text="name"
          item-value="id"
          label="Pick Category"
          outlined
        ></v-select>
        <span v-if="errors.body" class="red--text">{{ errors.body[0] }}</span>
        <v-textarea
            outlined
            clear-icon="mdi-close-circle"
            label="Text"
            v-model="form.body"
        ></v-textarea>
        <v-btn color="teal" type="submit" :disabled="disable">Ask</v-btn>
    </v-form>
</v-container>
</template>

<script>
export default {
    data(){
        return{
            form:{
                title:null,
                body:null,
                category_id:null,
            },
            categories:{},
            errors:{},
        }
    },
    methods:{
        askQuestion(){
            axios.post('api/question',this.form)
            .then(res => {
                this.$router.push(res.data.path)
            })
            .catch(err => this.errors = err.response.data.errors)
        }
    },
    created(){
        axios.get('/api/category')
        .then(res =>{
            this.categories = res.data.data
        })
    },
    computed: {
        disable() {
            // return !(this.form.title && this.form.body && this.form.category_id)
        }
    },
}
</script>

<style>
</style>