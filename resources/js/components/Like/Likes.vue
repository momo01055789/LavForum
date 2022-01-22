<template>
    <div style="max-width:50px">
        <v-btn icon @click="like">
            <v-icon :color="color">favorite</v-icon> {{ count }}
        </v-btn>
    </div>
</template>

<script>
import User from '../../Helpers/User'
    export default {
        props:['content'], 
        data() {
            return {
                liked: this.content.liked,
                count:this.content.likes_count
            }
        },
        computed: {
            color() {
                return this.liked ? 'red' : '#FFCDD2';
            }
        },
        created () {
            Echo.channel('likeChannel')
                .listen('LikeEvent', (e) => {
                    if(this.content.id == e.id){
                        e.type == 1 ? this.count++ : this.count--
                    }
                });
        },
        methods: {
            like() {
                if(User.LoggedIn()){
                    this.liked ? this.decr() : this.incr()
                    this.liked = !this.liked
                }
            },
            incr(){
                axios.post(`/api/${this.content.id}/like`)
                .then(res => this.count ++)
                .catch(err => console.log(err))
            },
            decr(){
                axios.delete(`/api/${this.content.id}/unlike`)
                .then(res => this.count --)
                .catch(err => console.log(err))
            }
        },
    }
</script>

<style>

</style>