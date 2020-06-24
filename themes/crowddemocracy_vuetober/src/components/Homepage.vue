<template>
  <div class="wrap">
    <b-row>
      <b-col class="left-navbar" cols="3">
        <img class="logo" src="../assets/logo.png" />
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
          <b-button v-if="user.is_activated" class="new-community-button" to="/create">Nová komunita</b-button>
          <b-button v-else class="new-community-button" to="/support">Staň sa testerom</b-button>
        </div>
      </b-col>
      <b-col class="col">
        <b-button class="logout" @click="logout" variant="danger">Odhlásenie z aplikácie</b-button>
        <b-row class="navbar">
          <b-col cols="1">
            <img class="homepage-pic" src="../assets/homepage.png" />
          </b-col>
          <b-col>
            <h1 class="welcome">Vitajte v CrowdDemocracy</h1>
            <p class="username">Vitaj {{ user.name }}!</p>
          </b-col>
        </b-row>
        <div class="communities">
          <!--komunita div začiatok-->
          <div class="community" v-for="community in communities" :key="community.id">
            <div @click="navigateToComm(community.id)">
              <!-- napicu ale cenim ze to musim robit ja -Matija <3 -->
              <img v-if="community.icon_id === '0'" class="com-logo" src="../assets/com-log1.png" />
              <img v-if="community.icon_id === '1'" class="com-logo" src="../assets/com-log2.png" />
              <img v-if="community.icon_id === '2'" class="com-logo" src="../assets/com-log3.png" />
              <p class="com-count">{{ community.user_count }} užívateľov</p>
              <p class="com-name">{{ community.name }}</p>
              <div v-if="community.icon_id === '0'" class="com-desc color1">
                <p class="small-desc">Popis komunity</p>
                <p>{{ community.description }}</p>
              </div>
              <div v-if="community.icon_id === '1'" class="com-desc color2">
                <p class="small-desc">Popis komunity</p>
                <p>{{ community.description }}</p>
              </div>
              <div v-if="community.icon_id === '2'" class="com-desc color3">
                <p class="small-desc">Popis komunity</p>
                <p>{{ community.description }}</p>
              </div>
              <!-- <p class="com-create">{{ community.created_at.split(" ")[0] }}</p> -->

              <b-row class="com-footer">
                <b-col cols="8">
                  <p
                    class="add-to-com"
                    v-if="
                                            !user.communities.some(
                                                comm => comm.id === community.id
                                            )
                                        "
                    @click="joinCommunity(community.id)"
                  >+ pridaj sa do tejto komunity</p>
                </b-col>
                <b-col>
                  <p class="com-owner">{{ community.owner }}</p>
                </b-col>
              </b-row>
            </div>
          </div>
          <!-- komunita koniec -->
        </div>
      </b-col>
    </b-row>
  </div>
</template>
<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      communities: []
    };
  },
  created() {
    if (this.$store.getters.isLoggedIn) {
      this.getCommunity();
      this.refreshUser();
    } else {
      this.$router.push("/secure");
    }
  },
  methods: {
    //User navigation

    navigateToComm(community_id) {
      this.$router.push({
        path: `/community/${community_id}`
      });
    },

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

    //Getters
    getCommunity() {
      axios.get("/api/v1/communities").then(res => {
        this.communities = res.data;
      });
    },

    //Comm joining

    joinCommunity(communityId) {
      this.$store
        .dispatch("joinCommunity", communityId)
        .then(() => {
          this.refreshUser();
          this.$router.push({
            path: `/community/${communityId}`
          });
        })
        .catch(err => console.error(err));
    },
    leaveCommunity(communityId) {
      this.$store
        .dispatch("leaveCommunity", communityId)
        .then(() => {
          this.refreshUser();
          this.getCommunity();
          console.log(this.user);
        })
        .catch(err => console.error(err));
    }
  },
  computed: {
    ...mapGetters({
      user: "getUserData"
    })
  }
};
</script>
<style scoped>
.small-desc {
  color: silver;
  font-size: 0.8em;
}
.wrap {
  background-color: #f3f5f8;
  height: 100%;
  width: 100vw;
  overflow-x: hidden;
}
.logo {
  width: 120px;
  margin-left: 2em;
  margin-top: 10px;
}
.color1 {
  color: #c74079;
}
.color2 {
  color: #80ae29;
}
.color3 {
  color: #4890a9;
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
/* komunity-celkovo */
.communities {
  display: flex;
  flex-wrap: wrap;
  margin: 0px;
  margin-top: 40px;
  margin-left: 20px;
}
/* styl jednej komunity */
.community {
  height: 19em;
  width: 290px;
  background-color: white;
  border-radius: 15px;
  cursor: pointer;
  margin-right: 5em;
  margin-bottom: 2em;
  transition: 1s;
}
.community:hover {
  -webkit-box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
  -moz-box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
  box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
}
.com-list {
  font-size: 15px;
  margin-top: 40px;
  margin-bottom: 20px;
  color: #9a9eaa;
}

.com-logo-list {
  width: 50px;
  height: auto;
}
.com-logo-list {
  left: 0px;
}
.com-logo {
  width: 50px;
  height: auto;
  margin-top: -20px;
  margin-left: 125px;
}

.com-count-info {
  text-align: left;
  font-size: 13px;
  margin-bottom: 0px;
  color: #9a9eaa;
}

.com-count {
  text-align: center;
  font-size: 13px;
  margin-bottom: 0px;
  margin-top: 20px;
  color: #9a9eaa;
}
.com-name {
  text-align: center;
  font-size: 18px;
  font-weight: bold;
  margin-top: 3px;
  border-bottom: 1px solid #d7d7c1;
}
.logout {
  background-color: #f3f5f8;
  border-color: #f3f5f8;
  color: #330066;
  margin-left: 77%;
  margin-top: 25px;
  font-size: 15px;
}
.navbar {
  margin-top: 30px;
  border-bottom: 1px solid #d7d7c1;
}

.your-com {
  margin-left: 2em;
  margin-top: 40px;
}
.welcome {
  margin-top: 10px;
  font-size: 32px;
  margin-left: 50px;
}
.username {
  margin-bottom: 2em;
  margin-left: 53px;
  font-size: 22px;
}
.com-owner {
  text-align: center;
  /* margin-top: 1em; */
}
.com-desc {
  display: grid;
  text-align: center;
  height: 7em;
  border-bottom: 1px solid #d7d7c1;
}
.com-create {
  text-align: center;
}
.com-moderators {
  text-align: center;
}
.homepage-pic {
  width: 120px;
  height: auto;
}
.add-to-com {
  color: #c0c2ca;
  font-size: 0.8em;
  transition: 300ms;
  margin-top: 2em;
}
.add-to-com:hover {
  cursor: pointer;
  color: black;
}

.left-navbar {
  padding: 0px;
  border-right: 1px solid #d7d7c1;
}
.new-community-button {
  background-color: #24154b;
  color: white;
  width: 170px;
  line-height: 43px;
  margin-left: 23%;
}
@media only screen and (min-width: 1020px) {
  .navbar-phones {
    display: none;
  }
}
@media only screen and (max-width: 1020px) {
  .navbar-phones {
    margin-top: 0px;
    background-color: #b3b3e6;
  }
  .logo-navbar {
    height: 2em;
  }
  .logo {
    display: none;
  }
  .left-navbar {
    display: none;
  }
  .logout {
    display: none;
  }
  .homepage-pic {
    display: none;
  }
  .community {
    margin: auto;
    margin-bottom: 2em;
  }
  .communities {
    margin-left: 0px;
  }
  .navbar-toggler {
    background-color: #7a5cc7;
  }
  .navbar-toggler:focus {
    outline: none;
  }
  .welcome {
    margin-left: 0px;
  }
  .username {
    margin-left: 0px;
  }
  .nav-link {
    color: black;
  }
}
</style>
