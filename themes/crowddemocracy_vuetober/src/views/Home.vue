<template>
  <div class="wrap">
    <NavbarPhones class="navbar-phones"></NavbarPhones>
    <b-container fluid class="content-wrap">
      <b-row>
        <CommunityList></CommunityList>
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
            <div class="community mt-2 mb-3" v-for="community in communities" :key="community.id">
              <div @click="navigateToComm(community.id)">
                <img
                  v-if="community.icon_id === '0'"
                  class="community-logo"
                  src="../assets/com-log1.png"
                />
                <img
                  v-if="community.icon_id === '1'"
                  class="community-logo"
                  src="../assets/com-log2.png"
                />
                <img
                  v-if="community.icon_id === '2'"
                  class="community-logo"
                  src="../assets/com-log3.png"
                />-->
                <p class="count mb-0 mt-3">{{ community.user_count }} užívateľov</p>
                <p class="name z-bold z-center">{{ community.name }}</p>
                <div v-if="community.icon_id === '0'" class="desc z-center color2">
                  <p class="small-desc">Popis komunity</p>
                  <p>{{ community.description }}</p>
                </div>
                <div v-if="community.icon_id === '1'" class="desc z-center color2">
                  <p class="small-desc">Popis komunity</p>
                  <p>{{ community.description }}</p>
                </div>
                <div v-if="community.icon_id === '2'" class="desc z-center color3">
                  <p class="small-desc">Popis komunity</p>
                  <p>{{ community.description }}</p>
                </div>
                <!-- <p class="com-create">{{ community.created_at.split(" ")[0] }}</p> -->

                <b-row class="community-footer">
                  <b-col cols="8">
                    <p
                      class="add-to-community"
                      v-if="
                                            !user.communities.some(
                                                comm => comm.id === community.id
                                            )
                                        "
                      @click="joinCommunity(community.id)"
                    >+ pridaj sa do tejto komunity</p>
                  </b-col>
                  <b-col>
                    <p class="z-center">{{ community.owner }}</p>
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
import { mapGetters } from "vuex";
import CommunityList from "../components/a-community-list.vue";
import NavbarPhones from "../components/a-navbar-phones";
export default {
  created() {
      //this.$store.dispatch("refresh")
      this.$store.dispatch("fetchCommunities");
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
    //Comm joining

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
          this.$store.dispatch("getCommunities")
        })
        .catch(err => console.error(err));
    }
  },
  computed: {
    ...mapGetters({
      communities: "getCommunities",
      user: "getUserData"
    })
  },
  components: {
    NavbarPhones,
    CommunityList
  }
};
</script>
<style lang="scss" scoped>
.small-desc {
  color: silver;
  font-size: 0.8em;
}
.wrap {
  background-color: #f3f5f8;
  width: 100vw;
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
  .desc {
    display: grid;
    height: 7em;
    border-bottom: 1px solid #d7d7c1;
  }
  .homepage-pic {
    width: 120px;
    height: auto;
  }
  .add-to-community {
    color: #c0c2ca;
    font-size: 0.8em;
    transition: 300ms;
    margin-top: 2em;
    &:hover {
      cursor: pointer;
      color: black;
    }
  }
  .communities {
    display: flex;
    flex-wrap: wrap;
    margin: 0px;
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
    font-size: 18px;
    border-bottom: 1px solid #d7d7c1;
  }
  .small-desc {
    color: silver;
    font-size: 0.8em;
  }
  &:hover {
    -webkit-box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
    -moz-box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
    box-shadow: 14px 34px 60px 19px rgba(0, 0, 0, 0.29);
  }
}
.community-logo {
  width: 50px;
  height: auto;
  margin-top: -20px;
  margin-left: 125px;
}
.community-count {
  text-align: center;
  font-size: 13px;
  color: #9a9eaa;
}
.community-name {
  text-align: center;
  font-size: 18px;
  font-weight: bold;
  border-bottom: 1px solid #d7d7c1;
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
.community-owner {
  text-align: center;
}
.community-desc {
  display: grid;
  text-align: center;
  height: 7em;
  border-bottom: 1px solid #d7d7c1;
}
.community-create {
  text-align: center;
}
.community-moderators {
  text-align: center;
}
.homepage-pic {
  width: 120px;
  height: auto;
}
.add-to-community {
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
  .left-navbar {
    display: none;
  }
  .homepage-pic {
    display: none;
  }
  .logout {
    display: none;
  }
  .wrap {
    height: 100%;
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
    &:focus {
      outline: none;
    }
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
