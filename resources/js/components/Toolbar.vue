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
      <div class="list">
              <router-link 
              class="hidden-sm-and-down"
              v-for="item in items" 
              :key="item.title"
              :to="item.to"
              v-if="item.show">
          <!-- eslint-enable -->
                <v-btn text>{{ item.title }}</v-btn>
              </router-link>
      </div>
      <div @click="show" class="burger-menu hidden-md-and-up">
        <div class="bar"></div>
      </div>
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
  methods: {
    show() {
      const item = document.querySelector('.list') 
      item.classList.toggle('open')
    }
  },
  created(){
    EventBus.$on('logout',()=>{
      User.logOut()
    })
  }
}
</script>

<style scoped>
.v-toolbar{z-index:10;}
.burger-menu{
  width:37px;
  height:37px;
  background:transparent;
  border: 1px solid white;
  position:relative;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 5px;
  cursor: pointer;
}
.burger-menu .bar{
  width:80%;
  height:5px;
  background:white;
  border-radius:5px
}
.burger-menu .bar::before,
.burger-menu .bar::after{
  content: '';
  position: absolute;
  width:80%;
  height:5px;
  background:white;
  border-radius:5px
}
.burger-menu .bar::before{transform:translateY(10px)}
.burger-menu .bar::after{transform:translateY(-10px)}
.open a{display: inline-block !important;}
.list.open{
    display: flex;
    flex-direction: column;
    background: #3f51b5;
    position: absolute;
    right: 0px;
    top: 50px;
    width: 100%;
    border-radius: 10px;
}
</style>