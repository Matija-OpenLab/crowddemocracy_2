/* eslint-disable */
import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import auth from "./auth";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        communities: [],
        selectedCommunity: [],
        communityPosts: []
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
        }, postData) {
            const url = `/api/v1/likes/${postData.vote}/${postData.postId}`;
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
        }, communityData) {
            return new Promise((resolve, reject) => {
                axios({
                    url: "/api/v1/communities/create",
                    data: {
                        token: this.state.token,
                        name: communityData.name,
                        description: communityData.desc
                    },
                    method: "POST"
                }).then(resp => {
                    resolve(resp);
                }).catch(err => reject(err));
            })
        },
        createPost({
            commit
        }, postData) {
            return new Promise((resolve, reject) => {
                axios({
                    url: "/api/v1/posts/create",
                    data: {
                        token: this.state.token,
                        content: postData.content,
                        community_id: postData.communityId
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
        editCommunity({
            commit
        }, communityData) {
            return new Promise((resolve, reject) => {
                axios({
                    url: "/api/v1/communities/edit",
                    data: {
                        token: this.state.token,
                        id: communityData.id,
                        name: communityData.name,
                        description: communityData.desc
                    },
                    method: "POST"
                }).then(resp => {
                    resolve(resp);
                }).catch(err => {
                    reject(err)
                })
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
        finishPost({
            commit
        }, postId) {
            return new Promise((resolve, reject) => {
                axios({
                    url: "/api/v1/posts/finish",
                    data: {
                        token: this.state.token,
                        id: postId
                    },
                    method: "POST"
                }).then(resp => {
                    resolve(resp);
                }).catch(err => reject(err));
            })
        }

    },
    modules: {auth},
    plugins: [createPersistedState()],
    getters: {}
});
