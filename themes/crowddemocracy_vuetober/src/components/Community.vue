<template>
  <div class="wrap">
    <NavbarPhones class="navbar-phones"></NavbarPhones>
    <b-container fluid class="content-wrap">
      <b-row>
        <b-col cols="3" class="left-navbar">
          <img class="logo ml-2 mt-3" src="../assets/logo.png" />
          <div class="your-com">
            <p class="com-list">Zoznam komunít,kde si členom:</p>
            <div class="names" v-for="community in communities" :key="community.id">
              <div
                v-if="
                                user.communities.some(
                                    comm => comm.id === community.id
                                )
                            "
              >
                <b-row @click="navigateToComm(community.id)" class="com-side">
                  <b-col cols="1">
                    <img
                      v-if="community.icon_id === '0'"
                      class="com-logo-list"
                      src="../assets/com-log1.png"
                    />
                    <img
                      v-if="community.icon_id === '1'"
                      class="com-logo-list"
                      src="../assets/com-log2.png"
                    />
                    <img
                      v-if="community.icon_id === '2'"
                      class="com-logo-list"
                      src="../assets/com-log3.png"
                    />
                  </b-col>
                  <b-col class="com-info">
                    <p class="com-count-info">{{ community.user_count }} užívateľov</p>
                    <p class="com-name-list">{{ community.name }}</p>
                  </b-col>
                </b-row>
              </div>
            </div>
          </div>
        </b-col>
        <b-col class="col">
          <b-button class="logout" @click="logout" variant="danger">Odhlásenie z aplikácie</b-button>
          <b-row class="navbar">
            <b-col class="com-pic" cols="1">
              <img v-if="community.icon_id === '0'" class="com-pic" src="../assets/com-log1.png" />
              <img v-if="community.icon_id === '1'" class="com-pic" src="../assets/com-log2.png" />
              <img v-if="community.icon_id === '2'" class="com-pic" src="../assets/com-log3.png" />
            </b-col>
            <b-col>
              <a class="back-to-com" href="/home">Späť do zoznamu komunít</a>
              <h1 class="com-name">{{ community.name }}</h1>
              <b-button
                variant="outline-secondary"
                class="leave-com"
                v-if="
                                user.communities.some(
                                    comm => comm.id === community.id
                                )
                            "
                @click="leaveCommunity(community.id)"
              >Opustiť komunitu</b-button>
              <b-button
                class="leave-com"
                variant="outline-secondary"
                v-else
                @click="joinCommunity(community.id)"
              >Pridaj sa</b-button>
            </b-col>
          </b-row>
          <b-row class="nav-row">
            <b-col>
              <b-button class="nav-button" @click="notVoted">Nehlasoval som</b-button>
            </b-col>
            <b-col>
              <b-button class="nav-button" @click="latest">Najnovšie</b-button>
            </b-col>
            <b-col>
              <b-button class="nav-button" @click="popular">Populárne</b-button>
            </b-col>
          </b-row>
          <div
            v-if="
                        user.communities.some(comm => comm.id === community.id)
                    "
          >
            <div class="posts">
              <div class="post" v-for="post in communityPosts" :key="post.id">
                <p class="question">{{ post.content }}</p>
                <span class="voted-num">Zahlasovalo {{ post.total_votes }}</span>
                <div
                  class="vote_buttons"
                  v-if="
                                    !user.likes.some(
                                        item => item.posts_id === post.id
                                    )
                                "
                >
                  <b-button
                    class="vote-yes"
                    variant="outline-success"
                    @click="addVote(post.id, 'vote_yes')"
                  >Áno</b-button>
                  <b-button
                    class="vote-no"
                    variant="outline-danger"
                    @click="addVote(post.id, 'vote_yes')"
                  >Nie</b-button>
                </div>
                <div v-else>
                  <b-button class="change-vote" @click="changeVote(post.id)">ZMENIŤ HLAS</b-button>
                </div>
              </div>
            </div>
          </div>
          <div v-else>
            <h4 class="text-center mt-5">Pridaj sa do komunity, aby si videl hlasovania</h4>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>
import axios from "axios";
import { mapGetters } from "vuex";
import NavbarPhones from "../components/NavbarPhones.vue";

export default {
  props: {
    id: {
      type: String
    }
  },
  data() {
    return {
      community: {},
      communityPosts: [],
      communities: [],
      lastSort: "latest"
    };
  },
  created() {
    if (this.$store.getters.isLoggedIn) {
      this.getCommunities();
    } else {
      this.$router.push("/secure");
    }
  },
  methods: {
    //Voting

    addVote(postId, vote) {
      this.$store
        .dispatch("vote", { vote: vote, postId: postId })
        .then(() => {
          this.refreshUser();
          this.getPosts();
        })
        .catch(err => console.error(err));
    },
    changeVote(postId) {
      this.$store
        .dispatch("removeVote", postId)
        .then(() => {
          this.refreshUser();
          this.getPosts();
        })
        .catch(err => console.error(err));
    },

    //Getters

    getCommunities() {
      axios.get("/api/v1/communities").then(resp => {
        this.communities = resp.data;
        this.getPosts();
        this.getCommunityName();
      });
    },
    getCommunityName() {
      axios.get(`/api/v1/communities/${this.$props.id}`).then(resp => {
        this.community = resp.data[0];
      });
    },
    getPosts() {
      axios
        .get(`/api/v1/posts/community_id/${this.$props.id}`)
        .then(resp => {
          this.communityPosts = resp.data.posts;

          //Keep posts sorted after refresh
          if (this.lastSort === "latest") {
            this.latest();
          } else if (this.lastSort === "notVoted") {
            this.notVoted();
          } else {
            this.popular();
          }
        })
        .catch(err => console.error(err));
    },

    //User actions and navigation

    logout() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push("/");
      });
    },

    refreshUser() {
      this.$store
        .dispatch("refresh")
        .then(() => {})
        .catch(err => {
          console.error(err);
        });
    },

    navigateToComm(community_id) {
      const path = `/community/${community_id}`;
      if (this.$route.path !== path) this.$router.push({ path: path });
    },

    joinCommunity(communityId) {
      this.$store
        .dispatch("joinCommunity", communityId)
        .then(() => {
          this.refreshUser();
        })
        .catch(err => console.error(err));
    },

    leaveCommunity(communityId) {
      this.$store
        .dispatch("leaveCommunity", communityId)
        .then(() => {
          this.refreshUser();
          this.$router.push("/home");
        })
        .catch(err => console.error(err));
    },

    //Sorters

    notVoted() {
      this.lastSort = "notVoted";
      const user = this.user;
      function compare(a) {
        if (user.likes.find(vote => parseInt(vote.posts_id) === parseInt(a.id)))
          return 1;
        return -1;
      }
      this.communityPosts.sort(compare);
    },

    latest() {
      this.lastSort = "latest";
      function compare(a, b) {
        const date = new Date(a.created_at);
        const date2 = new Date(b.created_at);
        if (date > date2) return -1;
        if (date2 > date) return 1;

        return 0;
      }
      this.communityPosts.sort(compare);
    },

    popular() {
      this.lastSort = "popular";
      function compare(a, b) {
        if (a.total_votes > b.total_votes) return -1;
        if (b.total_votes > a.total_votes) return 1;

        return 0;
      }
      this.communityPosts.sort(compare);
    }
  },
  computed: {
    ...mapGetters({
      user: "getUserData"
    })
  },
  beforeRouteUpdate(to, from, next) {
    this.getCommunities();
    next();
  },
  components: {
    NavbarPhones
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
.left-navbar {
  height: 100vh;
}
.logo {
  width: 120px;
}
/* horna cast kontentu - nazov, td */
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
.nav-button {
  background-color: #f3f5f8;
  border: none;
  color: #330066;
}
.nav-row {
  border-bottom: 1px solid #d7d7c1;
  text-align: center;
}
.add-to-com {
  border-color: black;
  color: #48486e;
  background-color: white;
  width: 180px;
  font-weight: bold;
  font-size: 14px;
  margin-top: 50px;
}
.leave-com {
  margin-left: 20px;
}
/* posts celok */
.posts {
  display: flex;
  flex-wrap: wrap;
  margin: 0px;
}
/* post */
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
.question {
  color: skyblue;
  font-size: 17px;
  padding: 20px 0 px;
  margin-top: 80px;
}
.change-vote {
  border-color: black;
  color: #48486e;
  background-color: white;
  width: 180px;
  font-weight: bold;
  font-size: 14px;
  margin-top: 50px;
}
.vote-yes {
  margin-top: 60px;
  width: 120px;
}
.vote-no {
  width: 120px;
  margin-top: 60px;
}
.voted-num {
  color: skyblue;
}
@media only screen and (max-width: 990px) {
  .logout {
    display: none;
  }
  .navbar {
    margin-top: 0px;
  }
  .logo {
    display: none;
  }
  .left-navbar {
    display: none;
  }
  .list {
    display: none;
  }
  .com-pic {
    display: none;
  }
  .post {
    margin: auto;
    margin-bottom: 2em;
    margin-top: 2em;
  }
  .welcome {
    margin-left: 0px;
  }
  .username {
    margin-left: 0px;
  }
  .nav-button {
    width: 2em;
  }
  .navbar-toggler {
    background-color: #7a5cc7;
  }
  .navbar-toggler:focus {
    outline: none;
  }
  .nav-link {
    color: black;
  }
  @media only screen and (max-width: 591px) {
    .nav-button {
      width: 1em;
    }
    .nav-row {
      text-align: left;
    }
  }
  @media only screen and (max-width: 310px) {
    .title {
      font-size: 2em;
    }
  }
}
</style>
