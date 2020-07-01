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

import store from "../store/index.js"


Vue.use(VueRouter);

const routes = [{
        path: '/',
        name: 'Intro',
        component: Intro,
        beforeEnter: (to, from, next) => {
            if (store.getters.isLoggedIn) { next({ name: 'Home' }); } else next();
          },
    },
    {
        path: '/registration',
        name: 'Registration',
        component: Registration,
        beforeEnter: (to, from, next) => {
            if (store.getters.isLoggedIn) { next({ name: 'Home' }); } else next();
          },
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        beforeEnter: (to, from, next) => {
            if (store.getters.isLoggedIn) { next({ name: 'Home' }); } else next();
          },
    },
    {
        path: '/home',
        name: 'Home',
        component: Home,
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) { next({ name: 'Login' }); } else next();
          },
    },
    {
        path: '/community/:id',
        name: 'Community',
        component: Community,
        props: true,
        beforeRouteUpdate(to, from, next) {
            this.$store.dispatch("selectCommunity", this.$props.id);
            this.$store.dispatch("fetchPosts", this.$props.id);
            next();
          },
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) { next({ name: 'Login' }); } else next();
          },
        
    },
    {
        path: '/secure',
        name: 'secure',
        component: Secure,
        
    },
    {
        path: '/create',
        name: 'Create',
        component: CommunityCreate,
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) { next({ name: 'Login' }); } else next();
          },
    },
    {
        path: '/manage',
        name: 'Manage',
        component: CommunityManager,
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) { next({ name: 'Login' }); } else next();
          },
    },
    {
        path: '/manage_posts/:id',
        name: 'Manage_post',
        component: PostManager,
        props: true,
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) { next({ name: 'Login' }); } else next();
          },
    },
    {
        path: '/support',
        name: 'Support',
        component: Support,
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) { next({ name: 'Login' }); } else next();
          },
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
