<template>
  <div class="wrap">
    <b-row>
      <b-col cols="3" class="list">
        <img class="logo" src="../assets-dominika/logo.png" />
        <div class="your-com">
          <p class="com-list">Zoznam komunít,kde si členom:</p>
          <div class="names" v-for="(communitie, index) in communities" :key="index">
            <b-row>
              <b-col col="1">
                <img class="com-logo-list" src="../assets-dominika/comlog.png" />
              </b-col>
              <b-col class="com-name-list">
                <p>{{ communitie.name }}</p>
              </b-col>
            </b-row>
          </div>
        </div>
      </b-col>
      <b-col cols="8">
        <b-button class="logout" to="/" variant="danger">Odhlásiť sa</b-button>
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

        <div class="posts" v-for="post in communityPosts" :key="post.id">
          <h2 class="question">{{ post.content }}</h2>

          <div class="vote_buttons" v-if="!voted.some(item => item.id === post.id)">
            <button class="vote-yes" @click="addVote(post.id, 'yes')">YES</button>
            <p class="yes-count">{{ post.vote_yes }}</p>

            <button class="vote_no" @click="addVote(post.id, 'no')">NO</button>
            <p class="yes-count">{{ post.vote_no }}</p>
          </div>
          <div v-else>
            <button @click="changeVote(post.id)">Change Vote</button>
          </div>
        </div>
      </b-col>
    </b-row>
  </div>
</template>
<script>
import axios from "axios";

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
      voted: []
    };
  },
  created() {
    if (this.$store.getters.isLoggedIn) {
      fetch(`http://crowddemocracy.test/api/v1/communities/${this.$props.id}`)
        .then(res => res.json())
        .then(json => {
          this.community = json[0];
        });
      this.getPosts();
    } else {
      this.$router.push("/secure");
    }
  },
  methods: {
    addVote(postId, vote) {
      this.voted.push({ id: postId, vote: vote });
      axios.get(
        `http://crowddemocracy.test/api/v1/posts/${postId}/vote_${vote}`
      );
      var vm = this;
      vm.getPosts();
    },
    getPosts() {
      axios
        .get(
          `http://crowddemocracy.test/api/v1/posts/community_id/${this.$props.id}`
        )
        .then(res => {
          this.communityPosts = res.data;
        });
    },
    changeVote(postId) {
      const vote = this.voted.filter(item => item.id === postId)[0];
      axios.get(
        `http://crowddemocracy.test/api/v1/posts/${postId}/unvote_${vote.vote}`
      );
      this.voted = this.voted.filter(item => item.id !== postId);
    },
    logout() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push("/");
      });
    }
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
  height: 1000px;
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
.com-list {
  font-size: 15px;
  margin: 0px;
  margin-top: 40px;
  color: #9a9eaa;
  margin-left: 2em;
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
.posts {
  height: 300px;
  width: 300px;
  background-color: white;
  border-radius: 15px;
  cursor: pointer;
  margin-bottom: 2em;
  margin-top: 40px;
  text-align: center;
  display: flex;
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
}
</style>
