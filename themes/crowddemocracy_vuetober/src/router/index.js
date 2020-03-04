import Vue from 'vue'
import VueRouter from 'vue-router'
import Intro from '../components/Intro'

Vue.use(VueRouter)

const routes = [{
    path: '/',
    name: 'Intro',
    component: Intro
}]

const router = new VueRouter({
    routes
})

export default router
