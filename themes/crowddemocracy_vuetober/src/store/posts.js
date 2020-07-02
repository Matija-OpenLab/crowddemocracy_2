/* eslint-disable */
import axios from "axios";

export default {
    state: {
        posts: []
    },
    getters: {
        getPosts: state => state.posts
    },
    mutations: {
      posts(state, posts) {
            state.posts = posts;
        }
    },
    actions: {
        vote({ commit }, postData) {
            const url = `/api/v1/likes/${postData.vote}/${postData.postId}`;

            return axios
                .post(url, {
                    token: this.state.token
                })
                .then(() => {})
                .catch(err => {
                    throw err;
                });
        },
        removeVote({ commit }, postId) {
            const url = `/api/v1/likes/remove_vote/${postId}`;
            return axios
                .post(url, {
                    token: this.state.token
                })
                .then(() => {})
                .catch(err => {
                    throw err;
                });
        },
        createPost({ commit }, postData) {
            return axios
                .post("/api/v1/posts/create", {
                    token: this.state.token,
                    content: postData.content,
                    community_id: postData.communityId
                })
                .then(() => {})
                .catch(err => {
                    throw err;
                });
        },
        deletePost({ commit }, postId) {
            return axios
                .post("/api/v1/posts/remove", {
                    token: this.state.token,
                    id: postId
                })
                .then(() => {})
                .catch(err => {
                    throw err;
                });
        },
        finishPost({ commit }, postId) {
            return axios
                .post("/api/v1/posts/finish", {
                    token: this.state.token,
                    id: postId
                })
                .then(() => {})
                .catch(err => {
                    throw err;
                });
        },
        async fetchPosts({ commit }, communityId) {
            try {
                let resp = await axios.get(
                    `/api/v1/posts/community_id/${communityId}`
                );
                commit("posts", resp.data.posts);
            } catch (err) {
                throw err;
            }
        }
    }
};
