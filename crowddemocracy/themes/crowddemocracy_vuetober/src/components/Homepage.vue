<template>
  <div class="wrap">
    <h1 class="username">Vítaj {{user.name}}</h1>
    <b-row>
      <b-col cols="3">
        <div class="tops">
          <h2>Top Komunity</h2>
          <div class="names" v-for="(communitie, index) in communities" :key="index">
            <h4>{{ communitie.name }}</h4>
          </div>
        </div>
      </b-col>
      <b-col cols="8">
        <b-button class="logout" @click="logout" variant="danger">Odhlásenie z aplikácie</b-button>
        <b-row class="navbar">
          <b-col cols="1">Logo</b-col>
          <b-col>
            <p class="com-list">Zoznam tvojich komunít</p>
            <h1 class="welcome">Vitajte v CrowdDemocracy</h1>
          </b-col>
        </b-row>
        <div class="communities" v-for="(community, index) in communities" :key="index">
          <!--TENTO DIV JE CELA KOMUNITA-->
          <div class="communitie" @click="redirectToComm(index)">
            <p class="com-count">{{ community.user_count }}</p>
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
.username {
  margin-bottom: 2em;
}
.wrap {
  background-color: #d6dbe0;
  height: 100vh;
}
.list {
  width: 150px;
}
.communitie {
  height: 250px;
  width: 250px;
  justify-content: space-evenly;
  background-color: white;
  border-radius: 15px;
  cursor: pointer;
  margin-bottom: 2em;
}
.com-name {
  text-align: center;
  font-size: 15px;
  font-weight: bold;
  margin: 0px;
}
.com-count {
  text-align: center;
  font-size: 11px;
  margin-bottom: 0px;
  margin-top: 25px;
}
.logout {
  background-color: #d6dbe0;
  border-color: #d6dbe0;
  color: #330066;
  margin-left: 780px;
  margin-top: 25px;
  font-size: 15px;
}
.navbar {
  margin-top: 30px;
}
.com-list {
  font-size: 15px;
  margin: 0px;
}
.welcome {
  margin-top: 10px;
  font-size: 32px;
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
</style>
