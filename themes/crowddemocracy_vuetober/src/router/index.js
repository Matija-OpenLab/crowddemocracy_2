import Vue from 'vue';
import VueRouter from 'vue-router';
import Intro from '../views/Intro';
import Registration from '../views/Registration';
import Login from '../views/Login';
import Home from '../views/Home';
import Secure from '../views/Secure'
import Community from '../views/Community';
import CommunityCreate from '../views/CommunityCreate';
import CommunityManager from '../views/CommunityManager';
import PostManager from '../views/PostManager';
import Support from '../views/Support';

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
        component: Home
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
        
    },
    {
        path: '/create',
        name: 'Create',
        component: CommunityCreate
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
