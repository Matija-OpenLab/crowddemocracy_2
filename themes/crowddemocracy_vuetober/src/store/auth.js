import axios from 'axios';

export default {
  state: {
    status: '',
    token: localStorage.getItem('token') || '',
    user: JSON.parse(localStorage.getItem('user')) || {},
  },

  mutations: {
    authRequested(state) {
      state.status = 'loading';
    },
    authSucceeded(state, { token, user }) {
      localStorage.setItem('user', JSON.stringify(user));
      localStorage.setItem('token', token);
      // eslint-disable-next-line dot-notation
      axios.defaults.headers.common['Authorization'] = `Bearer ${
        token
      }`;
      state.status = 'success';
      state.token = token;
      state.user = user;
    },
    authFailed(state) {
      state.status = 'error';
    },
    authRevoked(state) {
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      delete axios.defaults.headers.common.Authorization;
      state.status = '';
      state.token = '';
      state.user = {};
      state.teachers = [];
      state.selectedTeacher = [];
    },
  },
  actions: {
    register({
      commit
  }, user) {
    commit("authRequested");
    return axios({
      url: "/api/signup",
      data: user,
      method: "POST"
  })
  .then(resp => {
      const token = resp.data.token;
      const user = resp.data.user;
      commit("authSucceeded", {
          token,
          user
      });
  })
  .catch(err => {
      commit("authFailed");
      commit("authRevoked");
      throw err;
  });
},
login({
commit
}, user) {
commit("authRequested");
return axios({
    url: "/api/login",
    data: user,
    method: "POST"
})
.then(resp => {
    const token = resp.data.token;
    const user = resp.data.user;
    commit("authSucceeded", {
        token,
        user
    });
})
.catch(err => {
    commit("authFailed");
    commit("authRevoked");
    throw err;
});
          

},
logout({
  commit,
  state
}) {
  return axios({url: "/api/invalidate", data: {token: state.token}, method: "POST"})
  .then(()=>{
    commit("authRevoked");
})
.catch(err => {
  commit("authRevoked");
  throw err;
})
},
  },
  getters: {
    isLoggedIn: (state) => !!state.token,
    getAuthStatus: (state) => state.status,
    getUserData: (state) => state.user,
  },
};
