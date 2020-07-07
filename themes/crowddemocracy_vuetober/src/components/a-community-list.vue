<template>
  <div class="a-left-navbar vh-100 p-0 z-bg-white d-none d-xl-block">
    <img class="logo ml-2 mt-3" src="../assets/logo.png" />
    <div class="ml-4 mt-5">
      <p class="list my-4">Zoznam komunít,kde si členom:</p>
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
              <img v-if="community.icon_id === '0'" class="logo-list" src="../assets/com-log2.png" />
              <img v-if="community.icon_id === '1'" class="logo-list" src="../assets/com-log2.png" />
              <img v-if="community.icon_id === '2'" class="logo-list" src="../assets/com-log2.png" />
            </b-col>
            <b-col class="ml-4">
              <p class="count-info mb-0">{{ community.user_count }} užívateľov</p>
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
import { mapGetters } from "vuex";

export default {
  methods: {
    navigateToComm(community_id) {
      const path = `/community/${community_id}`;
      if (this.$route.path !== path) this.$router.push({ path: path });
    }
  },

  computed: {
    ...mapGetters({
      communities: "getCommunities",
      user: "getUserData"
    })
  }
};
</script>
<style lang="scss" scoped>
.a-left-navbar {
  height: 100vh;
  border-right: 1px solid #d7d7c1;
  width: 20em;

  .logo {
    width: 120px;
  }
  .logo-list {
    width: 50px;
    height: auto;
  }
  .list {
    font-size: 15px;
    color: #9a9eaa;
  }
  .count-info {
    text-align: left;
    font-size: 13px;
    color: #9a9eaa;
  }
  .new-community-button {
    background-color: #24154b;
    color: white;
    width: 170px;
    line-height: 43px;
  }
}
@media only screen and (max-width: 1230px) {
  .a-left-navbar {
    display: none;
  }
}
</style>