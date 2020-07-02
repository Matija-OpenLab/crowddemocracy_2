/* eslint-disable */
import axios from "axios";

export default {
    state: {
        communities: [],
        selectedCommunity: []
    },
    getters: {
        getCommunities: state => state.communities,
        getSelectedCommunity: state => state.selectedCommunity
    },
    mutations: {
        communities(state, communities) {
            state.communities = communities;
        },
        communitySelected(state, community) {
            state.selectedCommunity = community;
        }
    },
    actions: {
        async joinCommunity({ commit }, communityId) {
            const url = `/api/v1/communities/join/${communityId}`;
            const resp = await axios.post(url, {
                token: this.state.token
            });
        },
        leaveCommunity({ commit }, communityId) {
            const url = `/api/v1/communities/leave/${communityId}`;
            return axios
                .post(url, {
                    token: this.state.token
                })
                .then(() => {})
                .catch(err => {
                    throw err;
                });
        },
        createCommunity({ commit }, communityData) {
            return axios
                .post("/api/v1/communities/create", {
                    token: this.state.token,
                    name: communityData.name,
                    description: communityData.desc
                })
                .then(() => {})
                .catch(err => {
                    throw err;
                });
        },

        deleteCommunity({ commit }, communityId) {
            return axios
                .post("/api/v1/communities/remove", {
                    token: this.state.token,
                    id: communityId
                })
                .then(() => {})
                .catch(err => {
                    throw err;
                });
        },
        editCommunity({ commit }, communityData) {
            return axios
                .post("/api/v1/communities/edit", {
                    token: this.state.token,
                    id: communityData.id,
                    name: communityData.name,
                    description: communityData.desc
                })
                .then(() => {})
                .catch(err => {
                    throw err;
                });
        },

        async fetchCommunities({ commit }) {
            try {
                let resp = await axios.get("/api/v1/communities");
                commit("communities", resp.data);
            } catch (err) {
                throw err;
            }
        },
        selectCommunity({ commit }, communityId) {
            return axios
                .get(`/api/v1/communities/${communityId}`)
                .then(resp => {
                    commit("communitySelected", resp.data[0]);
                });
        }
    }
};
