import Vue from "vue";

import { BootstrapVue } from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

import SmartlookClient from "smartlook-client";

import Axios from "axios";
import router from "./router";

import VueGtag from "vue-gtag";

import VueSimpleAlert from "vue-simple-alert";

import { ValidationProvider, setInteractionMode, extend } from "vee-validate";
import { required, max, email, confirmed } from "vee-validate/dist/rules";

const custom = {
    setup() {
        Vue.use(VueSimpleAlert);
        Vue.use(BootstrapVue);
        Vue.config.productionTip = false;

        Vue.use(VueGtag, {
            config: {
                id: "UA-167911991-1"
            },
            router
        });
        /*Validatoin*/
        extend("required", {
            ...required,
            message: "Pole nesmie byť prázdne!"
        });
        extend("email", {
            ...email,
            message: "Nesprávny formát emailu!"
        });
        extend("max", {
            ...max,
            message: "Užívateľské meno nesmie byť dlhšie ako 16 znakov"
        });
        extend("confirmed", {
            ...confirmed,
            message: "Heslo sa musí zhodovať"
        });

        extend("password_verification", {
            validate(value, { min, max }) {
                const passRegex = new RegExp(
                    `^(?=.*)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{${min},${max}}`
                );
                return passRegex.test(value);
            },
            params: ["min", "max"],
            message:
                "Heslo musí obsahovať minimálne {min} znakov, najviac {max} znakov, obsahovať aspoň jedno veľké písmeno a jedno číslo."
        });
        setInteractionMode("eager");
        Vue.component("ValidationProvider", ValidationProvider);
    },
    created(router, store) {
        const token = localStorage.getItem("token");
        if (token) {
            // eslint-disable-next-line dot-notation
            Axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
        }
        SmartlookClient.init("7aef07e493ad00a909ba2921ff24627dad9ca8ff");
        Axios.interceptors.response.use(
            response => response,
            error => {
                if (
                    (error.response.status === 401 &&
                        error.response.data.error === "token_expired") ||
                    (error.response.status === 400 &&
                        error.response.data.error === "token_invalid")
                ) {
                    store.dispatch("logout").finally(() => router.push("/"));
                }
                return Promise.reject(error);
            }
        );
    }
};
export default custom;
