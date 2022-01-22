<template>
<v-container>
    <v-form @submit.prevent="submit" margin-top:50px>
        <v-text-field
        v-model="form.name"
        label="Category Name"
        type="e-mail"
        required
        ></v-text-field>
            <v-alert v-if="errors" type="error" >
                {{ errors.name }}
            </v-alert>
        <v-btn color="cyan" type="submit" :disabled="disable" v-if="Edit">Update</v-btn>        
        <v-btn color="teal" type="submit" :disabled="disable" v-else>Create</v-btn>
    </v-form>
    <v-card
    overflow="auto" 
    class="Clist"
    max-width="450">
        <v-toolbar
        color="orange"
        dark
        >
        <v-toolbar-title>Categories</v-toolbar-title>
        </v-toolbar>
        <v-list>
        <v-list-item  v-for="(category,index) in categories" :key="category.id">
            <v-list-item-title>
                {{ category.name }}
            </v-list-item-title>
                <v-spacer></v-spacer>
            <v-card-actions>
                    <v-btn icon @click="edit(index)">
                        <v-icon color="#06d6a0">edit</v-icon>
                    </v-btn>
                    <v-btn icon @click="destroy(category.id)">
                        <v-icon color="#d62828" >delete</v-icon>
                    </v-btn>
            </v-card-actions>
        </v-list-item>
        </v-list>
  </v-card>
</v-container>
</template>

<script>
    export default {
        data() {
            return {
                form:{
                    name:null
                },
                categories:{},
                Edit:null,
                errors:null
            }
        },
        methods: {
            submit() {
                this.Edit ? this.update() : this.create()
            },
            destroy(id,index){
                axios.delete(`api/category/${id}`)
                .then(res => this.categories.splice(index,1))
            },
            edit(index){
                this.form.name = this.categories[index].name
                this.Edit = this.categories[index].id
                this.categories.splice(index,1)
            },
            create(){
                axios.post('/api/category',this.form)
                .then(res => {
                    this.categories.unshift(res.data)
                    this.form.name = null
                })
                .catch(error => this.errors = error.Response.data.errors )
            },
            update(){
                axios.patch(`/api/category/${this.Edit}`,this.form)
                .then(res => {
                    this.categories.unshift(res.data)
                    this.form.name = null
                    this.Edit = false
                })
                .catch(err => console.log(err))
            }
        },
        created () {
            if (!User.admin()) {
                this.$router.push('/forum')
            }
            axios.get('api/category')
            .then(res => this.categories = res.data.data)
            .catch(error => this.errors = error.Response.data.errors )
        },
        computed: {
            disable() {
                return !this.form.name
                }
        },
}
</script>

<style>
.Clist{
    overflow: auto;
    height: 330px;
    margin-top:30px;
}
</style>