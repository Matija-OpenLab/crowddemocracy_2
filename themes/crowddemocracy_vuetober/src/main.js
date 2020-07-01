import Vue from "vue";
import App from "./App.vue";


import router from "./router";
import store from './store'



import custom from "./custom";

custom.setup();

new Vue({
    router,
    store,
    render: h => h(App),
    created() {
        custom.created(router, store);
    },
}).$mount("#app");
