import Vue from 'vue';
import VueRouter from 'vue-router';
import Intro from '../components/Intro';
import Registration from '../components/Registration';
import Login from '../components/Login';
import Homepage from '../components/Homepage';
import Secure from '../components/Secure'
import Community from '../components/Community';
import CommunityCreator from '../components/CommunityCreator';
import CommunityManager from '../components/CommunityManager';
import PostManager from '../components/PostManager';
import Support from '../components/Support';

import VueGtag from "vue-gtag";


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
    {
        path: '/create',
        name: 'Create',
        component: CommunityCreator
    },
    {
        path: '/manage',
        name: 'Manage',
        component: CommunityManager
    },
    {
        path: '/manage_posts/:id',
        name: 'Manage_post',
        component: PostManager,
        props: true
    },
    {
        path: '/support',
        name: 'Support',
        component: Support
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.use(VueGtag, {
    config: {
        id: 'UA-167911991-1'
    },
}, router);

export default router;
