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
      <b-col class="communities" v-if="communities.length">
        <div v-for="community in communities" :key="community.id">
          <div class="community-wrap">
            <h4>{{community.name}}</h4>

            <div class="buttons">
              <b-button variant="danger" @click="deleteComm(community.id)">Vymazať</b-button>
              <b-button variant="dark">Upraviť</b-button>
              <b-button variant="success" @click="navigateToComm(community.id)">Príspevky</b-button>
            </div>
          </div>
        </div>
      </b-col>
      <b-col v-else>
        <h4 class="text-center">Nemas ziande komunity</h4>
      </b-col>
      <b-col>
        <img class="background" src="../assets/bg.png" />
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
    if (this.$store.getters.isLoggedIn && this.user.is_activated) {
      this.getCommunity();
    } else {
      this.$router.push("/support");
    }
  },
  methods: {
    //Getters
    getCommunity() {
      axios
        .get("/api/v1/communities")
        .then(res => {
          this.communities = res.data;
          this.ownedCommunities();
        })
        .catch(err => console.error(err));
    },

    //User data and navigation
    navigateToComm(communityId) {
      this.$router.push({
        path: `/manage_posts/${communityId}`
      });
    },
    ownedCommunities() {
      const owned = this.communities.filter(community => {
        return community.owner === this.user.name;
      });
      this.communities = owned;
    },

    //Community manipulation

    deleteComm(communityId) {
      this.$store
        .dispatch("deleteCommunity", communityId)
        .then(() => this.getCommunity())
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

.community-wrap {
  border: 1px solid black;
  width: 50%;
  padding: 1em;
  text-align: center;
  margin-top: 1em;
  margin-left: 15%;
  transition-duration: 250ms;
}
.community-wrap:hover {
  background-color: rgb(199, 199, 199);
  border: 1.5px solid black;
  padding: 1.3em;
  cursor: pointer;
}
.communities {
  margin-top: 8%;
}

.buttons {
  margin: 2em;
  margin-bottom: auto;
}
</style>