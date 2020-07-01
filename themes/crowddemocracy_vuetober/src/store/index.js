/* eslint-disable */
import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import auth from "./auth";
import post from "./posts";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        communities: [],
        selectedCommunity: [],
    },
    mutations: {
        communitiesAdded(state, communities){
            state.communities = communities;
        },
        communitySelected(state, community){
            state.selectedCommunity = community;
        }
    },
    actions: {
        
        joinCommunity({
            commit
        }, communityId) {
            const url = `/api/v1/communities/join/${communityId}`;
                axios({
                        url: url,
                        data: {
                            token: this.state.token
                        },
                        method: "POST"
                    })
                    .then(() => {})
                    .catch(err => {throw err});
        },
        leaveCommunity({
            commit
        }, communityId) {
            const url = `/api/v1/communities/leave/${communityId}`;
                axios({
                        url: url,
                        data: {
                            token: this.state.token
                        },
                        method: "POST"
                    })
                    .then(() => {})
                    .catch(err => {throw err});
        },
        createCommunity({
            commit
        }, communityData) {
                axios({
                    url: "/api/v1/communities/create",
                    data: {
                        token: this.state.token,
                        name: communityData.name,
                        description: communityData.desc
                    },
                    method: "POST"
                }).then(() => {})
                .catch(err => {throw err});
        },
        
        deleteCommunity({
            commit
        }, communityId) {
                axios({
                    url: "/api/v1/communities/remove",
                    data: {
                        token: this.state.token,
                        id: communityId
                    },
                    method: "POST"
                }).then(() => {})
                .catch(err => {throw err});
        },
        editCommunity({
            commit
        }, communityData) {
                axios({
                    url: "/api/v1/communities/edit",
                    data: {
                        token: this.state.token,
                        id: communityData.id,
                        name: communityData.name,
                        description: communityData.desc
                    },
                    method: "POST"
                }).then(() => {})
                    .catch(err => {throw err});
        },
      
        fetchCommunities({commit, state}){
            return axios.get("/api/v1/communities").then(resp => {
                commit("communitiesAdded", resp.data)
              });
        },
        selectCommunity({commit}, communityId){
            return axios.get(`/api/v1/communities/${communityId}`).then(resp => {
                commit("communitySelected", resp.data[0])
            })
        },

    },
    modules: {auth, post},
    plugins: [createPersistedState()],
    getters: {
        getCommunities: (state) => state.communities,
        getSelectedCommunity: (state) => state.selectedCommunity
    }
});
