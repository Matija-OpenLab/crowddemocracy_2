<template>
  <div class="wrap">
    <b-row>
      <b-col cols="3" class="list">
        <img class="logo" src="../assets-dominika/logo.png" />
        <div class="your-com">
          <p class="com-list">Zoznam komunít,kde si členom:</p>
          <div class="names" v-for="(community, index) in communities" :key="community.id">
            <b-row @click="redirectToComm(index)" class="com-side">
              <b-col cols="1">
                <img class="com-logo-list" src="../assets-dominika/comlog.png" />
              </b-col>
              <b-col class="com-info">
                <p class="com-count-info">{{ community.user_count }} užívateľov</p>
                <p class="com-name-list">{{ community.name }}</p>
              </b-col>
            </b-row>
          </div>
        </div>
      </b-col>
      <b-col class="col">
        <b-button class="logout" @click="logout" variant="danger">Odhlásenie z aplikácie</b-button>
        <b-row class="navbar">
          <b-col cols="1">
            <img class="com-pic" src="../assets-dominika/comlog.png" />
          </b-col>
          <b-col>
            <a class="back-to-com" href="/home">Späť do zoznamu komunít</a>
            <h1 class="com-name" v-bind="community">{{ community.name }}</h1>
          </b-col>
        </b-row>
        <b-row class="nav-row">
          <b-col>
            <b-button class="nav-button">Nehlasoval som</b-button>
          </b-col>
          <b-col>
            <b-button class="nav-button">Najnovšie</b-button>
          </b-col>
          <b-col>
            <b-button class="nav-button">Populárne</b-button>
          </b-col>
        </b-row>
        <div class="posts">
          <div class="post" v-for="post in communityPosts" :key="post.id">
            <h2 class="question">{{ post.content }}</h2>

            <div class="vote_buttons" v-if="!user.likes.some(item => item.id === post.id)">
              <button class="vote-yes" @click="addVote(post.id, 'like')">YES</button>
              <button class="vote_no" @click="addVote(post.id, 'something')">NO</button>
            </div>
            <div class="change_vote" v-else>
              <button @click="changeVote(post.id)">Change Vote</button>
            </div>
          </div>
        </div>
      </b-col>
    </b-row>
  </div>
</template>
<script>
import axios from "axios";
import { mapGetters } from "vuex";

export default {
  props: {
    id: {
      type: String
    }
  },
  data() {
    return {
      community: {},
      communityPosts: {},
      communities: {}
    };
  },
  created() {
    if (this.$store.getters.isLoggedIn) {
      fetch(`/api/v1/communities/${this.$props.id}`)
        .then(res => res.json())
        .then(json => {
          this.community = json[0];
        });
      fetch("/api/v1/communities")
        .then(res => res.json())
        .then(json => {
          this.communities = json;
        });
      this.getPosts();
    } else {
      this.$router.push("/secure");
    }
  },
  methods: {
    addVote(postId, vote) {
      axios.get(
        `http://crowddemocracy.test/api/v1/likes/${vote}/${this.user.id}/${postId}`
      );
      var vm = this;
      vm.getPosts();
    },
    getPosts() {
      axios
        .get(`/api/v1/posts/community_id/${this.$props.id}`)
        .then(res => {
          this.communityPosts = res.data;
        })
        .catch(err => console.error(err));
    },

    changeVote(/*postId*/) {
      //   const vote = this.voted.filter(item => item.id === postId)[0];
      console.log(this.user);
      //   axios.get(
      //     `http://crowddemocracy.test/api/v1/posts/${postId}/unvote_${vote.vote}`
      //   );
    },

    logout() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push("/");
      });
    },
    redirectToComm(index) {
      this.$router.push({
        path: `/community/${index + 1}` //Datebase table starts at 1
      });
    }
  },
  computed: {
    ...mapGetters({
      user: "getUserData"
    })
  }
};
</script>
<style lang="css" scoped>
.yes-count {
  display: inline;
  margin-right: 2em;
}
.wrap {
  background-color: #f3f5f8;
  height: 100vh;
  overflow-x: hidden;
}

/*STYLE ZOZNAMU KOMUNIT*/

.names {
  margin-bottom: 2em;
}
.com-name-list {
  font-weight: bold;
}
.com-info {
  margin-left: 2em;
}
.com-side {
  cursor: pointer;
}
.your-com {
  margin-left: 2em;
  margin-top: 40px;
}
.com-logo-list {
  width: 50px;
  height: auto;
}
.com-list {
  font-size: 15px;
  margin-top: 40px;
  margin-bottom: 20px;
  color: #9a9eaa;
}
.com-count-info {
  text-align: left;
  font-size: 13px;
  margin-bottom: 0px;
  color: #9a9eaa;
}

.list {
  border-right: 1px solid #d7d7c1;
}
.logo {
  width: 120px;
  margin-left: 2em;
  margin-top: 10px;
}
.navbar {
  margin-top: 40px;
}

.com-pic {
  width: 60px;
  height: auto;
  margin-left: 20px;
}
.back-to-com {
  color: #9a9eaa;
  margin-top: 25px;
  margin-left: 25px;
}
.logout {
  background-color: #f3f5f8;
  border-color: #f3f5f8;
  color: #330066;
  margin-left: 780px;
  margin-top: 25px;
  font-size: 15px;
}
.com-name {
  margin-left: 20px;
}
.question {
  margin: auto;
}
.nav-button {
  background-color: #f3f5f8;
  border-color: #f3f5f8;
  color: #330066;
}
.nav-row {
  border-bottom: 1px solid #d7d7c1;
  text-align: center;
}

/*Matija style + nieco z dominikinho*/
.posts {
  display: flex;
  flex-wrap: wrap;
  margin: 0px;
}
.post {
  height: 290px;
  width: 290px;
  background-color: white;
  border-radius: 15px;
  cursor: pointer;
  margin-bottom: 2em;
  margin-top: 2em;
  margin-right: 5em;
  text-align: center;
}
</style>
