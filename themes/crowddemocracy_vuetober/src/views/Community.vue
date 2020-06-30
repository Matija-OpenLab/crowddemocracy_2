<template>
  <div class="wrap">
    <NavbarPhones class="navbar-phones"></NavbarPhones>
    <b-container fluid class="content-wrap">
      <b-row class>
        <CommunityList></CommunityList>
        <b-col class="col .d-flex">
          <b-button class="logout mt-3" @click="logout" variant="danger">Odhlásenie z aplikácie</b-button>
          <b-row class="mt-5">
            <b-col class="community-pic mt-3 ml-2" cols="1">
              <img
                v-if="community.icon_id === '0'"
                class="community-pic"
                src="../assets/com-log1.png"
              />
              <img
                v-if="community.icon_id === '1'"
                class="community-pic"
                src="../assets/com-log2.png"
              />
              <img
                v-if="community.icon_id === '2'"
                class="community-pic"
                src="../assets/com-log3.png"
              />
            </b-col>
            <b-col>
              <a class="back-to-community" href="/home">Späť do zoznamu komunít</a>
              <h1 class="ml-4">{{ community.name }}</h1>
              <b-button
                variant="outline-secondary"
                class="leave-community"
                v-if="
                                    user.communities.some(
                                        comm => comm.id === community.id
                                    )
                                "
                @click="leaveCommunity(community.id)"
              >Opustiť komunitu</b-button>
              <b-button
                class="leave-community"
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
                            user.communities.some(
                                comm => comm.id === community.id
                            )
                        "
          >
            <div class="posts my-4 mr-4">
              <div class="post mt-4" v-for="post in communityPosts" :key="post.id">
                <p class="question-community mt-5">{{ post.content }}</p>
                <span class="voted-num mt-5">Zahlasovalo {{ post.total_votes }}</span>
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
import CommunityList from "../components/CommunityList.vue";

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
    NavbarPhones,
    CommunityList
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
}
/* horna cast kontentu - nazov, td */
.community-pic {
  width: 80px;
  height: auto;
}
.back-to-community {
  color: #9a9eaa;
  margin-top: 25px;
  margin-left: 25px;
}
.logout {
  background-color: #f3f5f8;
  border-color: #f3f5f8;
  color: #330066;
  margin-left: 780px;
  font-size: 15px;
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
.add-to-community {
  border-color: black;
  color: #48486e;
  background-color: white;
  width: 180px;
  font-weight: bold;
  font-size: 14px;
  margin-top: 50px;
}
.leave-community {
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
  text-align: center;
  margin: auto;
  transition: 1s;
}
.post:hover {
  -webkit-box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
  -moz-box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
  box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
}
.question-community {
  color: skyblue;
  font-size: 17px;
  padding: 20px 0 px;
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
  .left-navbar {
    display: none;
  }
  .logout {
    display: none;
  }
  .navbar {
    margin-top: 0px;
  }
  .logo {
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

