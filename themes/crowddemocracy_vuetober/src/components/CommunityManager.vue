<template>
  <div class="wrap">
    <b-row>
      <b-col cols="11">
        <p class="title">Tvoje komunity</p>
      </b-col>
      <b-col cols="1">
        <b-button to="/create" variant="danger" class="back-button">Späť</b-button>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="communities">
        <div
          class="community"
          v-for="community in communities"
          :key="community.id"
          @click="navigateToComm(community.id)"
        >
          <h4>{{community.name}}</h4>
        </div>
      </b-col>
      <b-col>
        <img class="background" src="../assets/bg.png" />
      </b-col>
    </b-row>
  </div>
</template>
<script>
import axios from "axios";
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
    //Getters
    getCommunity() {
      axios.get("/api/v1/communities").then(res => {
        this.communities = res.data;
      });
    },

    //User navigation
    navigateToComm(community_id) {
      this.$router.push({
        path: `/manage_posts/${community_id}`
      });
    }
  }
};
</script>
<style lang="css" scoped>
.wrap {
  overflow-x: hidden;
}
.back-button {
  width: 100%;
  margin-top: 30px;
  margin-left: -80px;
  border-color: #48486e;
  color: #48486e;
  background-color: white;
}
.title {
  margin: 0.3em;
  margin-left: 110px;
  font-size: 50px;
  font-weight: 50;
  color: #48486e;
}
.background {
  max-width: 100%;
  height: auto;
  background-repeat: no-repeat;
  right: 0;
}
.community {
  border: 1px solid black;
  text-align: center;
  width: 50%;
  margin-top: 1em;
  margin-left: 15%;
  padding: 1em;
  transition-duration: 250ms;
}
.communities {
  margin-top: 8%;
}
.community:hover {
  background-color: rgb(189, 255, 199);
  border: 1.5px solid green;
  width: 55%;
  padding: 1.3em;
  cursor: pointer;
}
</style>