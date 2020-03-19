import Vue from "vue";
import App from "./App.vue";

import { BootstrapVue } from "bootstrap-vue";

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import router from "./router";
import Vuelidate from "vuelidate";

import { ValidationProvider } from "vee-validate";

// Register it globally
// main.js or any entry file.
Vue.component("ValidationProvider", ValidationProvider);

Vue.use(BootstrapVue);
Vue.use(Vuelidate);
Vue.config.productionTip = false;

new Vue({
    router,
    render: h => h(App)
}).$mount("#app");
