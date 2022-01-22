<template>
    <div v-if="question">
        <edit 
        :data=question 
        v-if="editing">
        </edit>
        <show-question
        v-else 
        :data=question>
        </show-question>
    <v-container>
        <replies :question=question></replies>
        <create-reply v-if="loggedIn" :qid="question.id"></create-reply>
        <div class="mt-2" v-else>
            <router-link :to="{path:'/login'}">
                <v-card-actions>
                    <v-btn icon><v-icon color="green">login</v-icon></v-btn>
                </v-card-actions>
            </router-link>
        </div>
    </v-container>
    </div>
</template>

<script>
import ShowQuestion from './ShowQuestion'
import Edit from './Edit.vue'
import Replies from '../Replies/Replies'
import CreateReply from '../Replies/CreateReply'
import User from '../../Helpers/User'
export default {
    components:{ShowQuestion,Edit,Replies, CreateReply},
    data(){
        return{
            question:null,
            editing:false,
        }
    },
    created(){
        this.listen();
        this.getQuestion();
    },
    methods: {
        listen(){
            EventBus.$on('Edit',() =>{
                this.editing = true
            })
            EventBus.$on('cancelEdit',() =>{
                this.editing = false
            })
        },
        getQuestion(){
            axios.get(`/api/question/${this.$route.params.id}`)
            .then(res => {
                this.question = res.data.data
            })
        }
    },
    computed: {
        loggedIn() {
            return User.LoggedIn();
        }
    },
}
</script>