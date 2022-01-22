<template>
  <v-card
    text
    tile
  >
    <v-toolbar 
    dense
    color="indigo"
    dark>
    <router-link to="/"><v-toolbar-title class="white--text">LAV Forum</v-toolbar-title></router-link>

      <v-spacer></v-spacer>

    <notifications v-if="loggedIn"></notifications>

  <!-- eslint-disable -->
      <router-link 
      v-for="item in items" 
      :key="item.title"
      :to="item.to"
      v-if="item.show">
  <!-- eslint-enable -->
        <v-btn text>{{ item.title }}</v-btn>
      </router-link>
    </v-toolbar>
  </v-card>
</template>

<script>
import User from '../Helpers/User'
import Notifications from './Notifications'
export default {
  components: { Notifications },
  data(){
    return {
      loggedIn:User.LoggedIn(),
      items:[
        {title:'Forum',to:'/forum',show:true},
        {title:'Ask Question',to:'/ask',show:User.LoggedIn()},
        {title:'Categories',to:'/category',show:User.admin()},
        {title:'Login',to:'/login',show:!User.LoggedIn()},
        {title:'Logout',to:'/logout',show:User.LoggedIn()},
      ]
    }
  },
  created(){
    EventBus.$on('logout',()=>{
      User.logOut()
    })
  }
}
</script>

<style>
</style>