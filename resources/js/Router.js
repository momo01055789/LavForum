import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from './components/Login'
import Signup from './components/Signup'
import Forum from './components/Forum'
import Logout from './components/Logout'
import Read from './components/Forum/Read'
import Category from './components/Category/CreateCategory'
import AskQuestion from './components/Forum/AskQuestion'
import Parallex from './components/Parallex'

Vue.use(VueRouter)

const routes = 
[
    {
        name:'login',
        component:Login,
        path:'/login',
    },
    {
        name:'signup',
        component:Signup,
        path:'/signup',
    },
    {
        name:'forum',
        component:Forum,
        path:'/forum',
    },
    {
        name:'logout',
        component:Logout,
        path:'/logout',
    },
    {
        name:'read',
        component:Read,
        path:'/question/:id',
    },
    {
        name:'category',
        component:Category,
        path:'/category',
    },
    {
        name:'ask',
        component:AskQuestion,
        path:'/ask',
    },
    {
        name:'parallex',
        component:Parallex,
        path:'/',
    },
]

const router = new VueRouter({
    mode:'history',
    routes
});

export default router;