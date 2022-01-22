<template>
    <div class="text-center">
        <v-menu offset-y>
        <template v-slot:activator="{ on, attrs }">
            <v-btn
            v-bind="attrs"
            v-on="on"
            icon
            >
                <v-icon :color="color">add_alert</v-icon>{{unreadCount}}
            </v-btn>
        </template>
        <v-list>
            <v-list-item v-for="item in unread" :key="item.id">
                <router-link :to="item.path">
                    <v-list-item-title @click="seen(item)">{{ item.question }}</v-list-item-title>
                </router-link>
            </v-list-item>
        </v-list>
        </v-menu>
    </div>
</template>

<script>
import User from '../Helpers/User'
import Exception from '../Helpers/Exception'
    export default {
    data() {
        return {
            read:{},
            unread:{},
            unreadCount:0,
            sound:'https://soundbible.com/mp3/sms-alert-3-daniel_simon.mp3'
        }
    },
    created () {
        if(User.LoggedIn()){
            this.getNotifications();
        };

        Echo.private('App.Models.User.' + User.getId())
            .notification((notification) => {
                this.playSound()
                this.unread.unshift(notification)
                this.unreadCount++
            });
    },
    methods: {
        getNotifications() {
            axios.post('/api/notifications')
            .then(res => {
                this.read = res.data.read;
                this.unread = res.data.unread;
                this.unreadCount = res.data.unread.length;
            })
            .catch(err => Exception.handle(err))
        },
        seen(notification){
            axios.post('/api/markAsRead',{id:notification.id})
            .then(res => {
                this.unread.splice(notification,1)
                this.read.push(notification)
                this.unreadCount--
            })
            .catch(err => console.log(err))
        },
        playSound(){
            let alert = new Audio(this.sound)
            alert.play()
        }
    },
    computed: {
        color() {
            return this.unreadCount > 0 ? 'red' : '#FFCDD2' 
        }
    },
}
</script>

<style>

</style>