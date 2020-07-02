<template>
  <div class="a-homepage">
    <NavbarPhones class="navbar-phones"></NavbarPhones>
    <b-container fluid class="content-wrap">
      <b-row>
        <CommunityList class="a-left-navbar"></CommunityList>
        <b-col class="col">
          <b-button class="logout mt-0" @click="logout" variant="danger">Odhlásenie z aplikácie</b-button>
          <b-row class="navbar mt-4">
            <b-col cols="1">
              <img class="homepage-pic" src="../assets/homepage.png" />
            </b-col>
            <b-col>
              <h1 class="welcome mt-1 ml-5">Vitajte v CrowdDemocracy</h1>
              <p class="username mb-2 ml-5">Vitaj {{ user.name }}!</p>
            </b-col>
          </b-row>
          <div class="communities mt-3 ml-1">
            <!--komunita div začiatok-->
            <div class="a-community mt-2 mb-3" v-for="community in communities" :key="community.id">
              <div @click="navigateToComm(community.id)">
                <img v-if="community.icon_id === '0'" class="logo" src="../assets/com-log1.png" />
                <img v-if="community.icon_id === '1'" class="logo" src="../assets/com-log2.png" />
                <img v-if="community.icon_id === '2'" class="logo" src="../assets/com-log3.png" />
                <p class="count mb-0 mt-3">{{ community.user_count }} užívateľov</p>
                <p class="name">{{ community.name }}</p>
                <div v-if="community.icon_id === '0'" class="desc color1">
                  <p class="small-desc">Popis komunity</p>
                  <p>{{ community.description }}</p>
                </div>
                <div v-if="community.icon_id === '1'" class="desc color2">
                  <p class="small-desc">Popis komunity</p>
                  <p>{{ community.description }}</p>
                </div>
                <div v-if="community.icon_id === '2'" class="desc color3">
                  <p class="small-desc">Popis komunity</p>
                  <p>{{ community.description }}</p>
                </div>
                <!-- <p class="com-create">{{ community.created_at.split(" ")[0] }}</p> -->

                <b-row>
                  <b-col cols="8">
                    <p
                      class="add-to-community"
                      v-if="
                                                !user.communities.some(
                                                    comm =>
                                                        comm.id === community.id
                                                )
                                            "
                      @click="joinCommunity(community.id)"
                    >+ pridaj sa do tejto komunity</p>
                  </b-col>
                  <b-col>
                    <p class="owner">{{ community.owner }}</p>
                  </b-col>
                </b-row>
              </div>
            </div>
            <!-- komunita koniec -->
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>
import { mapState, mapGetters } from "vuex";
import CommunityList from "../components/a-community-list.vue";
import NavbarPhones from "../components/a-navbar-phones";

export default {
  components: {
    NavbarPhones,
    CommunityList
  },

  computed: {
    ...mapState({
      communities: "communities"
    }),
    ...mapGetters({
      user: "getUserData"
    })
  },

  async mounted() {
    try {
      await this.$store.dispatch("fetchCommunities");
    } catch (err) {
      console.error(err);
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
    //Comm joining / leaving

    joinCommunity(communityId) {
      this.$store
        .dispatch("joinCommunity", communityId)
        .then(() => {
          //refresh user
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
          // this.refreshUser();
          this.$store.dispatch("getCommunities");
        })
        .catch(err => console.error(err));
    }
  }
};
</script>
<style lang="scss" scoped>
.a-homepage {
  background-color: #f3f5f8;
  width: 100vw;

  .logo {
    width: 120px;
  }
  .logout {
    background-color: #f3f5f8;
    border-color: #f3f5f8;
    color: #330066;
    margin-left: 77%;
    font-size: 15px;
  }
  .navbar {
    border-bottom: 1px solid #d7d7c1;
  }
  .welcome {
    font-size: 32px;
  }
  .username {
    font-size: 22px;
  }
  .communities {
    display: flex;
    flex-wrap: wrap;
    margin: 0px;
  }
  .homepage-pic {
    width: 120px;
    height: auto;
  }
}

.a-community {
  height: 19em;
  width: 290px;
  background-color: white;
  border-radius: 15px;
  cursor: pointer;
  margin: auto;
  transition: 1s;

  .small-desc {
    color: silver;
    font-size: 0.8em;
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
  .logo {
    width: 50px;
    height: auto;
    margin-top: -20px;
    margin-left: 125px;
  }
  .count {
    text-align: center;
    font-size: 13px;
    color: #9a9eaa;
  }
  .name {
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    border-bottom: 1px solid #d7d7c1;
  }
  .owner {
    text-align: center;
  }
  .desc {
    display: grid;
    text-align: center;
    height: 7em;
    border-bottom: 1px solid #d7d7c1;
  }
  &:hover {
    -webkit-box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
    -moz-box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
    box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
  }
}
.a-add-to-community {
  color: #c0c2ca;
  font-size: 0.8em;
  transition: 300ms;
  margin-top: 2em;
  &:hover {
    cursor: pointer;
    color: black;
  }
}

@media only screen and (max-width: 1020px) {
  .a-homepage {
    height: 100%;

    .homepage-pic {
      display: none;
    }
    .logout {
      display: none;
    }
    .communities {
      margin-left: 0px;
    }
    .welcome {
      margin-left: 0px;
    }
    .username {
      margin-left: 0px;
    }
  }
  .a-left-navbar {
    display: none;
  }
  .a-community {
    margin: auto;
    margin-bottom: 2em;
  }
  .navbar-toggler {
    background-color: #7a5cc7;
    &:focus {
      outline: none;
    }
  }
}
</style>
