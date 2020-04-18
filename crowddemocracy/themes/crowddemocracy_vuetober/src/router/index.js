import Vue from 'vue';
import VueRouter from 'vue-router';
import Intro from '../components/Intro';
import Registration from '../components/Registration';
import Login from '../components/Login';
import Homepage from '../components/Homepage';
import Secure from '../components/Secure'
import Community from '../components/Community';

Vue.use(VueRouter);

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
    },
    {
        path: '/home',
        name: 'Home',
        component: Homepage
    },
    {
        path: '/community/:id',
        name: 'Community',
        component: Community,
        props: true
    },
    {
        path: '/secure',
        name: 'secure',
        component: Secure,
        meta: {
            requiresAuth: true
        }
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;
