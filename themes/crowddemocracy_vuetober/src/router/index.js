import Vue from 'vue'
import VueRouter from 'vue-router'
import Intro from '../components/Intro'
import Registration from '../components/Registration'


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
    }
]

const router = new VueRouter({
    routes
})

export default router
