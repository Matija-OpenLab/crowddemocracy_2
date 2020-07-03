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
        async leaveCommunity({ commit }, communityId) {
            const url = `/api/v1/communities/leave/${communityId}`;
            try {
                await axios.post(url, {
                    token: this.state.token
                });
            } catch (err) {
                throw err;
            }
        },
        async createCommunity({ commit }, communityData) {
            try {
                await axios.post("/api/v1/communities/create", {
                    token: this.state.token,
                    name: communityData.name,
                    description: communityData.desc
                });
            } catch (err) {
                throw err;
            }
        },

        async deleteCommunity({ commit }, communityId) {
            try {
                await axios.post("/api/v1/communities/remove", {
                    token: this.state.token,
                    id: communityId
                });
            } catch (err) {
                throw err;
            }
        },
        async editCommunity({ commit }, communityData) {
            try {
                await axios.post("/api/v1/communities/edit", {
                    token: this.state.token,
                    id: communityData.id,
                    name: communityData.name,
                    description: communityData.desc
                });
            } catch (err) {
                throw err;
            }
        },

      async fetchCommunities({ commit }) {
          console.log("fetching comms")
            try {
                let resp = await axios.get("/api/v1/communities");
                commit("communities", resp.data);
            } catch (err) {
                throw err;
            }
        },
        async selectCommunity({ commit }, communityId) {
            try {
                let resp = await axios.get(
                    `/api/v1/communities/${communityId}`
                );
                commit("communitySelected", resp.data[0]);
            } catch (err) {
                throw err;
            }
        }
    }
};
