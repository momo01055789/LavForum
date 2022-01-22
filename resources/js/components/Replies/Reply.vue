<template>
<v-card
    class="mx-auto mb-2"
    max-width="600"
    outlined
  >
    <v-list-item three-line>
      <v-list-item-content>
        <div class="max-width:70px;text-overline mb-2">
          {{ data.created_at }}
        </div>
        <v-list-item-title class="text-h5 mb-1">
          {{ data.user }}
        <v-spacer></v-spacer>
          <likes :content="data"></likes>
        </v-list-item-title>
        <edit-reply 
        v-if="editing"
        :reply="data"></edit-reply>
        <v-list-item-subtitle v-else>{{ data.reply }}</v-list-item-subtitle>
      </v-list-item-content>
        <div v-if="!editing">
            <v-card-actions v-if="own">
            <v-btn icon>
                <v-icon color="orange" @click="edit">edit</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon color="red" @click="destroy">delete</v-icon>
            </v-btn>
            </v-card-actions>
        </div>
    </v-list-item>
  </v-card>
</template>

<script>
import User from '../../Helpers/User'
import Likes from '../Like/Likes'
import EditReply from './EditReply'
    export default {
  components: { EditReply,Likes },
        props:['data','index'],
        data() {
            return {
                editing: false,
                beforeEditBody:''
            }
        },
        computed: {
            own() {
                return User.own(this.data.user_id)
            }
        },
        methods: {
            destroy() {
              EventBus.$emit('destroyR',this.index)  
            },
            edit(){
                this.editing = true
                this.beforeEditBody = this.data.reply
            },
            listen(){
                EventBus.$on('cancelEdit',(reply)=>{
                    this.editing = false
                    if(reply !== this.data.reply){
                        this.data.reply = this.beforeEditBody
                        this.beforeEditBody = ''
                    }
                })
            }
        },
        created () {
            this.listen();
        },
    }
</script>

<style>

</style>