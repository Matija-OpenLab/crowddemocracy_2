import Vue from 'vue';

import {
    BootstrapVue
} from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";


import Axios from 'axios';

Vue.use(BootstrapVue);
Vue.config.productionTip = false;

export function created(router, store) {
    const token = localStorage.getItem('token');
    if (token) {
        // eslint-disable-next-line dot-notation
        Axios.defaults.headers.common['Authorization'] = `Bearer ${
      token
    }`;
    }

    Axios.interceptors.response.use(
        (response) => response,
        (error) => {
            if ((error.response.status === 401 && error.response.data.error === 'token_expired') ||
                (error.response.status === 400 && error.response.data.error === 'token_invalid')) {
                store.dispatch('logout').finally(() => router.push('/'));
            }
            return Promise.reject(error);
        },
    );
}
