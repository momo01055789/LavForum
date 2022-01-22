<template>
<v-container>
    <v-form @submit.prevent="update" margin-top:50px>
        <v-text-field
        outlined
        v-model="form.title"
        label="Title of The Question"
        type="title"
        required
        ></v-text-field>

        <v-textarea
            outlined
            clear-icon="mdi-close-circle"
            label="Text"
            v-model="form.body"
        ></v-textarea>
        <v-card-actions>
                <v-btn icon type="submit">
                    <v-icon color="#588157">save</v-icon>
                </v-btn>
                <v-btn icon @click="cancel">
                    <v-icon color="#355070">cancel</v-icon>
                </v-btn>
        </v-card-actions>
    </v-form>
</v-container>
</template>

<script>
export default {
    props:['data'],
    data(){
        return{
            form:{
                title:'',
                body:'',
            }
        }
    },
    mounted(){
        this.form = this.data
    },
    methods: {
        cancel(){
            EventBus.$emit('cancelEdit')
        },
        update(){
            axios.put(`/api/question/${this.data.id}`,this.form)
            .then(res => this.cancel())
            .catch(err => console.log(err))
        }
    },
}
</script>