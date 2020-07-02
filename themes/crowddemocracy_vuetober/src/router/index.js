import Vue from 'vue';
import VueRouter from 'vue-router';
import Secure from '../views/Secure'

import VueGtag from "vue-gtag";

import store from "../store/index.js"


Vue.use(VueGtag, {
    config: {
        id: 'UA-167911991-1'
    },
}, router);


Vue.use(VueRouter);

const routes = [{
        path: '/',
        name: 'Intro',
        component: () => import('../views/Intro.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.isLoggedIn) { next({ name: 'Home' }); } else next();
          },
    },
    {
        path: '/registration',
        name: 'Registration',
        component: () => import('../views/Registration.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.isLoggedIn) { next({ name: 'Home' }); } else next();
          },
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../views/Login.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.isLoggedIn) { next({ name: 'Home' }); } else next();
          },
    },
    {
        path: '/home',
        name: 'Home',
        component: () => import('../views/Home.vue'),
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) { next({ name: 'Login' }); } else next();
          },
    },
    {
        path: '/community/:id',
        name: 'Community',
        component: () => import('../views/Community.vue'),
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
        component: () => import('../views/CommunityCreate.vue'),
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) { next({ name: 'Login' }); } else next();
          },
    },
    {
        path: '/manage',
        name: 'Manage',
        component: () => import('../views/CommunityManager.vue'),
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) { next({ name: 'Login' }); } else next();
          },
    },
    {
        path: '/manage_posts/:id',
        name: 'Manage_post',
        component: () => import('../views/PostManager.vue'),
        props: true,
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) { next({ name: 'Login' }); } else next();
          },
    },
    {
        path: '/support',
        name: 'Support',
        component: () => import('../views/Support.vue'),
        beforeEnter: (to, from, next) => {
            if (!store.getters.isLoggedIn) { next({ name: 'Login' }); } else next();
          },
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});


export default router;
