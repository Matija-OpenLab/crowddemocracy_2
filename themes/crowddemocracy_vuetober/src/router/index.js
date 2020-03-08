import Vue from 'vue'
import VueRouter from 'vue-router'
import Intro from '../components/Intro'
import Registration from '../components/Registration'
import Login from '../components/Login'


Vue.use(VueRouter)

const routes = [{
        path: '/',
        name: 'Intro',
        component: Intro
    },
    {
        path: '/registration',
        name: 'Registration',
        component: Registration
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    }
]

const router = new VueRouter({
    routes
})

export default router
