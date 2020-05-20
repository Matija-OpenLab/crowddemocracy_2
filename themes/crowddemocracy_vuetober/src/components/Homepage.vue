<template>
  <div class="wrap">
    <b-row>
      <b-col cols="3">
        <img class="logo" src="../assets/logo.png" />
        <div class="your-com">
          <p class="com-list">Zoznam komunít,kde si členom:</p>
          <div class="names" v-for="community in communities" :key="community.id">
            <div v-if="user.communities.some(comm => comm.id === community.id )">
              <b-row @click="navigateToComm(community.id)" class="com-side">
                <b-col cols="1">
                  <img class="com-logo-list" src="../assets/comlog.png" />
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
          <b-col cols="1">
            <img class="homepage-pic" src="../assets/homepage.png" />
          </b-col>
          <b-col>
            <h1 class="welcome">Vitajte v CrowdDemocracy</h1>
            <p class="username">Vitaj {{ user.name }}!</p>
          </b-col>
        </b-row>
        <div class="communities">
          <!--TENTO DIV JE CELA KOMUNITA-->
          <div class="community" v-for="community in communities" :key="community.id">
            <div @click="navigateToComm(community.id)">
              <img class="com-logo" src="../assets/comlog.png" />
              <p class="com-count">{{ community.user_count }} užívateľov</p>
              <p class="com-name">{{ community.name }}</p>
              <p class="com-owner">{{ community.owner }}</p>
              <p class="com-desc">{{ community.description }}</p>
              <p class="com-create">{{ community.created_at }}</p>
              <!-- <p class="com-moderators">IN DEVELOPMENT</p> -->
            </div>
            <b-button
              v-if="!user.communities.some(comm => comm.id === community.id )"
              @click="joinCommunity(community.id)"
            >Pridaj sa</b-button>
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
  data() {
    return {
      communities: []
    };
  },
  created() {
    if (this.$store.getters.isLoggedIn) {
      this.getCommunity();
    } else {
      this.$router.push("/secure");
    }
  },
  methods: {
    //User redirects

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
.wrap {
  background-color: #f3f5f8;
  height: 100%;
  width: 99vw;
  overflow-x: hidden;
}
.logo {
  width: 120px;
  margin-left: 2em;
  margin-top: 10px;
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
.communities {
  display: flex;
  flex-wrap: wrap;
  margin: 0px;
  margin-top: 40px;
  margin-left: 20px;
}
.community {
  height: 290px;
  width: 290px;
  background-color: white;
  border-radius: 15px;
  cursor: pointer;
  margin-right: 5em;
  margin-bottom: 2em;
  transition: 1s;
}
.communitie:hover {
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
  margin-left: 780px;
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
  border-right: 1px solid #d7d7c1;
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
}
.com-desc {
  text-align: center;
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
</style>
