/* eslint-disable */
import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        token: localStorage.getItem("token") || "",
        status: "",
        user: {}
    },
    mutations: {
        auth_request(state) {
            state.status = "loading";
        },
        auth_success(state, {
            token,
            user
        }) {
            state.status = "success";
            state.token = token;
            state.user = user;
        },
        auth_error(state) {
            state.status = "error";
        },
        logout(state) {
            state.status = "";
            state.token = "";
        },
        refresh(state, user) {
            state.user = user;
        },
        refresh_error(state) {
            state.status = "refresh error";
        }
    },
    actions: {
        login({
            commit
        }, user) {
            return new Promise((resolve, reject) => {
                commit("auth_request");
                axios({
                        url: "/api/login",
                        data: user,
                        method: "POST"
                    })
                    .then(resp => {
                        const token = resp.data.token;
                        const user = resp.data.user;
                        localStorage.setItem("token", token);
                        axios.defaults.headers.common["Authorization"] = token;
                        commit("auth_success", {
                            token,
                            user
                        });
                        resolve(resp);
                    })
                    .catch(err => {
                        commit("auth_error");
                        localStorage.removeItem("token");
                        reject(err);
                    });
            });
        },
        register({
            commit
        }, user) {
            return new Promise((resolve, reject) => {
                commit("auth_request");
                axios({
                        url: "/api/signup",
                        data: user,
                        method: "POST"
                    })
                    .then(resp => {
                        const token = resp.data.token;
                        const user = resp.data.user;
                        localStorage.setItem("token", token);
                        axios.defaults.headers.common["Authorization"] = token;
                        commit("auth_success", {
                            token,
                            user
                        });
                        resolve(resp);
                    })
                    .catch(err => {
                        commit("auth_error", err);
                        localStorage.removeItem("token");
                        reject(err);
                    });
            });
        },
        logout({
            commit
        }) {
            return new Promise((resolve, reject) => {
                commit("logout");
                localStorage.removeItem("token");
                delete axios.defaults.headers.common["Authorization"];
                resolve();
            });
        },
        refresh({
            commit
        }) {
            return new Promise((resolve, reject) => {
                axios({
                        url: "/api/token_refresh",
                        data: {
                            token: this.state.token
                        },
                        method: "POST"
                    })
                    .then(resp => {
                        const user = resp.data.user;
                        commit("refresh", user);
                        resolve(resp);
                    })
                    .catch(err => {
                        commit("refresh_error");
                        reject(err);
                    });
            });
        },
        vote({
            commit
        }, data) {
            console.log(data)
            const url = `/api/v1/likes/${data.vote}/${data.postId}`;
            return new Promise((resolve, reject) => {
                axios({
                        url: url,
                        data: {
                            token: this.state.token
                        },
                        method: "POST"
                    })
                    .then(resp => resolve(resp))
                    .catch(err => reject(err));
            });
        },
        removeVote({
            commit
        }, postId) {
            const url = `/api/v1/likes/remove_vote/${postId}`;
            return new Promise((resolve, reject) => {
                axios({
                        url: url,
                        data: {
                            token: this.state.token
                        },
                        method: "POST"
                    })
                    .then(resp => resolve(resp))
                    .catch(err => reject(err));
            });
        },
        joinCommunity({
            commit
        }, communityId) {
            const url = `/api/v1/communities/join/${communityId}`;
            return new Promise((resolve, reject) => {
                axios({
                        url: url,
                        data: {
                            token: this.state.token
                        },
                        method: "POST"
                    })
                    .then(resp => resolve(resp))
                    .catch(err => reject(err));
            });
        },
        leaveCommunity({
            commit
        }, communityId) {
            const url = `/api/v1/communities/leave/${communityId}`;
            return new Promise((resolve, reject) => {
                axios({
                        url: url,
                        data: {
                            token: this.state.token
                        },
                        method: "POST"
                    })
                    .then(resp => resolve(resp))
                    .catch(err => reject(err));
            });
        },
        createCommunity({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios({
                    url: "/api/v1/communities/create",
                    data: {
                        token: this.state.token,
                        name: data.name,
                        description: data.desc
                    },
                    method: "POST"
                }).then(resp => {
                    resolve(resp);
                }).catch(err => reject(err));
            })
        },
        createPost({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios({
                    url: "/api/v1/posts/create",
                    data: {
                        token: this.state.token,
                        content: data.content,
                        community_id: data.communityId
                    },
                    method: "POST"
                }).then(resp => {
                    resolve(resp);
                }).catch(err => reject(err));
            })
        },
        deleteCommunity({
            commit
        }, communityId) {
            return new Promise((resolve, reject) => {
                axios({
                    url: "/api/v1/communities/remove",
                    data: {
                        token: this.state.token,
                        id: communityId
                    },
                    method: "POST"
                }).then(resp => {
                    resolve(resp);
                }).catch(err => reject(err));
            })
        },
        deletePost({
            commit
        }, postId) {
            return new Promise((resolve, reject) => {
                axios({
                    url: "/api/v1/posts/remove",
                    data: {
                        token: this.state.token,
                        id: postId
                    },
                    method: "POST"
                }).then(resp => {
                    resolve(resp);
                }).catch(err => reject(err));
            })
        },

    },
    modules: {},
    plugins: [createPersistedState()],
    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
        getUserData: state => state.user
    }
});
