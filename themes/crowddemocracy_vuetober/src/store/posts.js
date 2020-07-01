/* eslint-disable */
import axios from 'axios';

export default {
  state: {
    posts: []
  },

  mutations: {
    postsAdded(state, posts){
      state.posts = posts;
    },
  },
  actions: {
    vote({
      commit
  }, postData) {
      const url = `/api/v1/likes/${postData.vote}/${postData.postId}`;

          return axios({
                  url: url,
                  data: {
                      token: this.state.token
                  },
                  method: "POST"
              })
              .then(() => {
              })
              .catch(err => {throw err});
  },
  removeVote({
    commit
}, postId) {
    const url = `/api/v1/likes/remove_vote/${postId}`;
        return axios({
                url: url,
                data: {
                    token: this.state.token
                },
                method: "POST"
            })
            .then(() => {})
            .catch(err => {throw err;});
},
createPost({
  commit
}, postData) {
      axios({
          url: "/api/v1/posts/create",
          data: {
              token: this.state.token,
              content: postData.content,
              community_id: postData.communityId
          },
          method: "POST"
      }).then(() => {})
        .catch(err => {throw err});
},
deletePost({
  commit
}, postId) {
      axios({
          url: "/api/v1/posts/remove",
          data: {
              token: this.state.token,
              id: postId
          },
          method: "POST"
      }).then(() => {})
      .catch(err => {throw err});
},
finishPost({
  commit
}, postId) {
      axios({
          url: "/api/v1/posts/finish",
          data: {
              token: this.state.token,
              id: postId
          },
          method: "POST"
      }).then(() => {})
      .catch(err => {throw err});
},
fetchPosts({commit}, communityId){
  axios.get(`/api/v1/posts/community_id/${communityId}`).then(resp => {
    commit("postsAdded", resp.data.posts)
  })
}
  },
  getters: {
    getPosts: (state) => state.posts
  },
};
