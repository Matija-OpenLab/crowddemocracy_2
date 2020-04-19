<template>
  <div class="wrap">
    <b-row>
      <b-col cols="3" class="list">
        <img class="logo" src="../assets-dominika/logo.png" />
        <div class="your-com">
          <p class="com-list">Zoznam komunít,kde si členom:</p>
<<<<<<< HEAD
          <div class="names" v-for="(communitie, index) in communities" :key="index">
            <b-row>
              <b-col col="1">
                <img class="com-logo-list" src="../assets-dominika/comlog.png" />
              </b-col>
              <b-col class="com-name-list">
                <p>{{ communitie.name }}</p>
=======
          <div class="names" v-for="(community, index) in communities" :key="community.id">
            <b-row @click="redirectToComm(index)" class="com-side">
              <b-col cols="1">
                <img class="com-logo-list" src="../assets-dominika/comlog.png" />
              </b-col>
              <b-col class="com-info">
                <p class="com-count-info">{{ community.user_count }} užívateľov</p>
                <p class="com-name-list">{{ community.name }}</p>
>>>>>>> ca813b8dfc01ee95cae7c111c2c1dc4dc4c57c4c
              </b-col>
            </b-row>
          </div>
        </div>
      </b-col>
      <b-col cols="8">
<<<<<<< HEAD
        <b-button class="logout" to="/" variant="danger">Odhlásiť sa</b-button>
=======
        <b-button class="logout" @click="logout" variant="danger">Odhlásiť sa</b-button>
>>>>>>> ca813b8dfc01ee95cae7c111c2c1dc4dc4c57c4c
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

<<<<<<< HEAD
          <div class="vote_buttons" v-if="!voted.some(item => item.id === post.id)">
            <button class="vote-yes" @click="addVote(post.id, 'yes')">YES</button>
            <p class="yes-count">{{ post.vote_yes }}</p>

            <button class="vote_no" @click="addVote(post.id, 'no')">NO</button>
=======
          <div class="vote_buttons" v-if="!user.likes.some(item => item.id === post.id)">
            <button class="vote-yes" @click="addVote(post.id, 'like')">YES</button>
            <p class="yes-count">{{ post.vote_yes }}</p>

            <button class="vote_no" @click="addVote(post.id, 'something')">NO</button>
>>>>>>> ca813b8dfc01ee95cae7c111c2c1dc4dc4c57c4c
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
      fetch(`http://crowddemocracy.test/api/v1/communities/${this.$props.id}`)
        .then(res => res.json())
        .then(json => {
          this.community = json[0];
        });
      fetch("http://crowddemocracy.test/api/v1/communities")
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
        .get(
          `http://crowddemocracy.test/api/v1/posts/community_id/${this.$props.id}`
        )
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
<<<<<<< HEAD
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
=======
  height: 100vh;
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
>>>>>>> ca813b8dfc01ee95cae7c111c2c1dc4dc4c57c4c
.com-list {
  font-size: 15px;
  margin: 0px;
  margin-top: 40px;
  color: #9a9eaa;
  margin-left: 2em;
}
<<<<<<< HEAD
=======
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

>>>>>>> ca813b8dfc01ee95cae7c111c2c1dc4dc4c57c4c
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
<<<<<<< HEAD
  display: flex;
=======
>>>>>>> ca813b8dfc01ee95cae7c111c2c1dc4dc4c57c4c
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
