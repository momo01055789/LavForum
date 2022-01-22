<template>
    <div>
        <reply 
            v-for="(reply,index) in content" 
            :key="reply.id" 
            :data="reply"
            :index="index"></reply>
    </div>
</template>

<script>
import User from '../../Helpers/User';
import Reply from './Reply'
    export default {
        props: ['question'],
        components: {Reply},
        data() {
            return {
                content:this.question.replies
            }
        },
        created () {
            this.listen();
        },
        methods: {
            listen() {
                EventBus.$on('newReply',(reply) => {
                    this.content.unshift(reply)
                })
                EventBus.$on('destroyR',(index) => {
                    axios.delete(`/api/question/${this.question.id}/reply/${this.content[index].id}`)
                    .then(res =>{
                        this.content.splice(index,1)
                    })
                })
                Echo.private('App.Models.User.' + User.getId())
                    .notification((notification) => {
                        this.content.unshift(notification.reply)
                    });
                Echo.channel('deleteReply')
                    .listen('DeleteReplyEvent',(e) => {
                        for(let index = 0;index < this.content.length;index++){
                            if(this.content[index].id == e.id){
                                this.content.splice(index,1)
                            }
                        }
                    });
            }
        },
        
    }
</script>

<style>

</style>