<template>
    <div>
        <v-textarea
            outlined
            class="mt-2"
            clear-icon="mdi-close-circle"
            label="Text"
            v-model="reply.reply"
        ></v-textarea>
        <v-card-actions>
            <v-btn icon>
                <v-icon color="green" @click="save">save</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon color="black" @click="cancel">cancel</v-icon>
            </v-btn>
            </v-card-actions>
    </div>
</template>

<script>
    export default {
        props:['reply'],
        methods: {
            save() {
                axios.patch(`/api/question/${this.reply.question_id}/reply/${this.reply.id}`,{body:this.reply.reply})
                .then(res => {
                    this.cancel(this.reply.reply)
                })
                .catch(err => console.log(err))
            },
            cancel(reply){
                EventBus.$emit('cancelEdit',reply)
            }
        },
        
    }
</script>

<style>

</style>