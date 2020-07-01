<template>
  <div class="a-left-navbar vh-100 p-0 z-bg-white d-none d-xl-block">
    <img class="logo ml-2 mt-3" src="../assets/logo.png" />
    <div class="ml-4 mt-5">
      <p class="community-list my-4">Zoznam komunít,kde si členom:</p>
      <div class="mt-3" v-for="community in communities" :key="community.id">
        <div
          v-if="
                                user.communities.some(
                                    comm => comm.id === community.id
                                )
                            "
        >
          <b-row @click="navigateToComm(community.id)" class="community-side">
            <b-col cols="1">
              <img
                v-if="community.icon_id === '0'"
                class="community-logo-list"
                src="../assets/com-log2.png"
              />
              <img
                v-if="community.icon_id === '1'"
                class="community-logo-list"
                src="../assets/com-log2.png"
              />
              <img
                v-if="community.icon_id === '2'"
                class="community-logo-list"
                src="../assets/com-log2.png"
              />
            </b-col>
            <b-col class="ml-4">
              <p class="community-count-info mb-0">{{ community.user_count }} užívateľov</p>
              <p class="z-bold">{{ community.name }}</p>
            </b-col>
          </b-row>
        </div>
      </div>
      <div class="d-flex">
        <b-button
          v-if="user.is_activated"
          class="new-community-button mx-auto text-center"
          to="/create"
        >Nová komunita</b-button>
        <b-button
          v-else
          class="new-community-button mx-auto text-center"
          to="/support"
        >Staň sa testerom</b-button>
      </div>
    </div>
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
    this.getCommunities();
  },
  methods: {
    getCommunities() {
      axios.get("/api/v1/communities").then(resp => {
        this.communities = resp.data;
      });
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
  }
};
</script>
<style lang="scss" scoped>
.new-community-button {
  background-color: #24154b;
  color: white;
  width: 170px;
  line-height: 43px;
}
.community-side {
  cursor: pointer;
}
.community-logo-list {
  width: 50px;
  height: auto;
}
.community-list {
  font-size: 15px;
  color: #9a9eaa;
}
.community-count-info {
  text-align: left;
  font-size: 13px;
  color: #9a9eaa;
}
.a-left-navbar {
  height: 100vh;
  border-right: 1px solid #d7d7c1;
  width: 20em;
}
.logo {
  width: 120px;
}
</style>