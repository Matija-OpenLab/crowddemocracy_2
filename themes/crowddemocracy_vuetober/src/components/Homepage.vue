<template>
  <div class="wrap">
    <b-row>
      <b-col cols="3">
        <img class="logo" src="../assets-dominika/logo.png" />
        <div class="your-com">
          <p class="com-list">Zoznam komunít,kde si členom:</p>
          <div class="names" v-for="(communitie, index) in communities" :key="index">
            <b-row>
              <b-col cols="1">
                <img class="com-logo-list" src="../assets-dominika/comlog.png" />
              </b-col>
              <b-col class="com-info">
                <p class="com-count-info">{{communitie.user_count}} užívateľov online</p>
                <p class="com-name-list">{{ communitie.name }}</p>
              </b-col>
            </b-row>
          </div>
        </div>
      </b-col>
      <b-col class="col" cols="8">
        <b-button class="logout" @click="logout" variant="danger">Odhlásenie z aplikácie</b-button>
        <b-row class="navbar">
          <b-col cols="1">
            <img class="homepage-pic" src="../assets-dominika/homepage.png" />
          </b-col>
          <b-col>
            <h1 class="welcome">Vitajte v CrowdDemocracy</h1>
            <p class="username">Vitaj {{user.name}}!</p>
          </b-col>
        </b-row>
        <div class="communities">
          <!--TENTO DIV JE CELA KOMUNITA-->
          <div
            class="communitie"
            @click="redirectToComm(index)"
            v-for="(community, index) in communities"
            :key="community.id"
          >
            <img class="com-logo" src="../assets-dominika/comlog.png" />
            <p class="com-count">{{ community.user_count }} užívateľov online</p>
            <p class="com-name">{{ community.name }}</p>
            <p class="com-owner">{{ community.owner }}</p>
            <p class="com-desc">{{ community.description }}</p>
            <p class="com-create">{{ community.created_at }}</p>
            <p class="com-moderators">IN DEVELOPMENT</p>
          </div>
        </div>
      </b-col>
    </b-row>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      communities: {}
    };
  },
  created() {
    if (this.$store.getters.isLoggedIn) {
      fetch("http://crowddemocracy.test/api/v1/communities")
        .then(res => res.json())
        .then(json => {
          this.communities = json;
        });
    } else {
      this.$router.push("/secure");
    }
  },
  methods: {
    redirectToComm(index) {
      this.$router.push({
        path: `/community/${index + 1}` //Datebase table starts at 1
      });
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
<style scoped>
.wrap {
  background-color: #f3f5f8;
  height: 100vh;
}
.logo {
  width: 120px;
  margin-left: 2em;
  margin-top: 10px;
}
.names {
  margin-bottom: 2em;
}
.com-name-list {
  font-weight: bold;
}
.com-info {
  margin-left: 2em;
}

.communities {
  display: flex;
  flex-wrap: wrap;
  /*width: 350px;*/
  margin: 0px;
}
.communitie {
  height: 290px;
  width: 290px;
  background-color: white;
  border-radius: 15px;
  cursor: pointer;
  margin-bottom: 2em;
  margin: 0.5em;
  transition: 1s;
}
.communitie:hover {
  -webkit-box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
  -moz-box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
  box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
}
.com-list {
  font-size: 15px;
  margin: 0px;
  margin-top: 40px;
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
