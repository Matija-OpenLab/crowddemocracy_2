/* eslint-disable */
import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import auth from "./auth";
import posts from "./posts";
import communities from "./communities";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: { communities, posts, auth},
    plugins: [createPersistedState()],
    state: {
    },
    mutations: {
        
    },
    actions: {
        
    }
});
