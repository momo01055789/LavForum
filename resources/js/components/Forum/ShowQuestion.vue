<template>
    <v-card
        class="mx-auto mt-4"
        max-width="700"
        elevation="1"
        outlined
        shaped>
            <v-card-title>
                {{ data.title }}
            <v-spacer></v-spacer>
            <v-btn color="teal" dark>{{ replyCount }} Replies</v-btn>
            </v-card-title>
            <v-card-subtitle>Asked by :{{ data.user_name }} {{ data.created_at }} </v-card-subtitle>
            <v-card-text v-html="data.body"></v-card-text>
            <v-card-actions v-if="own">
                <v-btn icon small @click="edit">
                    <v-icon color="orange">edit</v-icon>
                </v-btn>
                <v-btn icon small @click="destroy">
                    <v-icon color="red">delete</v-icon>
                </v-btn>
            </v-card-actions>
    </v-card>
</template>

<script>
import User from '../../Helpers/User'
export default {
    props:['data'],
    data(){
        return{
            own: User.own(this.data.user_id),
            replyCount:this.data.replies_count
        }
    },
    methods:{
        destroy(){
            axios.delete(`/api/question/${this.data.id}`)
            .then(res => this.$router.push('/forum'))
            .catch(err => console.log(err))
        },
        edit(){
            EventBus.$emit('Edit')
        }
    },
    created () {
        EventBus.$on('newReply',() =>{
            this.replyCount++
        });
        Echo.private('App.Models.User.' + User.getId())
            .notification((notification) => {
                this.replyCount++
            });
        EventBus.$on('destroyR',() =>{
            this.replyCount--
        });
        Echo.channel('deleteReply')
            .listen('DeleteReplyEvent',(e) => {
                this.replyCount--
            });
    },
}
</script>