<template>
    <div>
        <v-textarea
            outlined
            clear-icon="mdi-close-circle"
            label="Text"
            v-model="body"
        ></v-textarea>
        <v-btn color="green" dark @click="submit">Reply</v-btn>
    </div>
</template>

<script>
    export default {
        props: ['qid'],
        data() {
            return {
                body:null
            }
        },
        methods: {
            submit() {
                axios.post(`/api/question/${this.qid}/reply`,{body:this.body})
                .then(res => {
                    this.body = ''
                    EventBus.$emit('newReply',res.data.reply)
                    window.scrollTo(0,0)
                })
                .catch(err => console.log(err))
            }
        },
    }
</script>

<style>

</style>